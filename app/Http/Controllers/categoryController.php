<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categories = Category::query()
            ->when($search, function ($query, $search) {
                return $query->where('category', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.category.index', compact('categories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:255|unique:categories,category',
            'icon' => 'required|string|max:100',
            'color' => 'required|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
        ], [
            'category.required' => 'Category name is required.',
            'category.unique' => 'Category name already exists.',
            'category.max' => 'Category name must not exceed 255 characters.',
            'icon.required' => 'Icon class is required.',
            'icon.max' => 'Icon class must not exceed 100 characters.',
            'color.required' => 'Color is required.',
            'color.regex' => 'Color must be a valid hex color format (#RRGGBB).',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Create new category
            Category::create([
                'category' => $request->category,
                'icon' => $request->icon,
                'color' => $request->color,
            ]);

            $role = Auth::user()->role;
            if ($request->is("*/mycontent*")) {
                return redirect("/{$role}/mycontent/add/category")
                    ->with('success', 'Category created successfully!');
            }
            return redirect("/{$role}/content/add/category")
                ->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            // Handle any database errors
            return redirect()->back()
                ->with('error', 'Failed to create category. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:255|unique:categories,category,' . $category->id,
            'icon' => 'required|string|max:100',
            'color' => 'required|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
        ], [
            'category.required' => 'Category name is required.',
            'category.unique' => 'Category name already exists.',
            'category.max' => 'Category name must not exceed 255 characters.',
            'icon.required' => 'Icon class is required.',
            'icon.max' => 'Icon class must not exceed 100 characters.',
            'color.required' => 'Color is required.',
            'color.regex' => 'Color must be a valid hex color format (#RRGGBB).',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Update category
            $category->update([
                'category' => $request->category,
                'icon' => $request->icon,
                'color' => $request->color,
            ]);
            $role = Auth::user()->role;
            // Redirect with success message
            if ($request->is("*/mycontent*")) {
                return redirect("/{$role}/mycontent/add/category")
                    ->with('success', 'Category created successfully!');
            }
            return redirect("/{$role}/content/add/category")
                ->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            // Handle any database errors
            return redirect()->back()
                ->with('error', 'Failed to update category. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
