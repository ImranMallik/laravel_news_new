<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();

        return view('admin.category.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all();
        return view('admin.category.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'language'     => 'required|string|max:50',
            'name'         => 'required|string|max:255',
            'show_at_nav'  => 'required|boolean',
            'status'       => 'required|boolean',
        ]);

        try {

            Category::create([
                'language'    => $request->language,
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'show_at_nav' => $request->show_at_nav,
                'status'      => $request->status,
            ]);


            toast(__('Category created successfully!'), __('success'))->width('400');
            return redirect()->route('admin.category.index');
        } catch (\Exception $e) {

            toast(__('Something went wrong. Please try again.'), __('error'))->width('400');
            return redirect()->back();
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = Language::all();
        $categories = Category::findOrFail($id);
        return view('admin.category.edit', compact('categories', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'language'     => 'required|string|max:50',
            'name'         => 'required|string|max:255',
            'show_at_nav'  => 'required|boolean',
            'status'       => 'required|boolean',
        ]);

        try {
            $category = Category::findOrFail($id);
            $category->update([
                'language'    => $request->language,
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'show_at_nav' => $request->show_at_nav,
                'status'      => $request->status,
            ]);


            toast(__('Category updated successfully!'), __('success'));
            return redirect()->route('admin.category.index');
        } catch (\Exception $e) {

            toast(__('Something went wrong. Please try again.'), __('error'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = category::findOrFail($id);


        $categories->delete();

        return response([
            'status' => 'success',
            'message' => __('Category deleted successfully!')
        ]);
    }
}
