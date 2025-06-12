<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class contentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contents = Content::orderBy('updated_at', 'desc')->paginate(10)->onEachSide(1);
        return view('admin.content.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        return view('admin.content.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        //
    }
}
