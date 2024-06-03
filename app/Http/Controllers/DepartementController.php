<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departement = Departement::whereNotIn('name', ['Administrator'])->paginate(15);
        return view('departement.index',[
            'departements' => $departement
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' =>'required|max:255',
        ]);

        $depart = Departement::create($validatedData);
        if($depart){
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

        return redirect('/departement');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departement $departement)
    {
        return view('departement.edit',[
            'departement' => $departement,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departement $departement)
    {
        $name = $departement->name;
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $departement->name = $request->input('name');
        $newName = $departement->name;
        if($departement->save()){
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
        return redirect('/departement');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departement $departement)
    {
        if($departement->delete()){
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Data Deleted!',
                'message' => 'Your data has been successfully deleted.'
            ]);
        }else{
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Deleted!',
                'message' => 'Your data can\'t delete.'
            ]);
        }

        return redirect('/departement');
    }
}
