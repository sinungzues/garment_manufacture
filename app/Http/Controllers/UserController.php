<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $departments = Departement::all();
        return view('users.create', compact('roles','departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string',
            'role_id' => 'required|exists:roles,id',
            'id_dept' => 'required'
        ]);

        $validatedData['password'] = Hash::make($request->password);

        $user = User::create($validatedData);
        if($user){
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Data Saved!',
                'message' => 'New user successfully added.'
            ]);
        }else{
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Saved!',
                'message' => 'Can\'t Add New User Now!'
            ]);
        }

        return redirect('/user');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $roles = Role::all();
        $departments = Departement::all();
        return view('users.edit', compact('user', 'roles','departments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $departments = Departement::all();
        return view('users.edit', compact('user', 'roles','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username,' . $user->id,
            'password' => 'nullable|string|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role_id' => $request->role_id,
            'id_dept' => $request->input('id_dept')
        ]);

        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Data Deleted!',
                'message' => 'User has been successfully deleted.'
            ]);
        } else {
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Deleted!',
                'message' => 'User can\'t deleted.'
            ]);
        }

        return redirect('/user');
    }

    public function refresh($id){
        $defaultPassword = bcrypt('Muara2023');
        $user = User::find($id);
        $user->password = $defaultPassword;

        if ($user->save()) {
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Password Updated!',
                'message' => 'User Password Updated Successfully.'
            ]);
        } else {
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Password Not Updated!',
                'message' => 'User Password Can\'t Updated.'
            ]);
        }
        return redirect()->back();
    }
}
