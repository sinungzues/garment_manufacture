<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currency = Currency::latest()->get();
        return view('currency.index',[
            'currency' => $currency
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('currency.create');
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
            'code' =>'required|max:255',
        ]);

        $currency = Currency::create($validatedData);
        if($currency){
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Data Saved!',
                'message' => 'Your data has been successfully saved.'
            ]);
            LogActivity::writeLog('User added new currency.', 'info', $id_user, ['name' => $validatedData['name'],
                                                            'code' => $validatedData['code'],
                                                            ]);
        }else{
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Saved!',
                'message' => 'Your data can\'t saved.'
            ]);
        }

        return redirect('/currency');
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        return view('currency.edit',[
            'currency' => $currency,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency)
    {
        $user = Auth::user();
        $id_user = $user->id;
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $currency->name = $request->input('name');
        $currency->code = $request->input('code');
        if($currency->save()){
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Data Saved!',
                'message' => 'Your data has been successfully updated.'
            ]);
            LogActivity::writeLog('User edit currency.', 'info', $id_user, ['name' => $request->input('name'),
                                                            'code' => $request->input('code'),
                                                            ]);
        }else{
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Saved!',
                'message' => 'Your data can\'t update.'
            ]);
        }
        return redirect('/currency');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        $user = Auth::user();
        $id_user = $user->id;
        if ($currency->delete()) {
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Data Deleted!',
                'message' => 'Your data has been successfully deleted.'
            ]);

            LogActivity::writeLog('User deleted currency.', 'info', $id_user, ['name' => $currency->name,
                                                            'code' => $currency->code,
                                                            ]);
        } else {
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Deleted!',
                'message' => 'Your data can\'t deleted.'
            ]);
        }

        return redirect('/currency');
    }
}
