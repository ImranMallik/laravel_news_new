<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAdUpdateRequest;
use App\Models\Ad;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class AdController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ad = Ad::first();
        return view('admin.ad.create', compact('ad'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminAdUpdateRequest $request, string $id)
    {
        $ad = Ad::first();

        $home_top_bar_ad = $this->updateImage($request, 'home_top_bar_ad', 'uploads/ads', $ad->home_top_bar_ad ?? null);
        $home_middle_ad = $this->updateImage($request, 'home_middle_ad', 'uploads/ads', $ad->home_middle_ad ?? null);
        $view_page_ad = $this->updateImage($request, 'view_page_ad', 'uploads/ads', $ad->view_page_ad ?? null);
        $news_page_ad = $this->updateImage($request, 'news_page_ad', 'uploads/ads', $ad->news_page_ad ?? null);
        $side_bar_ad = $this->updateImage($request, 'side_bar_ad', 'uploads/ads', $ad->side_bar_ad ?? null);

        Ad::updateOrCreate(
            ['id' => $ad ? $ad->id : 1],
            [
                'home_top_bar_ad' => $home_top_bar_ad ?? $ad->home_top_bar_ad,
                'home_middle_ad' => $home_middle_ad ?? $ad->home_middle_ad,
                'view_page_ad' => $view_page_ad ?? $ad->view_page_ad,
                'news_page_ad' => $news_page_ad ?? $ad->news_page_ad,
                'side_bar_ad' => $side_bar_ad ?? $ad->side_bar_ad,

                'home_top_bar_ad_status' => $request->home_top_bar_ad_status == 1 ? 1 : 0,
                'home_middle_ad_status' => $request->home_middle_ad_status == 1 ? 1 : 0,
                'view_page_ad_status' => $request->view_page_ad_status == 1 ? 1 : 0,
                'news_page_ad_status' => $request->news_page_ad_status == 1 ? 1 : 0,
                'side_bar_ad_status' => $request->side_bar_ad_status == 1 ? 1 : 0,

                'home_top_bar_ad_url' => $request->home_top_bar_ad_url,
                'home_middle_ad_url' => $request->home_middle_ad_url,
                'view_page_ad_url' => $request->view_page_ad_url,
                'news_page_ad_url' => $request->news_page_ad_url,
                'side_bar_ad_url' => $request->side_bar_ad_url,
            ]
        );

        toast(__('Updated Successfully'), 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
