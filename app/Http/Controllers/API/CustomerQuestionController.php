<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CustomerQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerQuestionController extends Controller
{
    public function customerQuestion(){
        return response()->json([
            'data'=>CustomerQuestion::where('customer_id', auth()->user()->id)->get()
        ]);
    }

    public function customer_question(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'SpouseIncomePerAnnum'=>'required|numeric|digits:1',
            'SpouseOccupation'=>'required|numeric|digits:1',
            'SpousePosition'=>'required|regex:/^[a-zA-Z\s]+$/',
            'SpouseNatureOfBusiness'=>'required|regex:/^[a-zA-Z\s]+$/',
            'SpouseCompanyName'=>'required|max:200|regex:/^[a-zA-Z\s.,]+$/',
            'SpouseCompanyCity'=>'required|numeric',
            'SpouseCompanyPostalCode'=>'required|numeric|digits:5',
            'SpouseCompanyAddress'=>'required|max:200|regex:/^[a-zA-Z0-9\s.,]+$/',
            'SpouseFundSource'=>'required|numeric|digits:1',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $question = CustomerQuestion::updateOrCreate(
            [
                'customer_id' =>  auth()->user()->id

            ],
            [
            'Risk'=>$request->input('Risk'),
            'SpouseIncomePerAnnum'=>$request->input('SpouseIncomePerAnnum'),
            'SpouseOccupation'=>$request->input('SpouseOccupation'),
            'SpousePosition'=>$request->input('SpousePosition'),
            'SpouseNatureOfBusiness'=>$request->input('SpouseNatureOfBusiness'),
            'SpouseCompanyName'=>$request->input('SpouseCompanyName'),
            'SpouseCompanyCity'=>$request->input('SpouseCompanyCity'),
            'SpouseCompanyPostalCode'=>$request->input('SpouseCompanyPostalCode'),
            'SpouseCompanyAddress'=>$request->input('SpouseCompanyAddress'),
            'SpouseFundSource'=>$request->input('SpouseFundSource'),
            'SpouseRelationship'=>$request->input('SpouseRelationship'),
            'SpouseRelationshipText'=>$request->input('SpouseRelationshipText'),
            'SpouseName'=>$request->input('SpouseName'),
            'FATCA1'=>$request->input('FATCA1'),
            'FATCA2'=>$request->input('FATCA2'),
            'FATCA3'=>$request->input('FATCA3'),
            'Question1'=>$request->input('Question1'),
            'Question1Text'=>$request->input('Question1Text'),
            'Question2'=>$request->input('Question2'),
            'Question2Text'=>$request->input('Question2Text'),
            'Question3'=>$request->input('Question3'),
            'Question3Text'=>$request->input('Question3Text'),
            'Question4'=>$request->input('Question4'),
            'Question4Text'=>$request->input('Question4Text'),
            'Question5'=>$request->input('Question5'),
            'Question5Text'=>$request->input('Question5Text'),
            'Question6'=>$request->input('Question6'),
            'Disclaimer'=>$request->input('Disclaimer'),
            'InvestmentObjectives'=>$request->input('InvestmentObjectives'),
            'customer_id'=>auth()->user()->id,  

        ]);

        return response()->json([ 'data' => $question], 201);
    }
    
}
