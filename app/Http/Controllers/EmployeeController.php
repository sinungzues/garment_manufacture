<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employee;
use App\Models\LogActivity;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $employee = Employee::where('is_active', 1)->get();
        $employee = Employee::get();

        return view('employee.index',[
            'employees' => $employee
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $position = Position::all();
        $departement = Departement::all();
        $lastNumber = Employee::max('nik');
        return view('employee.create',[
            'lastNumber' => $lastNumber,
            'positions' => $position,
            'departments' => $departement,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|unique:employees,nik',
            'nama' => 'required',
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'sex' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'id_dept' => 'required',
            'id_position' => 'required',
            'status' => 'required',
            'hire_date' => 'required',
            'contract_exp_date' => 'required',
        ]);

        $validatedData['hire_date'] = Carbon::createFromFormat('m/d/Y', $request->hire_date)->format('Y-m-d');
        $validatedData['contract_exp_date'] = Carbon::createFromFormat('m/d/Y', $request->contract_exp_date)->format('Y-m-d');

        if (Employee::where('nik', $request->nik)->exists()) {
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Cant Add New Employee!',
                'message' => 'NIK Has been Used'
            ]);
            return redirect()->back()->withInput();
        } else {
            $employee = Employee::create($validatedData);
            if ($employee) {
                session()->flash('notification', [
                    'type' => 'success',
                    'title' => 'Data Saved!',
                    'message' => 'Your data has been successfully saved.'
                ]);
                return redirect('/employees');
            } else {
                session()->flash('notification', [
                    'type' => 'error',
                    'title' => 'Data Not Saved!',
                    'message' => 'Your data can\'t be saved.'
                ]);
                return redirect('/employees');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $position = Position::all();
        $departement = Departement::all();
        return view('employee.edit',[
            'positions' => $position,
            'departments' => $departement,
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'nik' => 'required|unique:employees,nik,' . $employee->id,
            'nama' => 'required',
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'sex' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'id_dept' => 'required',
            'id_position' => 'required',
            'status' => 'required',
            'hire_date' => 'required|date_format:m/d/Y',
            'contract_exp_date' => 'required|date_format:m/d/Y',
        ]);

        // Convert the date format to Y-m-d
        $validatedData['hire_date'] = Carbon::createFromFormat('m/d/Y', $validatedData['hire_date'])->format('Y-m-d');
        $validatedData['contract_exp_date'] = Carbon::createFromFormat('m/d/Y', $validatedData['contract_exp_date'])->format('Y-m-d');

        // Update employee data
        $updated = $employee->update($validatedData);

        if ($updated) {
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Data Saved!',
                'message' => 'Your data has been successfully updated.'
            ]);
            return redirect('/employees');
        } else {
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Saved!',
                'message' => 'Your data can\'t update.'
            ]);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {

        if($employee->delete()){
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

        return redirect('/employees');
    }

    public function active($id){
        $employee = Employee::findOrFail($id);

        $employee->is_active = 1;

        $employee->update();

        if($employee){
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Employee Active!',
                'message' => 'Employee has been change to active.'
            ]);
        }else{
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Change!',
                'message' => 'Your data can\'t change.'
            ]);
        }

        return redirect('/employees');
    }
    public function notactive($id){
        $employee = Employee::findOrFail($id);

        $employee->is_active = 0;

        $employee->update();

        if($employee){
            session()->flash('notification', [
                'type' => 'success',
                'title' => 'Employee Not Active!',
                'message' => 'Employee has been change to not active.'
            ]);
        }else{
            session()->flash('notification', [
                'type' => 'error',
                'title' => 'Data Not Change!',
                'message' => 'Your data can\'t change.'
            ]);
        }

        return redirect('/employees');
    }
}
