<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suplier = Suplier::latest()->get();
        return view('suplier.index',[
            'supliers' => $suplier
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' =>'required',
            'address' =>'required',
            'tel' =>'nullable',
            'fax' => 'nullable'
        ]);

        $suplier = Suplier::create($validatedData);
        if($suplier){
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Data Saved!',
                'message' => 'Your data has been successfully saved.'
            ]);
        }else{
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Saved!',
                'message' => 'Your data can\'t saved.'
            ]);
        }


        return redirect('/suplier');
    }

    /**
     * Display the specified resource.
     */
    public function show(Suplier $suplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suplier $suplier)
    {
        return view('suplier.edit',[
            'suplier' => $suplier,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suplier $suplier)
    {
        $request->validate([
            'name' =>'required',
            'address' =>'required',
            'tel' =>'nullable',
            'fax' => 'nullable'
        ]);

        $suplier->name = $request->input('name');
        $suplier->address = $request->input('address');
        $suplier->tel = $request->input('tel');
        $suplier->fax = $request->input('fax');
        if($suplier->save()){
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Data Saved!',
                'message' => 'Your data has been successfully updated.'
            ]);
        }else{
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Saved!',
                'message' => 'Your data can\'t update.'
            ]);
        }
        return redirect('/suplier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suplier $suplier)
    {
        if ($suplier->delete()) {
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Data Deleted!',
                'message' => 'Your data has been successfully deleted.'
            ]);
        } else {
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Deleted!',
                'message' => 'Your data can\'t deleted.'
            ]);
        }

        return redirect('/suplier');
    }
}
