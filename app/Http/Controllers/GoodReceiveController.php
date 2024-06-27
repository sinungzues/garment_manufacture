<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateGoodReceiveRequest;
use App\Models\GoodReceive;
use App\Models\GoodReceiveDetail;
use App\Models\LogActivity;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
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
        $nogr = GoodReceive::where('isdelete', 0)->max('no_gr');
        $lastNumber = preg_replace('/[^0-9]/', '', $nogr);
        $suplier = Suplier::all();
        $grdList = GoodReceive::where('status', '!=', 'A')->get();

        // Ekstrak semua no_po dari hasil GoodReceive
        $no_po_list = $grdList->pluck('no_po')->map(function($no_po) {
            return preg_replace('/[^0-9]/', '', $no_po);
        });

        // Ambil data PurchaseOrder yang no_po-nya tidak ada dalam hasil GoodReceive
        $poList = PurchaseOrder::where('id_dept', $id_dept)
            ->where('status', 'A')
            ->whereNotIn('nopo', $no_po_list)
            ->get();

        return view('goodreceive.create',[
            'lastNumber' => $lastNumber,
            'supliers' => $suplier,
            'po' => $poList
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
    public function show($id)
    {
        $gr = GoodReceive::where('id',$id)->first();
        $nopo = $gr->no_po;
        $number = filter_var($nopo, FILTER_SANITIZE_NUMBER_INT);
        $po = PurchaseOrder::where('nopo', $number)->first();
        $id_po = $po->id;
        $po_det = PurchaseOrderDetail::where('id_po', $id_po)->get();

        foreach ($po_det as $pod) {
            $exists = GoodReceiveDetail::where('id_gr', $id)
                ->where('material', $pod->material)
                ->exists();

            if (!$exists) {
                GoodReceiveDetail::create([
                    'id_gr' => $id,
                    'id_po' => $id_po,
                    'material' => $pod->material,
                    'qty' => $pod->qty,
                    'id_satuan' => $pod->id_satuan,
                ]);
            }
        }

        $grd = GoodReceiveDetail::where('id_gr', $id)->get();

        return view('goodreceive.show',[
            'gr' => $gr,
            'po' => $po,
            'po_det' => $po_det,
            'grd' => $grd
        ]);
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
        $goodReceive = GoodReceive::findOrFail($id);
        $goodReceive->isdelete = 1;
        $saved = $goodReceive->save();

        if($goodReceive->status === "O"){
            $saved = $goodReceive->save();

            if ($saved) {
                $grd = GoodReceiveDetail::where('id_gr', $id)->get();

                foreach ($grd as $detail) {
                    $detail->delete();
                }

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
        }
        $goodReceive->delete();

        return redirect('/goods-receipt');
    }

    public function updateQty(Request $request, $id)
    {
        try {
            // Validasi data
            $validatedData = $request->validate([
                'qty_receive_current' => 'required|integer|min:0',
            ]);

            // Lakukan pengolahan data seperti yang Anda lakukan sebelumnya
            $grdet = GoodReceiveDetail::findOrFail($id);

            $grdet->qty_receive_previous += $validatedData['qty_receive_current'];
            $grdet->save();

            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Qty has been added'
            ]);

            // Redirect kembali ke halaman sebelumnya
            return redirect()->back();

        } catch (\Exception $e) {
            // Tangani kesalahan
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'ERROR!',
                'message' => $e->getMessage()
            ]);
            return redirect()->back();
        }
    }

    public function posting($id){
        $gr = GoodReceive::find($id);
        $gr->status = "C";

        if ($gr->save()) {
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Status Changed!',
                'message' => 'Good Receive Status Successfully Change'
            ]);
        } else {
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Status Can Not Change!',
                'message' => ''
            ]);
        }
        return redirect('/goods-receipt');
    }

}
