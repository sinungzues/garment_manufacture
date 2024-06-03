<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Ppn;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\Suplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departmentId = Auth::user()->id_dept;
        if($departmentId === 1){
            $daftar = PurchaseOrder::where('isdelete', 0)->latest()->get();
        }else{
            $daftar = PurchaseOrder::where('id_dept', $departmentId)->where('isdelete',0)->latest()->get();
        }
        return view('purchaseorder.index',[
            'daftar' => $daftar
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id_dept = Auth::user()->id_dept;
        $lastNumber = PurchaseOrder::where('id_dept', $id_dept)->where('isdelete', 0)->max('nopo');
        $suplier = Suplier::all();
        $currency = Currency::all();
        $ppn = Ppn::latest()->pluck('ppn')->first();
        return view('purchaseorder.create',[
            'lastNumber' => $lastNumber,
            'supliers' => $suplier,
            'currency' => $currency,
            'ppn' => $ppn
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $id_dept = $user->id_dept;
        $validatedData = $request->validate([
            'nopo' =>'required',
            'date' =>'required',
            'id_suplier' =>'required',
            'attention' =>'required',
            'remarks' =>'required',
            'id_currency' =>'required',
        ]);
        $po = PurchaseOrder::where('id_dept', $id_dept)->first();

        if ($po) {
            $nopo = $request->input('nopo');
            $existingNopo = $po->nopo;

            if ($nopo === $existingNopo && $po->status === "A") {
                session()->flash('notification', [
                    'type' => 'error',
                    'title' => 'ERROR!',
                    'message' => 'No. PO Has Been Used.'
                ]);

                return redirect()->back()->withInput();
            }
        }

        if($request->input('ppn') === null){
            $validatedData['ppn'] = 'false';
        }else{
            $validatedData['ppn'] = 'true';
        }

        $ppn = $validatedData['ppn'];
        if ($ppn === 'true') {
            $validatedData['total_ppn'] = $request->input('total_ppn');
        }
        $validatedData['id_user_in'] = $user->id;
        $validatedData['id_dept'] = $user->id_dept;
        $validatedData['user_input'] = $user->nama;
        $validatedData['input_date'] = Carbon::now();
        $po = PurchaseOrder::create($validatedData);
        if($po){
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

        return redirect('/purchaseorder');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $po = PurchaseOrder::find($id);
        $po_det = PurchaseOrderDetail::where('id_po',$po->id)->where('isdelete', 0)->get();
        return view('purchaseorder.show', [
            'purchaseOrder' => $po,
            'po_det' => $po_det
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $po = PurchaseOrder::find($id);
        $po_det = PurchaseOrderDetail::where('id_po',$po->id)->where('isdelete', 0)->get();
        $suplier = Suplier::all();
        $currency = Currency::all();
        $ppn = Ppn::latest()->pluck('ppn')->first();
        return view('purchaseorder.edit', [
            'purchaseOrder' => $po,
            'po_det' => $po_det,
            'supliers' => $suplier,
            'currency' => $currency,
            'ppn' => $ppn
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $user = Auth::user();
        $validatedData = $request->validate([
            'nopo' =>'required',
            'date' =>'required',
            'id_suplier' =>'required',
            'attention' =>'required',
            'remarks' =>'required',
            'id_currency' =>'required',
        ]);

        $oldNopo = $purchaseOrder->nopo;
        $newNopo = $request->input('nopo');
        if($oldNopo === $newNopo){
            $purchaseOrder->nopo = $oldNopo;
        }else{
            $purchaseOrder->nopo = $newNopo;
        }
        $purchaseOrder->date = $validatedData['date'];
        $purchaseOrder->id_suplier = $validatedData['id_suplier'];
        $purchaseOrder->attention = $validatedData['attention'];
        $purchaseOrder->remarks = $validatedData['remarks'];

        if ($request->has('ppn')) {
            $purchaseOrder->ppn = 'true';
            $purchaseOrder->total_ppn = $request->input('total_ppn');
        } else {
            $purchaseOrder->ppn = 'false';
            $purchaseOrder->total_ppn = null;
        }

        $purchaseOrder->user_edit = $user->id;
        $purchaseOrder->edit_date = Carbon::now();

        $updated = $purchaseOrder->update();

        if($updated->save()){
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

        return redirect('/purchaseorder');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $purchaseOrder->user_delete = Auth::id();
        $purchaseOrder->delete_date = Carbon::now();
        $purchaseOrder->isdelete = 1;

        if($purchaseOrder->status === "P"){
            $saved = $purchaseOrder->save();

            if ($saved) {
                $pod = PurchaseOrderDetail::where('id_po', $id)->get();

                foreach ($pod as $detail) {
                    $detail->user_delete = Auth::id();
                    $detail->delete_date = Carbon::now();
                    $detail->isdelete = 1;
                    $detail->save();
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
        }else{
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Can\'t Delete!',
                'message' => 'Purchase Orders Has Been Approved, Can\' Delete Apporved Data!'
            ]);
        }


        return redirect('/purchaseorder');

    }

    public function history(){
        $daftar = PurchaseOrder::where('isdelete', 1)->orderBy('delete_date', 'desc')->get();
        return view('log',[
            'daftar' => $daftar
        ]);
    }
    public function restore($id){
       // Dapatkan Purchase Order yang ingin dipulihkan
        $po = PurchaseOrder::findOrFail($id);

        // Cari Purchase Order lain dengan No. PO yang sama dan isdelete = 0
        $existingPO = PurchaseOrder::where('nopo', $po->nopo)
                                    ->where('isdelete', 0)
                                    ->where('id_dept', $po->id_dept)
                                    ->first();

        // Jika ada entitas lain dengan No. PO yang sama dan status delete = 0, tandai PO yang ingin dipulihkan sebagai tidak dapat dipulihkan
        if ($existingPO) {
            $notification = [
                'message' => 'Another Active Purchase Order with the same No. PO exists. This Purchase Order cannot be restored.',
                'alert-type' => 'error'
            ];
        } else {
            // Lakukan pemulihan seperti biasa jika tidak ada entitas lain dengan No. PO yang sama dan status delete = 0
            $po->isdelete = 0;

            $saved = $po->save();

            if ($saved) {
                // Pulihkan juga detail pembelian jika ada
                $pod = PurchaseOrderDetail::where('id_po', $id)->get();

                foreach ($pod as $detail) {
                    $detail->isdelete = 0;
                    $detail->save();
                }

                $notification = [
                    'message' => 'Data Has Been Restored',
                    'alert-type' => 'success'
                ];
            } else {
                $notification = [
                    'message' => 'Can\'t Restore Data Now!',
                    'alert-type' => 'error'
                ];
            }
        }

        return redirect('/log');
    }


    public function viewExcel($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $id_po = $purchaseOrder->id;
        $purchaseOrderDetail = PurchaseOrderDetail::where('id_po', $id_po)->get();
        $templatePath = public_path('assets/excel/Template_Form2.xlsx');
        $dept = $purchaseOrder->departement->name;
        $nopo = $purchaseOrder->nopo;

        $spreadsheet = IOFactory::load($templatePath);

        $sheet = $spreadsheet->getActiveSheet();

        $rowIndex = 25;
        $no = 1;
        $totalAmount = 0;

        $dateFormatted = date('d/m/Y', strtotime($purchaseOrder->date));

        $sheet->setCellValue("K1", $dept);
        $sheet->setCellValue("K5", $nopo);
        $sheet->setCellValue("K7", $dateFormatted);
        $sheet->setCellValue("D10", $purchaseOrder->suplier->name);
        $sheet->setCellValue("D11", $purchaseOrder->suplier->address);
        $sheet->setCellValue("G10", $purchaseOrder->attention);
        $sheet->setCellValue("G11", $purchaseOrder->suplier->tel);
        if($purchaseOrder->suplier->fax === null){
            $sheet->setCellValue("G12", "");
        }else{
            $sheet->setCellValue("G12", $purchaseOrder->suplier->fax);
        }
        $sheet->setCellValue("G15", $dept);
        $sheet->setCellValue("C21", $purchaseOrder->remarks);
        $total_ppn = $purchaseOrder->total_ppn;
        if ($purchaseOrder->ppn === 'true'){
            $sheet->setCellValue("H22", "This Price Excludes VAT $total_ppn%");
        }
        $sheet->setCellValue("K23", "(".$purchaseOrder->currency->name.")");

        foreach ($purchaseOrderDetail as $detail) {
            $columnIndex = 'B';

            $qty = $detail->qty;
            $price = $detail->price;
            $amount = $qty * $price;
            $sheet->setCellValue($columnIndex . $rowIndex, $no++);
            $sheet->getStyle($columnIndex . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue(++$columnIndex . $rowIndex, $detail->material);
            $sheet->getStyle($columnIndex . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $sheet->setCellValue("F" . $rowIndex, $qty);
            $sheet->getStyle("F" . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            if ($detail->id_satuan === null) {
                $sheet->setCellValue("G" . $rowIndex, "");
            } else {
                $sheet->setCellValue("G" . $rowIndex, $detail->satuan->name);
            }
            $sheet->getStyle("G" . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $sheet->setCellValue("H" . $rowIndex, $price);
            $sheet->getStyle("H" . $rowIndex)->getNumberFormat()->setFormatCode('#,##0.00');
            $styleRange = 'H' . $rowIndex . ':J' . $rowIndex;
            $sheet->mergeCells($styleRange);
            $sheet->getStyle($styleRange)->getFont()->setSize(9);
            $sheet->getStyle("H" . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue("K" . $rowIndex, $amount);
            $sheet->getStyle("K" . $rowIndex)->getNumberFormat()->setFormatCode('#,##0.00');
            $sheet->getStyle("K" . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $sheet->getStyle("K" . $rowIndex)->getFont()->setSize(9);

            $rowIndex++;
            $totalAmount += $amount;
        }

        $ppn = ($totalAmount * $total_ppn) / 100;
        $grandTotal = $totalAmount + $ppn;

        if ($purchaseOrder->ppn === 'true') {
            $sheet->setCellValue("H" . $rowIndex+=1, "Sub Total");
            $styleRange = 'B' . $rowIndex . ':K' . $rowIndex;
            $style = $sheet->getStyle($styleRange);
            $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
            $sheet->setCellValue("K" . $rowIndex, $totalAmount);
            $sheet->getStyle("K" . $rowIndex)->getNumberFormat()->setFormatCode('#,##0.00');
            $sheet->getStyle("K" . $rowIndex)->getFont()->setSize(9);

            $sheet->setCellValue("H" . $rowIndex+=1, "PPN");
            $sheet->setCellValue("K" . $rowIndex, $ppn);
            $sheet->getStyle("K" . $rowIndex)->getNumberFormat()->setFormatCode('#,##0.00');
            $sheet->getStyle("K" . $rowIndex)->getFont()->setSize(9);

            $sheet->setCellValue("H" . $rowIndex+=1, "Grand Total");
            $style = $sheet->getStyle("H" . $rowIndex);
            $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $styleRange2 = 'H' . $rowIndex . ':K' . $rowIndex;
            $style = $sheet->getStyle($styleRange2);
            $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_DOUBLE);
            $sheet->setCellValue("K" . $rowIndex, $grandTotal);
            $sheet->getStyle("K" . $rowIndex)->getNumberFormat()->setFormatCode('#,##0.00');
            $sheet->getStyle("K" . $rowIndex)->getFont()->setSize(9);
        } else {
            $sheet->setCellValue("H" . $rowIndex+=1, "Grand Total");
            $styleRange = 'B' . $rowIndex . ':K' . $rowIndex;
            $style = $sheet->getStyle($styleRange);
            $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
            $sheet->setCellValue("K" . $rowIndex, $grandTotal);
            $sheet->getStyle("K" . $rowIndex)->getNumberFormat()->setFormatCode('#,##0.00');
        }

        $sheet->setCellValue("F" . $rowIndex+=2, "Dated Delivery Order");
        $imagePath = public_path('assets/excel/sign.jpg');

        $drawing = new Drawing();
        $drawing->setPath($imagePath);
        $drawing->setHeight(117);
        $drawing->setCoordinates('F' . $rowIndex+=1);

        $spreadsheet->getActiveSheet()->getDrawingCollection()->append($drawing);
        $sheet->setCellValue("B" . $rowIndex, "Remarks :");
        $sheet->setCellValue("D" . $rowIndex+=1, "Please send back Purchase Order(PO) with Invoice");
        $sheet->setCellValue("D" . $rowIndex+=1, "Please send by fax to PT. Bengawan Solo Garment Indonesia");
        $sheet->setCellValue("D" . $rowIndex+=1, "After date delivery approved");
        $sheet->setCellValue("D" . $rowIndex+=1, "Please send Delivery Order and Invoice");
        $sheet->setCellValue("D" . $rowIndex+=1, "to PT. Bengawan Solo Garment Indonesia write No.PO");
        $styleRange2 = 'B' . $rowIndex . ':K' . $rowIndex;
        $style = $sheet->getStyle($styleRange2);
        $style->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
        $style = $sheet->getStyle("D" . ($rowIndex - 4) . ":D" . $rowIndex);
        $style->getFont()->setSize(8);

        $imagePath = public_path('assets/excel/final_sign.jpg');

        $drawing = new Drawing();
        $drawing->setPath($imagePath);
        $drawing->setHeight(96);
        $drawing->setCoordinates('E' . $rowIndex+=2);

        $spreadsheet->getActiveSheet()->getDrawingCollection()->append($drawing);



        $namaFile = $dept . $nopo;
        $fileName = public_path('assets/excel/' . $namaFile . '.xlsx');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($fileName);
        $response = Response::download($fileName);
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function approve($id){
        $purchaseOrder = PurchaseOrder::findOrFail($id);

        $purchaseOrder->status = "A";

        $updated = $purchaseOrder->update();

        if ($updated) {
            $notification = array(
                'message' => 'Purchase Order Has Been Approved',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Can\'t Approve Purchase Order Now!',
                'alert-type' => 'error'
            );
        }

        return redirect()->back();
    }
    public function notapprove($id){
        $purchaseOrder = PurchaseOrder::findOrFail($id);

        $purchaseOrder->status = "NA";

        $updated = $purchaseOrder->update();

        if ($updated) {
            $notification = array(
                'message' => 'Purchase Order Has Been Approved',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Can\'t Approve Purchase Order Now!',
                'alert-type' => 'error'
            );
        }

        return redirect()->back();
    }

    public function cancel($id){
        $purchaseOrder = PurchaseOrder::findOrFail($id);

        $purchaseOrder->status = "P";

        $updated = $purchaseOrder->update();

        if ($updated) {
            $notification = array(
                'message' => 'Approve Canceled',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Can\'t Cancel Approve Purchase Order Now!',
                'alert-type' => 'error'
            );
        }

        return redirect()->back();
    }

}
