<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $position = Position::latest()->get();
        return view('position.index',[
            'positions' => $position
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $id_user = $user->id;
        $validatedData = $request->validate([
            'name' =>'required|max:255',
        ]);

        $position = Position::create($validatedData);
        if($position){
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Data Saved!',
                'message' => 'Your data has been successfully saved.'
            ]);
            LogActivity::writeLog('User added new position.', 'info', $id_user, ['name' => $validatedData['name'],]);
        }else{
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Saved!',
                'message' => 'Your data can\'t saved.'
            ]);
        }

        return redirect('/position');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('position.edit',[
            'position' => $position,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $user = Auth::user();
        $id_user = $user->id;
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $position->name = $request->input('name');
        if($position->save()){
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Data Saved!',
                'message' => 'Your data has been successfully saved.'
            ]);
            LogActivity::writeLog('User edit position.', 'info', $id_user, ['name' => $request->input('name'),
                                                            ]);
        }else{
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Saved!',
                'message' => 'Your data can\'t saved.'
            ]);
        }
        return redirect('/position');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $user = Auth::user();
        $id_user = $user->id;
        if($position->delete()){
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Data Deleted!',
                'message' => 'Your data has been successfully deleted.'
            ]);
            LogActivity::writeLog('User delete position.', 'info', $id_user, ['name' => $position->name,
                                                            ]);
        }else{
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Deleted!',
                'message' => 'Your data can\'t delete.'
            ]);
        }

        return redirect('/position');
    }
}
