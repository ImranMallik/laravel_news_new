<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\About;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contract;
use App\Models\HomeSectionSetting;
use App\Models\News;
use App\Models\ReciveMail;
use App\Models\SocialCount;
use App\Models\Subscriber;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Unique;

class HomeController extends Controller
{
    function index()
    {
        $breakingNews = News::query()
            ->where('is_breaking_news', 1)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('id', 'DESC')->take(10)->get();

        $heroSliders = News::with('category', 'auther')
            ->where('show_at_slider', 1)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('id', 'desc')->take(7)->get();

        $recentNewsPosts = News::with('category', 'auther')
            ->activeEntries()
            ->withLocalize()
            ->orderBy('id', 'desc')
            ->take(6)
            ->get();

        $popularNews = News::with('category')
            ->where('show_at_popular', 1)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('updated_at', 'desc')
            ->take(4)
            ->get();



        // dd($HomeSectionSetting);

        $socialCounts = SocialCount::where(['status' => 1, 'language' => getLanguage()])->get();

        $HomeSectionSetting = HomeSectionSetting::where('language', getLanguage())->first();

        $ads = Ad::first();


        $categorySectionOne = News::with(['category', 'auther'])
            ->where('category_id', $HomeSectionSetting->category_section_one)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('id', 'DESC')
            ->take(8)
            ->get();

        $categorySectionTwo = News::with(['category', 'auther'])
            ->where('category_id', $HomeSectionSetting->category_section_two)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('id', 'DESC')
            ->take(8)
            ->get();

        $categorySectionThree = News::with(['category', 'auther'])
            ->where('category_id', $HomeSectionSetting->category_section_three)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('id', 'DESC')
            ->take(8)
            ->get();

        $categorySectionThree = News::with(['category', 'auther'])
            ->where('category_id', $HomeSectionSetting->category_section_three)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('id', 'DESC')
            ->take(6)
            ->get();

        $categorySectionFour = News::with(['category', 'auther'])
            ->where('category_id', $HomeSectionSetting->category_section_four)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('id', 'DESC')
            ->take(4)
            ->get();

        $mostViewedPosts = News::with(['category', 'auther'])
            ->activeEntries()
            ->withLocalize()
            ->orderBy('views', 'DESC')
            ->take(3)
            ->get();

        //Most Common Tags 

        $mostCommonTags = $this->mostCommonTags();

        // dd($categorySectionFour);

        return  view('frontend.index', compact(
            'breakingNews',
            'heroSliders',
            'recentNewsPosts',
            'popularNews',
            'categorySectionOne',
            'categorySectionTwo',
            'categorySectionThree',
            'categorySectionFour',
            'mostViewedPosts',
            'socialCounts',
            'mostCommonTags',
            'ads'
        ));
    }


    // Filter Wise get News Data

    public function news(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);
        $search = trim((string) $request->input('search', ''));
        $categorySlug = $request->input('category');
        $tagName = trim((string) $request->input('tag', ''));

