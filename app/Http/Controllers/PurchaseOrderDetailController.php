<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrderDetail;
use App\Models\Satuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PurchaseOrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($purchaseOrder)
    {
        $id_po = $purchaseOrder;
        $satuan = Satuan::get();
        return view('purchaseorderdet.create',[
            'id_po' => $id_po,
            'satuan' => $satuan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'material' =>'required',
            'qty' =>'required',
            'id_satuan' =>'nullable',
            'price' =>'required|numeric',
        ]);
        $validatedData['price'] = (float) $request->input('price');
        $id_po = $request->input('id_po');
        $validatedData['id_po'] = $id_po;
        $validatedData['user_input'] = $user->id;
        $validatedData['input_date'] = Carbon::now();
        // dd($user);
        $po = PurchaseOrderDetail::create($validatedData);
        if($po){
            $notification = array(
                'message' => 'Purchase Order Has Been Added',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Can\'t Add New Purchase Order Now!',
                'alert-type' => 'error'
            );
        }

        return redirect("/purchaseorder/$id_po");
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrderDetail $purchaseOrderDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $purchaseOrderDetail = PurchaseOrderDetail::findOrFail($id);
        $satuan = Satuan::get();
        return view('purchaseorderdet.edit',[
            'purchaseOrderDetail' => $purchaseOrderDetail,
            'satuan' => $satuan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,PurchaseOrderDetail $purchaseOrderDetail, $id)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'material' =>'required',
            'qty' =>'required',
            'id_satuan' =>'nullable',
            'price' =>'required',
        ]);

        // Temukan detail purchase order yang akan diperbarui
        $poDetail = PurchaseOrderDetail::findOrFail($id);

        $validatedData['user_edit'] = $user->id;
        $validatedData['edit_date'] = Carbon::now();

        // Lakukan update data detail purchase order
        $poDetail->update($validatedData);

        // Setelah berhasil melakukan update, Anda bisa menyiapkan notifikasi
        $notification = array(
            'message' => 'Purchase Order Has Been Updated',
            'alert-type' => 'success'
        );

        // Redirect pengguna kembali ke halaman detail purchase order
        return redirect("/purchaseorder/$poDetail->id_po");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, PurchaseOrderDetail $purchaseOrderDetail,$id)
    {
        $pod = PurchaseOrderDetail::find($id);
        $pod->user_delete = Auth::id();
        $pod->delete_date = now();
        $pod->isdelete = 1;

        // Simpan perubahan sebelum penghapusan
        $saved = $pod->save();
        if($saved){
            $notification = array(
                'message' => 'Material Order Has Been Deleted',
                'alert-type' => 'success'
            );

        }else{
            $notification = array(
                'message' => 'Can\'t Delete New Material Order Now!',
                'alert-type' => 'error'
            );
        }

        return redirect()->back();
    }
}
