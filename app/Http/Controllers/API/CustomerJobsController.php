<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CustomerJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerJobsController extends Controller
{
    public function customerJob(){
        return response()->json([
            'data'=>CustomerJobs::where('customer_id',auth()->user()->id)->get()
        ]);
    } 


    public function customer_job(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'Position'=>'required|numeric|digits:1',
            'NatureOfBusiness'=>'required|numeric|digits:1',
            'CompanyName'=>'required|max:200|regex:/^[a-zA-Z\s.,]+$/',
            'CompanyAddress'=>'required|max:200|regex:/^[a-zA-Z0-9\s.,]+$/',
            'CompanyCity'=>'required|numeric|digits:3',          
            'IncomePerAnnum'=>'required|numeric|digits:1',
            'FundSource'=>'required|numeric|digits:1',
            'QuestionNPWP'=>'required|numeric|digits:1',
            'NPWPNumber'=>'required|numeric',
            'NPWPReason'=>'required|max:200|regex:/^[a-zA-Z\s.,]+$/',
            'PositionText'=>'required|max:200|regex:/^[a-zA-Z\s.,]+$/',
            'NatureOfBusinessText'=>'required|max:200|regex:/^[a-zA-Z\s.,]+$/',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $customerjob = CustomerJobs::updateOrCreate(
            [
                'customer_id' => auth()->user()->id
            ],            
            [
                'Occupation'=>$request->input('Occupation'),
                'Position'=>$request->input('Position'),
                'NatureOfBusiness'=>$request->input('NatureOfBusiness'),
                'CompanyName'=>$request->input('CompanyName'),
                'CompanyAddress'=>$request->input('CompanyAddress'),
                'CompanyCity'=>$request->input('CompanyCity'),
                'IncomePerAnnum'=>$request->input('IncomePerAnnum'),
                'FundSource'=>$request->input('FundSource'),
                'QuestionNPWP'=>$request->input('QuestionNPWP'),
                'NPWPNumber'=>$request->input('NPWPNumber'),
                'NPWPReason'=>$request->input('NPWPReason'),
                'PositionText'=>$request->input('PositionText'),
                'NatureOfBusinessText'=>$request->input('NatureOfBusinessText'),
                'customer_id'=>auth()->user()->id,
        ]);
        return response()->json([ 'data' => $customerjob], 201);
    }
}
