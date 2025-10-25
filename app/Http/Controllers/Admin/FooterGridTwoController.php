<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminFooterGridTwoRequest;

use App\Models\Language;
use App\Models\FooterTitle;
use App\Models\FooterGridTwo;

class FooterGridTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $languages = Language::all();

        return view('admin.footer-grid-two.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          $languages = Language::where('status', 1)->get();
        return view('admin.footer-grid-two.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminFooterGridTwoRequest $request)
    {
         FooterGridTwo::create([
            'language' => $request->language,
            'name'     => $request->name,
            'url'      => $request->url,
            'status'   => $request->status,
        ]);

        toast(__('Created Successfully'), 'success');

        return redirect()->route('admin.footer-grid-two.index');
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
         $footerGridTwo = FooterGridTwo::findOrFail($id);
         $languages = Language::where('status', 1)->get();
        return view('admin.footer-grid-two.edit',compact('languages','footerGridTwo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminFooterGridTwoRequest $request, string $id)
    {
         $footerGridTwo = FooterGridTwo::findOrFail($id);
        $footerGridTwo->update([
            'language' => $request->language,
            'name'     => $request->name,
            'url'      => $request->url,
            'status'   => $request->status,
        ]);
        toast(__('Updated Successfully'), 'success');
        return redirect()->route('admin.footer-grid-two.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $footerGridTwo = FooterGridTwo::findOrFail($id);
            $footerGridTwo->delete();

             return response([
            'status' => 'success',
            'message' => __('Foter Grid Two deleted successfully!')
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
                'key' => 'grid_two_title',
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
