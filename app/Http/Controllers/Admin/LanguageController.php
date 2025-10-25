<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.language.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'language'    => 'required|string|unique:languages,lang',
            'slug'        => 'required|string|unique:languages,slug',
            'name'        => 'required|string|max:255',
            'is_default'  => 'required|boolean',
            'status'      => 'required|boolean',
        ]);

        try {
            Language::create([
                'lang'        => $request->language,
                'slug'        => $request->slug,
                'name'        => $request->name,
                'is_default'  => $request->is_default,
                'status'      => $request->status,
            ]);

            toast(__('Language created successfully!'), __('success'));
            return redirect()->route('admin.language.index');
        } catch (\Exception $e) {
            toast(__('Something went wrong. Please try again.'), __('error'));
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
        $language = Language::findOrFail($id);
        return view('admin.language.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $request->validate([
            'language'   => 'required|string|unique:languages,lang,' . $id,
            'slug'       => 'required|string|unique:languages,slug,' . $id,
            'name'        => 'required|string|max:255',
            'is_default' => 'required|boolean',
            'status'     => 'required|boolean',
        ]);

        try {
            $language = Language::findOrFail($id);


            $language->update([
                'lang'       => $request->language,
                'slug'       => $request->slug,
                'name'        => $request->name,
                'is_default' => $request->is_default,
                'status'     => $request->status,
            ]);

            toast(__('Language updated successfully!'), __('success'));
            return redirect()->route('admin.language.index');
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

        $language = Language::findOrFail($id);

        if ($language->lang === 'en') {
            toast(__("Can't Delete This One!"), __('error'));
            return redirect()->back();
        }

        $language->delete();

        return response([
            'status' => 'success',
            'message' => __('Language deleted successfully!')
        ]);
    }
}
