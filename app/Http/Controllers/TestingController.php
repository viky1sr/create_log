<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;


class TestingController extends Controller
{
    public function index(Request $request){
       return 123;
    }

}
