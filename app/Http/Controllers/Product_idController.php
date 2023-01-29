<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Product_idController extends Controller
{
    public function create(){//Вывод страницы
        return view('product');
    }

    public function index($productId){//Вывод страницы
        $product = Product::whereId($productId)->get();//Сортировка по дате

        return view('product',[
            'product'=>$product,//Возвращаем записи по нужно категории
        ]);
    }

    public function index2($categoryId = 0){//Вывод страницы
        $product = Product::latest();//Сортировка по дате
        $category = Category::get();

        //Сортировка по полученному id категории
       if($categoryId){
            $product->where('category_id',$categoryId);
        }

        return view('product',[
            'product'=>$product->get(),//Возвращаем записи по нужно категории
            'category'=>$category
        ]);
    }

    public function slider(){//Вывод страницы
        $product = Product::latest()->take(3)->get();//Сортировка по дате

        return view('welcome',[
            'product'=>$product,//Возвращаем записи по нужно категории
        ]);
    }

    //Добавление категории
    public function create_category(Request $request)
    {
        $request->validate([
            'category'=>['required','string'],
        ]);

        //Полученные данные(Создаем пользователя - регистрация)
        $Category = Category::create([
            'category' => $request->category,
        ]);
        return view('admin');
    }

    //Добавление продукта
    public function create_product(Request $request)
    {


        $error = Validator::make($request->all(), [
            'image' => 'required|mimes:png',
        ]);//1024

        $product = new Product;
        $product->image = '/storage/' . Storage::putFile('images', $request->file('image'));
        $product->save();

        return view('admin');


    }


    public function add_cart($productId){//Вывод страницы
        $product = Product::whereId($productId)->get();

        //$category = Category::where('id',$product->category_id);

        return view('product_id',[
            'product'=>$product,//Возвращаем записи по нужно категории
            //'category'=>$category->get()
        ]);
    }


}
