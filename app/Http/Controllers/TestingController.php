<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;


class TestingController extends Controller
{
    public function index(Request $request){
        Redis::set('name',"[kepo,kepo,kepo]");
        $get = Redis::get('name');
        dd($get);
        return ;
    }

}
