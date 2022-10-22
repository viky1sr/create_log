<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LogService;
use App\Validation\LogValidation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LogApiController extends Controller
{
    protected LogValidation $validation;
    protected LogService $logService;

    public function __construct(
        LogValidation $validation,
        LogService $logService
    ){
        $this->validation = $validation;
        $this->logService = $logService;
    }

    public function get($url, Request $request){
        if($validation = $this->validation->get($request->all())){
            return $validation;
        }
        return DataTables::of($this->logService->get($url,$request->all()))->toJson();
    }

    public function store($bank,Request $request){
        if($validation = $this->validation->store($request->all())){
            return $validation;
        }

        if( $this->logService->store($bank,$request->only(['request','response','data']))){
            return response()->json([
                'success' => true,
                'message' => 'Success',
                'data' => $request->all(),
            ],200);
        }
    }
}
