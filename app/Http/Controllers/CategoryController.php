<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $categories = Category::latest()->paginate(10);

        return view('categories.index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $logoName = time() . '.' . $request->logo->getClientOriginalName();
        $request->logo->move(public_path('logos'), $logoName);

        $category = new Category();
        $category->name = $request->name;
        $category->type = $request->type;
        $category->logo = 'logos/' . $logoName;
        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    public function show($id): View
    {
        $category = Category::findOrFail($id);

        return view('categories.show', compact('category'));
    }

    public function edit(int $id_category): View
    {
        $category = Category::findOrFail($id_category);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id_category): RedirectResponse
    {
        $category = Category::findOrFail($id_category);

        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($category->logo && file_exists(public_path($category->logo))) {
                unlink(public_path($category->logo));
            }

            $logoName = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('logos'), $logoName);
            $category->logo = 'logos/' . $logoName;
        }

        $category->name = $request->name;
        $category->type = $request->type;
        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function delete($id): View
    {
        $category = Category::findOrFail($id);

        return view('categories.delete', compact('category'));
    }

    public function destroy(int $id_category): RedirectResponse
    {
        $category = Category::findOrFail($id_category);

        if ($category->logo && file_exists(public_path($category->logo))) {
            unlink(public_path($category->logo));
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}