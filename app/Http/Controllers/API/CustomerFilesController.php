<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CustomerFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerFilesController extends Controller
{ 
    public function CustomerFiles(){
        return response()->json([
            'data'=>CustomerFiles::where('customer_id',auth()->user()->id)->get()
        ]);
    }

    public function customer_files(Request $request)
    {
        $validator = Validator::make($request->all(),[
 
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $customer = CustomerFiles::updateOrCreate(
            [
                'customer_id' =>  auth()->user()->id,

            ],
            [
            'FilenameTandaTangan' => $request->input('FilenameTandaTangan'),
            'FilenameSelfie'=> $request->input('FilenameSelfie'),
            'FilenameKTP' => $request->input('FilenameKTP'),
            'customer_id'=>auth()->user()->id,    
            ]
        );
        if($request->FilenameTandaTangan){
            $filename=$this->base64_to_jpeg("data:image/jpg;base64,".$request->FilenameTandaTangan, "uploads/files/fk/".md5(auth()->user()->id).".jpg");
            $data=CustomerFiles ::updateOrCreate(
                [
                    'customer_id' =>  auth()->user()->id,
                    
                ],
                [
                    'FilenameTandaTangan' => $filename
                ]
            );
        }
        if($request->FilenameSelfie){
            $filename=$this->base64_to_jpeg("data:image/jpg;base64,".$request->FilenameSelfie, "uploads/files/fs/".md5(auth()->user()->id).".jpg");
            $data=CustomerFiles ::updateOrCreate(
                [
                    'customer_id' =>  auth()->user()->id,
                    
                ],
                [
                    'FilenameSelfie' => $filename
                ]
            );
        }
        if($request->FilenameKTP){
            $filename=$this->base64_to_jpeg("data:image/jpg;base64,".$request->FilenameKTP, "uploads/files/ftt/".md5(auth()->user()->id).".jpg");
            $data=CustomerFiles ::updateOrCreate(
                [
                    'customer_id' =>  auth()->user()->id,
                    
                ],
                [
                    'FilenameKTP' => $filename
                ]
            );
        }
       
        return response()->json([
             'data' => CustomerFiles::where('customer_id', auth()->user()->id)->get()
        ]);
    }

    function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen( $output_file, 'wb' ); 
        $data = explode( ',', $base64_string );
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
        fclose( $ifp ); 
        return $output_file; 
    }
    
    










    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerFiles $customerFiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerFiles $customerFiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerFiles $customerFiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerFiles $customerFiles)
    {
        //
    }
}
