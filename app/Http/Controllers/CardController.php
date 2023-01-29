<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ardController extends Controller
{
    public function create(){//Вывод страницы
        return view('product');
    }

    public function index($categoryId = 0){//Вывод страницы

    }
    public function create_cart(Request $request)
    {
        $error = Validator::make($request->all(), [
            'name'=>['required','string'],
            'price'=>['required','string'],
            'country'=>['required','string'],
            // 'category_id'=>['required','string'],
            'count'=>['required','string'],
            'color'=>['required','string'],
            'image' => 'required|mimes:png',
        ]);//1024

        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->country = $request->country;
        // $product->category_id = $request->category_id;
        $product->count = $request->count;
        $product->color = $request->color;
        $product->image = $request->file('image')->store('uploads','public');

        $product->save();

        return view('admin',[ 'path'=> $product->image]);



    }

}
