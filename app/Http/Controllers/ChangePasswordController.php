<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $data = User::where('id',$id)->get();
        return view('user.changePass',[
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        // Mengambil password user yang sedang masuk
        $pw = Auth::user()->password;

        // Mengambil input dari form
        $oldPassword = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');
        $renewPassword = $request->input('renewPassword');

        // Memeriksa apakah password lama cocok
        if(Hash::check($oldPassword, $pw)) {
            // Memeriksa apakah password baru dan re-password baru cocok
            if($newPassword === $renewPassword){
                // Mengupdate password user
                $user->password = Hash::make($newPassword);
                $user->update();

                // Mengirim notifikasi bahwa password telah diubah
                $notification = array(
                    'message' => 'Password Has Been Changed',
                    'alert-type' => 'success'
                );

                // Mengarahkan kembali ke halaman ubah password dengan notifikasi
                return redirect('/change-password')->with($notification);
            } else {
                // Jika password baru dan re-password baru tidak cocok, tampilkan pesan error
                $notification = array(
                    'message' => 'New Password and Re-entered Password Do Not Match',
                    'alert-type' => 'error'
                );

                return redirect('/change-password')->with($notification);
            }
        } else {
            // Jika password lama tidak cocok, tampilkan pesan error
            $notification = array(
                'message' => 'Incorrect Current Password',
                'alert-type' => 'error'
            );

            return redirect('/change-password')->with($notification);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
