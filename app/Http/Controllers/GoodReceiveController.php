<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateGoodReceiveRequest;
use App\Models\GoodReceive;
use App\Models\LogActivity;
use App\Models\PurchaseOrder;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GoodReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receive = GoodReceive::where('isdelete', 0)->latest()->get();
        return view('goodreceive.index',[
            'receive' => $receive
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id_dept = Auth::user()->id_dept;
        $nogr = GoodReceive::max('no_gr');
        $lastNumber = preg_replace('/[^0-9]/', '', $nogr);
        $suplier = Suplier::all();
        $po = PurchaseOrder::where('id_dept', $id_dept)->get();
        return view('goodreceive.create',[
            'lastNumber' => $lastNumber,
            'supliers' => $suplier,
            'po' => $po
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'no_gr' =>'required',
            'user_receive' =>'required',
            'id_suplier' =>'required',
            'no_po' =>'required',
            'date' =>'required',
        ]);
        $gr = GoodReceive::first();

        if ($gr) {
            $no_gr = $request->input('no_gr');
            $existingNogr = $gr->no_gr;

            if ($no_gr === $existingNogr) {
                session()->flash('notification', [
                    'type' => 'error',
                    'title' => 'ERROR!',
                    'message' => 'No. GR Has Been Used.'
                ]);

                return redirect()->back()->withInput();
            }
        }

        $validatedData['id_user_in'] = $user->id;
        $gr = GoodReceive::create($validatedData);
        if($gr){
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

        return redirect('/goods-receipt');
    }

    /**
     * Display the specified resource.
     */
    public function show(GoodReceive $goodReceive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $goodReceive = GoodReceive::find($id);
        $id_dept = Auth::user()->id_dept;
        $nogr = GoodReceive::max('no_gr');
        $lastNumber = preg_replace('/[^0-9]/', '', $nogr);
        $suplier = Suplier::all();
        $po = PurchaseOrder::where('id_dept', $id_dept)->get();
        return view('goodreceive.edit',[
            'goodReceive' => $goodReceive,
            'lastNumber' => $lastNumber,
            'supliers' => $suplier,
            'po' => $po
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $goodReceive = GoodReceive::findOrFail($id);
        $validatedData = $request->validate([
            'no_gr' =>'required',
            'user_receive' =>'required',
            'id_suplier' =>'required',
            'no_po' =>'required',
            'date' =>'required',
        ]);

        $oldNogr = $goodReceive->no_gr;
        $newNogr = $request->input('no_gr');
        if($oldNogr === $newNogr){
            $goodReceive->no_gr = $oldNogr;
        }else{
            $goodReceive->no_gr = $newNogr;
        }

        $goodReceive->user_receive = $validatedData['user_receive'];
        $goodReceive->id_suplier = $validatedData['id_suplier'];
        $goodReceive->no_po = $validatedData['no_po'];
        $goodReceive->date = $validatedData['date'];

        $updated = $goodReceive->update();

        if($updated){
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

        return redirect('/goods-receipt');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $purchaseOrder = GoodReceive::findOrFail($id);
        $purchaseOrder->isdelete = 1;
        $saved = $purchaseOrder->save();

        if ($saved) {
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


        return redirect('/goods-receipt');
    }
}
