<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Contactt;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //Выводим страницу home
   public function home(){
        return view('home');
   }

    //Выводим страницу about
    public function about(){
        return view('about');
    }

    //Выводим страницу about
    public function index(){
        return view('info');
    }
}
