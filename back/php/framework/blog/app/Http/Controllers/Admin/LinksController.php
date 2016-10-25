<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;
class LinksController extends CommonController
{

    function index(){


    }


    function create(){
    return view('admin.links.add');
    }

    function store(Request $request){

    }


    function edit(){

    }

    function update(){

    }


    function destory(){

    }


    function show(){
      return view('admin.links.index');
    }
}
