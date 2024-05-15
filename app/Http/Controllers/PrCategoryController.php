<?php

namespace App\Http\Controllers;

use App\Models\PrCategory;
use Illuminate\Http\Request;

class PrCategoryController extends Controller
{
    public function index()
    {
        $categories = PrCategory::all();
        return view('purchaseReport.Categories.index', compact('categories'));
    }

    public function create()
    {
        return view('purchaseReport.Categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:pr_categories'
        ]);

        PrCategory::create($request->all());
        return redirect()->route('categories.index')->with('success','Category created successfully.');
    }

    public function show(PrCategory $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(PrCategory $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, PrCategory $category)
    {
        $request->validate([
            'name' => 'required|unique:pr_categories,name,' . $category->id
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success','Category updated successfully.');
    }

    public function destroy(PrCategory $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
