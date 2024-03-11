<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerAddressController extends Controller
{ 
    public function customerAddress(){
        return response()->json([
            'data'=>customerAddress::where('customer_id',auth()->user()->id)->get()
        ]);
    }




    public function customer_address(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'IDCardRT'=>'required|numeric|digits:4',
            'IDCardRW'=>'required|numeric|digits:4',
            'IDCardKelurahan'=>'required|regex:/^[a-zA-Z\s.]+$/',
            'IDCardKecamatan'=>'required|regex:/^[a-zA-Z\s.]+$/',
            'DomicileKecamatan'=>'required|regex:/^[a-zA-Z\s.]+$/',
            'DomicileKelurahan'=>'required|regex:/^[a-zA-Z\s.]+$/',
            'DomicilePostalCode'=>'required|numeric|digits:5',
            'DomicileRW'=>'required|numeric|digits:4',
            'DomicileCity'=>'required|numeric|digits:3',
            'IDCardPostalCode'=> 'required|numeric|digits:5',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $customeraddress = CustomerAddress::updateOrCreate(
            [
                'customer_id' => auth()->user()->id,
            ],            
            [
                'IDCardAddress' =>$request->input('IDCardAddress'),
                'IDCardRT' =>$request->input('IDCardRT'),
                'IDCardRW'=>$request->input('IDCardRW'),
                'IDCardKelurahan'=>$request->input('IDCardKelurahan'),
                'IDCardKecamatan'=>$request->input('IDCardKecamatan'),
                'IDCardCity' =>$request->input('IDCardCity'),
                'DomicileKecamatan'=>$request->input('DomicileKecamatan'),
                'DomicileKelurahan'=>$request->input('DomicileKelurahan'),
                'DomicilePostalCode'=>$request->input('DomicilePostalCode'),
                'DomicileRW'=>$request->input('DomicileRW'),
                'DomicileRT'=>$request->input('DomicileRT'),
                'CopyID'=>$request->input('CopyID'),
                'DomicileCity'=>$request->input('DomicileCity'),
                'IDCardPostalCode'=>$request->input('IDCardPostalCode'),
                'ResidencyNStatus'=>$request->input('ResidencyNStatus'),
                'customer_id'=>auth()->user()->id,
            
            ]);    
        return response()->json(['data' => $customeraddress], 201);

    }
}
