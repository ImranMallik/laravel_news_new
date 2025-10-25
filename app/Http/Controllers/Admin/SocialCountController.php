<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSocialCountStore;
use App\Http\Requests\AdminSocialCountStoreRequest;
use App\Models\Language;
use App\Models\SocialCount;
use Illuminate\Http\Request;

class SocialCountController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $languages = Language::orderBy('id', 'desc')->get();
        return view('admin.social-count.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all();
        return view('admin.social-count.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminSocialCountStoreRequest $request)
    {
        // dd($request->all());
        $storeSocialCount = new SocialCount();
        $storeSocialCount->language = $request->language;
        $storeSocialCount->icon = $request->icon;
        $storeSocialCount->fan_count = $request->fan_count;
        $storeSocialCount->fan_type = $request->fan_type;
        $storeSocialCount->button_text = $request->button_text;
        $storeSocialCount->url = $request->url;
        $storeSocialCount->color = $request->color;
        $storeSocialCount->status = $request->status;
        $storeSocialCount->save();
        toast(__('Created Successfully'), 'success');
        return redirect()->route('admin.social-count.index');
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
        $socialCount = SocialCount::findOrFail($id);
        $languages = Language::orderBy('id', 'desc')->get();
        return view('admin.social-count.edit', compact('socialCount', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminSocialCountStoreRequest $request, string $id)
    {
        $socialCount = SocialCount::findOrFail($id);
        $socialCount->language = $request->language;
        $socialCount->icon = $request->icon;
        $socialCount->fan_count = $request->fan_count;
        $socialCount->fan_type = $request->fan_type;
        $socialCount->button_text = $request->button_text;
        $socialCount->url = $request->url;
        $socialCount->color = $request->color;
        $socialCount->status = $request->status;
        $socialCount->save();

        toast(__('Updated Successfully'), 'success');
        return redirect()->route('admin.social-count.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $socialCount = SocialCount::findOrFail($id);

        $socialCount->delete();

        return response([
            'status' => 'success',
            'message' => __('Deleted successfully!')
        ]);
    }
}
