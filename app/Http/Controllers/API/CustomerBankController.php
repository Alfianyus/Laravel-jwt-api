<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CustomerBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerBankController extends Controller
{
    public function customerBank(){
        return response()->json([
            'data'=>CustomerBank::where('customer_id',auth()->user()->id)->get()
        ]);
    } 




    public function customer_bank(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'BankName'=>'required|regex:/^[a-zA-Z\s]+$/', 
            'BankOwner'=>'required|regex:/^[a-zA-Z\s]+$/',
            'BankNumber'=>'required|numeric',
            'BankCabang'=>'required|regex:/^[a-zA-Z\s]+$/',
            'QuestionRDN'=>'required|numeric|digits:1',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $customerbank = CustomerBank::updateOrCreate(
            [
                'customer_id' =>  auth()->user()->id,

            ],
            [
            'BankName' => $request->input('BankName'),
            'BankOwner'=> $request->input('BankOwner'),
            'BankNumber' => $request->input('BankNumber'),
            'BankCabang'=>$request->input('BankCabang'),
            'QuestionRDN'=>$request->input('QuestionRDN'),
            'customer_id'=>auth()->user()->id,
  
           
        ]);
        return response()->json([ 'data' => $customerbank], 201);
    }
}

