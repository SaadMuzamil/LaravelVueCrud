<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Notifications\CompanyCreateNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $employees = Employee::with('companies')->get();
        return response()->json($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "f_name" => "required",
            "l_name" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ]);
        }
        try {
            $employee = new Employee();
            $employee->f_name = $request->f_name;
            $employee->l_name = $request->l_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->company_id = $request->company_id;
            $employee->save();
            return response()->json([
                'status' => true,
                'message' => 'data stored successfully',
                'company' => $employee
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'some thing went wrong.try again late.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json($employee);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "f_name" => "required",
            "l_name" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ]);
        }
        try {
            $employee = Employee::find($id);
            $employee->f_name = $request->f_name;
            $employee->l_name = $request->l_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->company_id = $request->company_id;
            $employee->save();
            return response()->json([
                'status' => true,
                'message' => 'data updated successfully',
                'employee'=>$employee
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'some thing went wrong.try again late.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json([
            'message'=>'Employee Deleted Successfully!!'
        ]);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountries()
    {
        $data = Company::get();
        return response()->json($data);
    }
}
