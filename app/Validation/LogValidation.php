<?php

namespace App\Validation;

use Illuminate\Support\Facades\Validator;

class LogValidation {
    public function store(array $req){
        $validation = Validator::make($req,[
           'data' => 'required',
           'request' => 'required',
           'response' => 'required',
        ]);
        if($validation->fails()){
            return response()->json([
                'status' => 'fail',
                'message' => $validation->errors()->first()
            ],422);
        }

        if(empty($req['data']['message']) || $req['data']['message'] == null){
            return response()->json([
                'status' => 'fail',
                'message' => "The data in message is field required"
            ],400);
        }
        if(empty($req['data']['nomor_aplikasi']) || $req['data']['nomor_aplikasi'] == null){
            return response()->json([
                'status' => 'fail',
                'message' => "The data in nomor_aplikasi field is required"
            ],400);
        }
        if(empty($req['data']['nomor_rekening']) || $req['data']['nomor_rekening'] == null){
            return response()->json([
                'status' => 'fail',
                'message' => "The data in nomor_rekening field is required"
            ],400);
        }

        return false;
    }

    public function get(array $req){
        $validation = Validator::make($req,[
            'date' => 'required',
            'nomor_rekening' => 'required',
        ]);
        if($validation->fails()){
            return response()->json([
                'status' => 'fail',
                'message' => $validation->errors()->first()
            ],422);
        }

        return false;
    }
}
