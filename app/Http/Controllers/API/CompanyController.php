<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Notifications\CompanyCreateNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $companies = Company::all(['id','name','email','logo','website']);
        return response()->json($companies);
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
            "name" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ]);
        }
        try {
            $company = new Company();
            $company->name = $request->name;
            $company->email = $request->email;
            $imageName = time().'.'.$request->logo->getClientOriginalExtension();
            $image_path = $request->logo->move(public_path('images'), $imageName);
            $company->logo = env('APP_URL').'images/'.$imageName;

            $company->website = $request->website;
            $company->save();
            $details = [
                'greeting' => 'Hi'.$company->name,
                'body' => 'New company is created',
                'thanks' => 'Thank you for using.',
            ];

            Notification::route('mail', $company->email)->notify(new CompanyCreateNotification($details));

            return response()->json([
                'status' => true,
                'message' => 'data stored successfully',
                'company' => $company
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
    public function show(Company $company)
    {
        return response()->json($company);
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
            "name" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ]);
        }
        try {
            $company = Company::find($id);
            $company->name = $request->name;
            $company->email = $request->email;
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                $image_name = $image->getClientOriginalName();
                $image->move(public_path('/logos'),$image_name);
                $image_path = "/logos/" . $image_name;
                $company->logo = $image_path;
            }
            $company->website = $request->website;
            $company->save();
            return response()->json([
                'status' => true,
                'message' => 'company updated successfully',
                'company' => $company
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
    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json([
            'message'=>'Company Deleted Successfully!!'
        ]);

    }
}
