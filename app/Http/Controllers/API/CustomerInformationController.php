<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CustomerInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerInformationController extends Controller
{
    public function customerInformation(){
        return response()->json([
            'data'=>CustomerInformation::where('customer_id',auth()->user()->id)->get()
        ]);
    } 


    public function customer_information(Request $request)
    {
                $validator = Validator::make($request->all(),[
                    'IDCardNumber'=> 'required|numeric|digits:16',
                    'FirstName' => 'regex:/^[A-Za-z\s]+$/|string|max:255',
                    'BirthPlace'=>  'required|regex:/^[a-zA-Z\s]+$/',
                    'BirthDate' => 'required|date_format:Y-m-d',
                    'MotherName' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'Email' => 'string|email|max:255',
                    'ContactPersonHomePhone'=>'required|regex:/^\+62-\d+$/',
                    'ContactPersonName'=>'required|alpha',
                    // 'ContactPersonMobilePhone'=>'required|regex:/^\+62-\d+$/',
                    'MobilePhone'=> 'required|regex:/^\+62-\d{11}$/',
                    'FilenameKTP'=>'required|regex:/^[a-zA-Z0-9_]+$/',
                    'KTPBase64' => 'required|string',
                    // 'KTPBase64' => 'image|mimes:jpeg,jpg|max:2048', // JPG dengan maksimum 2MB
                    'FilenameSelfie'=>'required|regex:/^[a-zA-Z0-9_]+$/',
                    // 'SelfieBase64' => 'image|mimes:jpeg,jpg|max:2048', // JPG dengan maksimum 2MB
                    'FilenameTandaTangan'=>'required|regex:/^[a-zA-Z0-9_]+$/',
                    
                    // 'TandaTanganBase64' => 'image|mimes:jpeg,jpg|max:2048', // JPG dengan maksimum 2MB  

                ]);
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422); 
                }
               


                // Jika data valid, simpan ke dalam database
                     $customer = CustomerInformation::updateOrCreate(
                
                [
                    'customer_id' =>  auth()->user()->id
                ],
                [
                    
                'IDCardNumber'=>$request->input('IDCardNumber'),
                'FirstName'=>$request->input('FirstName'),
                'BirthPlace'=>$request->input('BirthPlace'),
                'BirthDate'=>$request->date('BirthDate'),
                'Sex'=>$request->input('Sex'),
                'MaritalStatus'=>$request->input('MaritalStatus'),
                'MotherName'=>$request->input('MotherName'),
                'Religion'=>$request->input('Religion'),
                'Email'=>$request->input('Email'),
                'MobilePhone'=>$request->input('MobilePhone'),
                'Education'=>$request->input('Education'),
                'FilenameKTP'=>$request->input('FilenameKTP'),
                'KTPBase64'=>$request->input('KTPBase64'),
                'FilenameSelfie'=>$request->input('FilenameSelfie'),
                'SelfieBase64'=>$request->input('SelfieBase64'),
                'FilenameTandaTangan'=>$request->input('FilenameTandaTangan'),
                'TandaTanganBase64'=>$request->input('TandaTanganBase64'),
                'ContactPersonAddress'=>$request->input('ContactPersonAddress'),
                'ContactPersonHomePhone'=>$request->input('ContactPersonHomePhone'),
                'ContactPersonName'=>$request->input('ContactPersonName'),
                'ContactPersonRelation'=>$request->input('ContactPersonRelation'),
                'ContactPersonMobilePhone'=>$request->input('ContactPersonMobilePhone'),
                'customer_id'=>auth()->user()->id,
                // Isi kolom lainnya jika ada
            ]);
            if($request->KTPBase64){
                $filename=$this->base64_to_jpeg("data:image/jpg;base64,".$request->KTPBase64, "uploads/kt/".md5(auth()->user()->id).".jpg");
                $data=CustomerInformation ::updateOrCreate(
                    [
                        'customer_id' =>  auth()->user()->id,
                        
                    ],
                    [
                        'KTPBase64' => $filename
                    ]
                );
            }
            if($request->SelfieBase64){
                $filename=$this->base64_to_jpeg("data:image/jpg;base64,".$request->SelfieBase64, "uploads/se/" .md5(auth()->user()->id).".jpg");
                $data=CustomerInformation::updateOrCreate(
                    [
                        'customer_id' => auth()->user()->id,
                    ],
                    [
                        'SelfieBase64' => $filename
                    ]
                );
            }
            if($request->TandaTanganBase64){
                $filename=$this->base64_to_jpeg("data:image/jpg;base64,".$request->TandaTanganBase64, "uploads/td/" .md5(auth()->user()->id).".jpg");
                $data=CustomerInformation::updateOrCreate(
                    [
                        'customer_id' => auth()->user()->id,
                    ],
                    [
                        'TandaTanganBase64' => $filename
                    ]
                );
            }

            return response()->json([
                'data'=>CustomerInformation::where('customer_id',auth()->user()->id)->get()
            ]);
    }

    function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen( $output_file, 'wb' ); 
        $data = explode( ',', $base64_string );
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
        fclose( $ifp ); 
        return $output_file; 
    }
        // $customer = CustomerInformation::all();
        // return response()->json([
        //     'data'=>$customer,
        // ]);
}
