<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['records'] = User::getAdmin();
        $data['name'] = 'Admin List';
        return view('admin.admin.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin.add')->with('name', 'Add New Admin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = 1;
        $user->save();
        return redirect('/admin/admin/list')->with('success', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['records'] = User::getSingle($id);
        if ($data['records'] != null) {
            $data['name'] = 'Edit Admin';
            return view('admin.admin.edit', $data);
        } else {
            return redirect('/admin/admin/list')->with('error', 'Page Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $user = User::getSingle($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('/admin/admin/list')->with('success', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
