<?php

namespace App\Http\Controllers;

//use App\User;
//use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public $restful = true;
    public function index(){
        
        return view('users.index');
        //return View::make('users.index');
    }
}