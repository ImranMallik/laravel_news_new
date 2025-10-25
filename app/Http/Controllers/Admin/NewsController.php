<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminNewsCreateRequest;
use App\Models\Category;
use App\Models\Language;
use App\Models\News;
use App\Models\Tag;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.news.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all();
        return view('admin.news.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminNewsCreateRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $this->uploadImage($request, 'image', 'uploads/admin/news');
            }



            $news = News::create([
                'language'          => $request->language,
                'category_id'       => $request->category,
                'auther_id'         => Auth::guard('admin')->id(),
                'title'             => $request->title,
                'slug'              => \Str::slug($request->title),
                'content'           => $request->content,
                'meta_title'        => $request->meta_title,
                'meta_description'  => $request->meta_description,
                'is_breaking_news'  => $request->is_breaking_news == 1 ? 1 : 0,
                'show_at_slider'    => $request->show_at_slider == 1 ? 1 : 0,
                'show_at_popular'   => $request->show_at_popular == 1 ? 1 : 0,
                'status'            => $request->status == 1 ? 1 : 0,
                'image'             => $imagePath,
            ]);

            $tags = explode(',', $request->tags);
            $tagIds = [];

            foreach ($tags as $tag) {
                $trimmedTag = trim($tag);
                if ($trimmedTag === '') continue;

                $tagModel = Tag::firstOrCreate([
                    'name' => $trimmedTag,
                    'language' => $news->language,
                ]);

                $tagIds[] = $tagModel->id;
            }

            if (!empty($tagIds)) {
                $news->tags()->attach($tagIds);
            }

            DB::commit();

            toast(__('News created successfully!'), __('success'));
            return redirect()->route('admin.news.index');
        } catch (\Exception $e) {
            DB::rollBack();

            dd($e->getMessage());


            toast(__('Something went wrong. Please try again.'), __('error'));
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = Language::all();
        $categories = Category::all();
        $news = News::with('tags')->findOrFail($id);
        return view('admin.news.edit', compact('languages', 'categories', 'news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            $news = News::findOrFail($id);


            $imagePath = $news->image;
            if ($request->hasFile('image')) {
                $imagePath = $this->updateImage($request, 'image', 'uploads/admin/news', $news->image);
            }

            $news->update([
                'language'          => $request->language,
                'category_id'       => $request->category,
                'title'             => $request->title,
                'slug'              => \Str::slug($request->title),
                'content'           => $request->content,
                'meta_title'        => $request->meta_title,
                'meta_description'  => $request->meta_description,
                'is_breaking_news'  => $request->is_breaking_news == 1 ? 1 : 0,
                'show_at_slider'    => $request->show_at_slider == 1 ? 1 : 0,
                'show_at_popular'   => $request->show_at_popular == 1 ? 1 : 0,
                'status'            => $request->status == 1 ? 1 : 0,
                'image'             => $imagePath,
            ]);


            $tags = explode(',', $request->tags);
            $tagIds = [];

            foreach ($tags as $tag) {
                $trimmedTag = trim($tag);
                if ($trimmedTag === '') continue;

                $tagModel = Tag::firstOrCreate([
                    'name'     => $trimmedTag,
                    'language' => $news->language,
                ]);

                $tagIds[] = $tagModel->id;
            }


            $news->tags()->sync($tagIds);

            DB::commit();

            toast(__('News updated successfully!'), __('success'));
            return redirect()->route('admin.news.index');
        } catch (\Exception $e) {
            DB::rollBack();

            // dd($e->getMessage());

            toast(__('Something went wrong. Please try again.'), __('error'));
            return back()->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);

        if ($news->image) {
            $this->deleteImage($news->image);
        }

        // $news->tags()->detach(); 
        $news->tags()->delete();

        $news->delete();

        return response([
            'status' => 'success',
            'message' => __('News deleted successfully!')
        ]);
    }


    public function fetchCategory(Request $request)
    {
        // dd($request->all());
        $categories = Category::where('language', $request->lang)->get();
        return $categories;
    }

    function copyNews(string $id)
    {
        // dd($id);
        $news = News::findOrFail($id);
        $copyNews = $news->replicate();
        $copyNews->save();

        toast(__('Copied Successfully'), 'success');

        return redirect()->back();
    }
}
