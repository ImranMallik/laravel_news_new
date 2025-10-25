<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminFooterGridOneRequest;
use App\Models\FooterGridOne;
use App\Models\FooterTitle;
use App\Models\Language;
use Illuminate\Http\Request;

class FooterGridOneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();

        return view('admin.footer-grid-one.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::where('status', 1)->get();
        return view('admin.footer-grid-one.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminFooterGridOneRequest $request)
    {
        FooterGridOne::create([
            'language' => $request->language,
            'name'     => $request->name,
            'url'      => $request->url,
            'status'   => $request->status,
        ]);

        toast(__('Created Successfully'), 'success');

        return redirect()->route('admin.footer-grid-one.index');
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
        $footerGridOne = FooterGridOne::findOrFail($id);
        $languages = Language::where('status', 1)->get();
        return view('admin.footer-grid-one.edit', compact('languages', 'footerGridOne'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminFooterGridOneRequest $request, string $id)
    {
        $footerGridOne = FooterGridOne::findOrFail($id);
        $footerGridOne->update([
            'language' => $request->language,
            'name'     => $request->name,
            'url'      => $request->url,
            'status'   => $request->status,
        ]);
        toast(__('Updated Successfully'), 'success');
        return redirect()->route('admin.footer-grid-one.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footerGridOne = FooterGridOne::findOrFail($id);
        $footerGridOne->delete();

        return response([
            'status' => 'success',
            'message' => __('Foter Grid one deleted successfully!')
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
                'key' => 'grid_one_title',
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
