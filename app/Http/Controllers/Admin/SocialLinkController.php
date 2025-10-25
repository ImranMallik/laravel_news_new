<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLink;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialLinks = SocialLink::all();
        return view('admin.social-link.index',compact('socialLinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.social-link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
         $request->validate([
            'icon' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'status' => 'required|boolean'
        ]);

        try {

            SocialLink::create([
                'icon' => $request-> icon,
                'url' => $request-> url,
                'status' => $request-> status,
                
            ]);


            toast(__('Social Link created successfully!'), __('success'))->width('400');
            return redirect()->route('admin.social-link.index');
        } catch (\Exception $e) {

            toast(__('Something went wrong. Please try again.'), __('error'))->width('400');
            return redirect()->back();
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
        $socialLinks = SocialLink::findOrFail($id);
        return view('admin.social-link.edit',compact('socialLinks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    //    dd($request->all());
      $request->validate([
            'icon' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'status' => 'required|boolean'
        ]);

        try {
            $socialLinks = SocialLink::findOrFail($id);
            $socialLinks->update([
                'icon' => $request-> icon,
                'url' => $request-> url,
                'status' => $request-> status,
                
            ]);


            toast(__('Social Link Update successfully!'), __('success'))->width('400');
            return redirect()->route('admin.social-link.index');
        } catch (\Exception $e) {

            toast(__('Something went wrong. Please try again.'), __('error'))->width('400');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $socialLinks = SocialLink::findOrFail($id);
         $socialLinks->delete();
          return response([
            'status' => 'success',
            'message' => __('Social Links deleted successfully!')
        ]);
    }
}
