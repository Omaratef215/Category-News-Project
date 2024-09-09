<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminStoreRequesr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return view('temp_admins.index', compact('admins'));
    }

    public function create()
    {
        return view('temp_admins.create');
    }

    public function store(AdminStoreRequesr $request)
    {
        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('temp_admins.index');
    }
    public function destroy($id)
    {
        $admin = User::findOrFail($id);

        $admin->delete();

        return redirect()->route('temp_admins.index');
    }

}