        $news = News::query()
            ->with('category', 'tags')
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('meta_description', 'like', "%{$search}%");
                })
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->when($categorySlug && $categorySlug !== '#', function ($q) use ($categorySlug) {
                $q->whereHas('category', function ($q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            })

            ->when($tagName !== '', function ($q) use ($tagName) {
                $q->whereHas('tags', function ($q) use ($tagName) {
                    $q->where('name', $tagName);
                });
            })

            ->when($request->has('search') && $search === '' && !$categorySlug, function ($q) {
                $q->whereRaw('1 = 0');
            })
            ->latest()
            ->ActiveEntries()
            ->withLocalize()
            ->paginate($perPage)
            ->appends($request->query());

        $recentNews = News::with(['category', 'auther'])
            ->ActiveEntries()
            ->withLocalize()
            ->orderBy('id', 'DESC')
            ->take(4)
            ->get();

        $mostCommonTags = $this->mostCommonTags();

        $categories = Category::where([
            'status' => 1,
            'language' => getLanguage()
        ])->get();

        $ads = Ad::first();

        return view('frontend.news', compact(
            'news',
            'recentNews',
            'mostCommonTags',
            'categories',
            'ads'
        ));
    }





    function newsDetails(string $slug)
    {

        $newsDetails = News::with(['auther', 'category', 'tags', 'comments'])
            ->where('slug', $slug)
            ->ActiveEntries()
            ->withLocalize()
            ->first();
        //Recent News
        $recentNews = News::with(['category', 'auther'])->where('slug', '!=', $newsDetails->slug)->ActiveEntries()->withLocalize()->orderBy('id', 'DESC')->take(4)->get();
        //Tags
        $mostCommonTags = $this->mostCommonTags();
        //view Count
        $this->countView($newsDetails);
        $newsDetails->refresh();

        //Next Post
        $nextPost = News::where('id', '>', $newsDetails->id)
            ->ActiveEntries()->withLocalize()
            ->orderBy('id', 'asc')->first();
        //Previous Post

        $previousPost = News::where('id', '<', $newsDetails->id)
            ->ActiveEntries()->withLocalize()
            ->orderBy('id', 'desc')->first();

        //Related Post
        $relatedPosts = News::where('slug', '!=', $newsDetails->slug)
            ->where('category_id', $newsDetails->category_id)
            ->ActiveEntries()->withLocalize()
            ->take(5)
            ->get();

        $ads = Ad::first();

        return view('frontend.news-details', compact('newsDetails', 'recentNews', 'mostCommonTags', 'nextPost', 'previousPost', 'relatedPosts', 'ads'));
    }

    public function countView($newsDetails)
    {
        if (session()->has('viewed_posts')) {
            $postIds = session('viewed_posts');

            if (!in_array($newsDetails->id, $postIds)) {
                $postIds[] = $newsDetails->id;
                $newsDetails->increment('views');
            }

            session(['viewed_posts' => $postIds]);
        } else {
            session(['viewed_posts' => [$newsDetails->id]]);
            $newsDetails->increment('views');
        }
    }

    public function mostCommonTags()
    {
        return Tag::select('name', DB::raw('COUNT(name) as count'))
            ->where('language', getLanguage())
            ->groupBy('name')
            ->orderByDesc('count')
            ->limit(15)
            ->get();
    }

    public function handleComment(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'comment' => ['required', 'string', 'max:1000']
        ]);

        $comment = new Comment();
        $comment->news_id = $request->news_id;
        $comment->user_id = Auth::user()->id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->comment;
        $comment->save();

        toast(__('Comment Add Successfully'), 'success');

        return redirect()->back();
    }

    public function handelReply(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'reply' => ['required', 'string', 'max:1000']
        ]);

        $comment = new Comment();
        $comment->news_id = $request->news_id;
        $comment->user_id = Auth::user()->id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->reply;
        $comment->save();

        return redirect()->back();
    }


    public function commentDestroy(Request $request)
    {
        // dd($request->all());

        $comment = Comment::findOrFail($request->id);
        // dd($comment);
        if (Auth::user()->id === $comment->user_id) {
            $comment->delete();
            return response([
                'status' => 'success',
                'message' => __('Deleted Successfully')
            ]);
        }

        return response([
            'status' => 'error',
            'message' => __('Something went wrong!')
        ]);
    }


    //newsletter Subscribe

    function newsLetter(Request $request)
    {
        $validated = $request->validate(
            [
                'email' => 'required|email:rfc,dns|max:255|unique:subscribers,email',
            ],
            [
                'email.unique' => __('Email is already subscribed!'),
            ]
        );


        Subscriber::create(['email' => $validated['email']]);

        return response()->json([
            'success' => 'success',
            'message' => __('Subscribed successfully.')
        ], 201);
    }

    function about()
    {
        $about = About::where('language', getLanguage())->first();
        return view('frontend.about', compact('about'));
    }

    function contractUs()
    {
        $contract = Contract::where('language', getLanguage())->first();
        return view('frontend.contract-us', compact('contract'));
    }

    function handleContractData(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'email'   => ['required', 'email', 'max:255'],
            'subject' => ['required', 'max:255'],
            'message' => ['required', 'max:500'],
        ]);


        try {
            $toContract = Contract::where('language', getLanguage())->first();

            if (!$toContract || empty($toContract->email)) {
                return back()->with('error', __('Recipient email not found.'));
            }

            Mail::to($toContract->email)
                ->send(new ContactMail(
                    $validated['subject'],
                    $validated['message'],
                    $validated['email']
                ));

            //** Store Mail Data **// 

            ReciveMail::create([
                'email'   => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
            ]);

            toast(__('Your message has been sent successfully.'), 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Contact Mail Error: ' . $e->getMessage());
            toast(__('Something went wrong while sending your message. Please try again later.'), 'error');
            return redirect()->back();
        }
    }
}
