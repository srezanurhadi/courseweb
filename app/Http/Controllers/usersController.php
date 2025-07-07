<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::all();
        $userscount = User::all()->count();
        $admincount = User::where('role', 'admin')->count();
        $usercount = User::where('role', 'participant')->count();
        $authorcount = User::where('role', 'author')->count();
        $query = User::query();
        // 1. Filter berdasarkan keyword pencarian
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // 2. Filter berdasarkan kategori/role
        if ($request->has('category') && $request->input('category') != '') {
            $category = $request->input('category');
            $query->where('role', $category);
        }

        $users = $query->orderBy('name')->paginate(10)->onEachSide(1);
        return view('admin.users.index', compact('users', 'admincount', 'usercount', 'authorcount', 'userscount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:255|same:password_confirmation',
            'role' => 'required',
            'no_telp' => 'required',
            'image' => 'image|file|max:2048'
        ]);
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('profile-picture');
        }
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);


        return redirect("/admin/users")->with('success', 'User Berhasil Ditambahkan');
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
        $name = User::where('name', $id)->first();
        return view('admin.users.edit', compact('name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = User::where('id', $id)->first();
        $oldimage = $user->image;


        // Langkah 2: Validasi data
        $rules = [
            'name' => 'required|string|max:255',
            'role' => 'required',
            'no_telp' => 'required',
            'image' => 'image|file|max:2048'
        ];
        if ($request->email != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($oldimage) {
                Storage::delete($oldimage);
            }
            $validatedData['image'] = $request->file('image')->store('profile-picture');
        }
        // Langkah 3: Update data user di database
        $user->update($validatedData);

        // Langkah 4: Redirect ke halaman daftar user dengan pesan sukses
        // Ganti 'admin.users.index' dengan nama route halaman daftar user Anda
        return redirect("/admin/users")->with('success', 'User Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('name', $id)->first();
        $user->content()->delete();

        if ($user->image) {
            Storage::delete($user->image);
        }
        $user->delete();

        return redirect("/admin/users")->with('success', 'User Berhasil dihapus');
    }
}
