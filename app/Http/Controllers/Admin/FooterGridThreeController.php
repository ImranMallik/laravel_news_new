<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminFooterGridThreeRequest;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\FooterTitle;
use App\Models\FooterGridThree;

class FooterGridThreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $languages = Language::all();

        return view('admin.footer-grid-three.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $languages = Language::where('status', 1)->get();
        return view('admin.footer-grid-three.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminFooterGridThreeRequest $request)
    {
    //   dd($request->all());
    FooterGridThree::create([
            'language' => $request->language,
            'name'     => $request->name,
            'url'      => $request->url,
            'status'   => $request->status,
        ]);

        toast(__('Created Successfully'), 'success');

        return redirect()->route('admin.footer-grid-three.index');

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
          $footerGridThree = FooterGridThree::findOrFail($id);
         $languages = Language::where('status', 1)->get();
        return view('admin.footer-grid-three.edit',compact('languages','footerGridThree'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminFooterGridThreeRequest $request, string $id)
    {
        //  dd($request->all());
        $footerGridThree = FooterGridThree::findOrFail($id);
        $footerGridThree->update([
            'language' => $request->language,
            'name'     => $request->name,
            'url'      => $request->url,
            'status'   => $request->status,
        ]);
        toast(__('Updated Successfully'), 'success');
        return redirect()->route('admin.footer-grid-three.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $footerGridThree = FooterGridThree::findOrFail($id);
            $footerGridThree->delete();

             return response([
            'status' => 'success',
            'message' => __('Foter Grid Three deleted successfully!')
        ]);
    }


     public function handleTitle(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => ['required', 'max:255']
        ]);

        FooterTitle::updateOrCreate(
            [
                'key' => 'grid_three_title',
                'language' => $request->language
            ],
            [
                'value' => $request->title
            ]
        );

        toast(__('Updated Successfully'), 'success');
        return redirect()->back();
    }
}
