<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use App\Models\Ppn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PpnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ppn = Ppn::latest()->pluck('ppn')->first();

        if ($ppn === null) {
            $newPpn = new Ppn();
            $newPpn->ppn = 0;
            $newPpn->save();
            $ppn = $newPpn->ppn;
        }
        return view('ppn.index',[
            'ppn' => $ppn
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
        $user = Auth::user();
        $id_user = $user->id;
        $validatedData = $request->validate([
            'ppn' =>'required|max:255',
            'old_ppn' =>'required|max:255',
        ]);

        $ppn = Ppn::where('ppn', $validatedData['old_ppn'])->update(['ppn' => $validatedData['ppn']]);
        if($ppn){
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Data Update!',
                'message' => 'Your data has been successfully updated.'
            ]);

            LogActivity::writeLog('User update ppn value.', 'info', $id_user, ['new_ppn' => $validatedData['ppn'],
                                                                                'old_ppn' => $validatedData['old_ppn']]);
        }else{
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Update!',
                'message' => 'Your data can\'t update.'
            ]);
        }

        return redirect('/ppn');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ppn $ppn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ppn $ppn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ppn $ppn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ppn $ppn)
    {
        //
    }
}
