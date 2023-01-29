<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function create(){//Вывод страницы
        return view('product');
    }

    public function index_country($country){//Вывод страницы
        $countryy = Product::latest()->get();//Сортировка по дате
        $category = Category::get();

        //Сортировка по полученному id категории
        if($country=='desc'){
            $product = Product::orderBy('country', 'desc')->get();//Сортировка по убыванию цены
        }
        elseif($country=='asc'){
            $product = Product::orderBy('country', 'asc')->get();//Сортировка по возрастанию цены
        }

        return view('product',[
            'product'=>$product,//Возвращаем записи по нужно категории
            'category'=>$category,
            'countryy'=>$countryy
        ]);
    }

    public function index_name($name){//Вывод страницы
        $countryy = Product::latest()->get();//Сортировка по дате
        $category = Category::get();

        //Сортировка по полученному id категории
        if($name=='desc'){
            $product = Product::orderBy('name', 'desc')->get();//Сортировка по убыванию цены
        }
        elseif($name=='asc'){
            $product = Product::orderBy('name', 'asc')->get();//Сортировка по возрастанию цены
        }

        return view('product',[
            'product'=>$product,//Возвращаем записи по нужно категории
            'category'=>$category,
            'countryy'=>$countryy
        ]);
    }

    public function index_desk_asc($price){//Вывод страницы
        $countryy = Product::latest()->get();//Сортировка по дате

        $category = Category::get();

        //Сортировка по полученному id категории
        if($price=='desc'){
            $product = Product::orderBy('price', 'desc')->get();//Сортировка по убыванию цены
        }
        elseif($price=='asc'){
            $product = Product::orderBy('price', 'asc')->get();//Сортировка по возрастанию цены
        }

        return view('product',[
            'product'=>$product,//Возвращаем записи по нужно категории
            'category'=>$category,
            'countryy'=>$countryy
        ]);
    }

    public function index(){//Вывод страницы
        $countryy = Product::latest()->get();//Сортировка по дате

        $product = Product::latest()->get();//Сортировка по дате
        $category = Category::get();

        return view('product',[
            'product'=>$product,//Возвращаем записи по нужно категории
            'category'=>$category,
            'countryy'=>$countryy
        ]);
    }


    public function index2($categoryId = 0){//Вывод страницы
        $countryy = Product::latest()->get();//Сортировка по дате

        $product = Product::latest();//Сортировка по дате
        $category = Category::get();

        //Сортировка по полученному id категории
       if($categoryId){
            $product->where('category_id',$categoryId);
        }

        return view('product',[
            'product'=>$product->get(),//Возвращаем записи по нужно категории
            'category'=>$category,
            'countryy'=>$countryy

        ]);
    }

    public function slider(){//Вывод страницы
        $product = Product::latest()->limit(5)->get();//Сортировка по дате

        $array = array("active", "", "", "", "");
        return view('welcome',[
            'product'=>$product,//Возвращаем записи по нужно категории
            'array'=>$array
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


    public function add_cart(Request $request, $productId){//Вывод страницы

        if(Auth::user()){
            $productt = DB::table('product')->select('id','price','count')->whereid($productId)->get();

            if($productt[0]->count < 1) {
                $product = Product::whereId($productId)->get();
                $Error_zakaz = "То количество товара которое вы хотите добавить в корзину, отсутствует. Осталось ".$productt[0]->count." единиц";

                return view('product_id', [
                    'product' => $product,
                    'Error_zakaz' =>$Error_zakaz
                ]);
            }
            else{
                $product = Product::whereId($productId)->get();

                $user = Auth::user()->makeHidden(['id']);//Получаем id зарегистрированного пользователя

                $cart = new Cart;
                $cart->product_id = $productId;
                $cart->sum = 1;//Передаем 1 штуку, но потом мы можем уже в корзине изменить его количество
                $cart->user_id = $user->id;
                $cart->save();

                $Ok_zakaz = "Товар добавлен в корзину";
                return view('product_id', [
                    'product' => $product,
                    'Ok_zakaz' => $Ok_zakaz
                ]);
            }
        }
        else{
            return view('login');
        }

    }




}
