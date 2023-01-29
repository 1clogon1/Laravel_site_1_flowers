<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class CartController extends Controller
{
    public function create(){//Вывод страницы
        return view('cart');
    }

    public function index(){//Вывод страницы
        $user = Auth::user()->makeHidden(['id']);//Получаем id зарегистрированного пользователя
        $cart = Cart::where('user_id',$user->id)->latest();//Выводим по id товары из корзины данного пользователя
        $product = Product::latest();//Сортировка по дате

        $users = DB::table('cart')//Через leftjoin мы связываем 3 таблицы, за счет чего мы через одну переменную передаем все нужные нам данные, то есть мне это было нужно для вывода товаров в корзину, зная только id продуктов, я смог связать через этот id  product_id из таблицы cart, за счет чего я смог вывести в корзине все нужыне данные из двух таблизц, а также я еще связал id пользователя с user_id в таблице cart, за счет чего смог вывести только те товары которе добавил это пользователь
        ->leftJoin('product', 'cart.product_id', '=', 'product.id')
            ->leftJoin('users', 'cart.user_id', '=', 'users.id')
            ->select('product.name','product.price','cart.sum','product.id','cart.user_id','product.image','cart.id as cart_id')->where('users.id', '=', $user->id)->get();

        //dd($product);
        return view('cart',[
            'users'=>$users,
            'cart'=>$cart->get(),//Возвращаем записи по нужно категории
            'product'=>$product->get(),
        ]);
    }
    public function add_order(Request $request, $id)
    {
        $val = $request->validate([
            'login'=>['required','string'],
            'password'=>['required','string'],
        ]);

        $user = Auth::user()->makeHidden(['id','email']);

        if(Auth::attempt($request->only('login','password')))
        {
            //Получаем id зарегистрированного пользователя

            $cartt = DB::table('cart')->select('id','product_id')->whereid($id)->get();
            $productt = DB::table('product')->select('id','price','count')->whereid($cartt[0]->product_id)->get();
            if($productt[0]->count < $request->sum){

                $user = Auth::user()->makeHidden(['id']);//Получаем id зарегистрированного пользователя
                $cart = Cart::where('user_id',$user->id)->latest();//Выводим по id товары из корзины данного пользователя
                $product = Product::latest();//Сортировка по дате

                $users = DB::table('cart')//Через leftjoin мы связываем 3 таблицы, за счет чего мы через одну переменную передаем все нужные нам данные, то есть мне это было нужно для вывода товаров в корзину, зная только id продуктов, я смог связать через этот id  product_id из таблицы cart, за счет чего я смог вывести в корзине все нужыне данные из двух таблизц, а также я еще связал id пользователя с user_id в таблице cart, за счет чего смог вывести только те товары которе добавил это пользователь
                ->leftJoin('product', 'cart.product_id', '=', 'product.id')
                    ->leftJoin('users', 'cart.user_id', '=', 'users.id')
                    ->select('product.name','product.price','cart.sum','product.id','cart.user_id','product.image','cart.id as cart_id')->where('users.id', '=', $user->id)->get();

                $Error_zakaz = "То количество товара которое вы хотите заказать, отсутствует. Осталось ".$productt[0]->count." единиц";
                return view('cart',[
                    'users'=>$users,
                    'cart'=>$cart->get(),//Возвращаем записи по нужно категории
                    'product'=>$product->get(),
                    'Error_zakaz'=>$Error_zakaz
                ]);
            }
            else{
                //dd($product[0]->price);

                $order = new Order;
                $order->product_id = $productt[0]->id;
                $order->sum = $request->sum;
                $order->user_id = $user->id;
                $order->price = $productt[0]->price*$request->sum;
                $order->save();

                //Обновляем количество данного товара
                $product= Product::where('id',$productt[0]->id)->first();
                //dd($productt[0]->count - $request->sum);
                $product->count = $productt[0]->count - $request->sum;
                $product->update($request->input());

                $cartt = Cart::where('id',$id)->first();
                if($cartt!==null)
                {
                    $cartt->delete();
                }

                $user = Auth::user()->makeHidden(['id']);//Получаем id зарегистрированного пользователя
                $cart = Cart::where('user_id',$user->id)->latest();//Выводим по id товары из корзины данного пользователя
                $product = Product::latest();//Сортировка по дате

                $users = DB::table('cart')//Через leftjoin мы связываем 3 таблицы, за счет чего мы через одну переменную передаем все нужные нам данные, то есть мне это было нужно для вывода товаров в корзину, зная только id продуктов, я смог связать через этот id  product_id из таблицы cart, за счет чего я смог вывести в корзине все нужыне данные из двух таблизц, а также я еще связал id пользователя с user_id в таблице cart, за счет чего смог вывести только те товары которе добавил это пользователь
                ->leftJoin('product', 'cart.product_id', '=', 'product.id')
                    ->leftJoin('users', 'cart.user_id', '=', 'users.id')
                    ->select('product.name','product.price','cart.sum','product.id','cart.user_id','product.image','cart.id as cart_id')->where('users.id', '=', $user->id)->get();



                $Ok_zakaz = "Заказ успешно оформлен";

                return view('cart',[
                    'users'=>$users,
                    'cart'=>$cart->get(),//Возвращаем записи по нужно категории
                    'product'=>$product->get(),
                    'OK_zakaz'=>$Ok_zakaz
                ]);

            }

        }
        else{
            //Получаем id зарегистрированного пользователя
            $cart = Cart::where('user_id',$user->id)->latest();//Выводим по id товары из корзины данного пользователя
            $product = Product::latest();//Сортировка по дате

            $users = DB::table('cart')//Через leftjoin мы связываем 3 таблицы, за счет чего мы через одну переменную передаем все нужные нам данные, то есть мне это было нужно для вывода товаров в корзину, зная только id продуктов, я смог связать через этот id  product_id из таблицы cart, за счет чего я смог вывести в корзине все нужыне данные из двух таблизц, а также я еще связал id пользователя с user_id в таблице cart, за счет чего смог вывести только те товары которе добавил это пользователь
            ->leftJoin('product', 'cart.product_id', '=', 'product.id')
                ->leftJoin('users', 'cart.user_id', '=', 'users.id')
                ->select('product.name','product.price','cart.sum','product.id','cart.user_id','product.image','cart.id as cart_id')->where('users.id', '=', $user->id)->get();
            $Error_zakaz = "Вы ввели неверные данные";
            return view('cart',[
                'users'=>$users,
                'cart'=>$cart->get(),//Возвращаем записи по нужно категории
                'product'=>$product->get(),
                'Error_zakaz'=>$Error_zakaz
            ]);
        }

    }
    //Удаление продукта по id
    public function delete_cart($id)
    {
        $cart = Cart::where('id',$id)->first();
        if($cart!==null)
        {
            $cart->delete();
        }

        $user = Auth::user()->makeHidden(['id']);//Получаем id зарегистрированного пользователя
        $cart = Cart::where('user_id',$user->id)->latest();//Выводим по id товары из корзины данного пользователя
        $product = Product::latest();//Сортировка по дате

        $users = DB::table('cart')//Через leftjoin мы связываем 3 таблицы, за счет чего мы через одну переменную передаем все нужные нам данные, то есть мне это было нужно для вывода товаров в корзину, зная только id продуктов, я смог связать через этот id  product_id из таблицы cart, за счет чего я смог вывести в корзине все нужыне данные из двух таблизц, а также я еще связал id пользователя с user_id в таблице cart, за счет чего смог вывести только те товары которе добавил это пользователь
        ->leftJoin('product', 'cart.product_id', '=', 'product.id')
            ->leftJoin('users', 'cart.user_id', '=', 'users.id')
            ->select('product.name','product.price','cart.sum','product.id','cart.user_id','product.image','cart.id as cart_id')->where('users.id', '=', $user->id)->get();

        return view('cart',[
            'users'=>$users,
            'cart'=>$cart->get(),//Возвращаем записи по нужно категории
            'product'=>$product->get(),
        ]);

    }


    public function index3(){//Вывод страницы
        $user = Auth::user()->makeHidden(['id']);//Получаем id зарегистрированного пользователя
        $cart = Cart::where('user_id',$user->id)->latest();//Выводим по id товары из корзины данного пользователя
        $product = Product::latest();//Сортировка по дате

        //Сортировка по полученному id категории
        foreach ($cart as $carts)
        {
           // if($carts){
                $product->where('id',$carts->product_id);
          // }
        }

        return view('cart',[
            'cart'=>$cart->get(),//Возвращаем записи по нужно категории
            'product'=>$product->get(),
        ]);
    }

    public function index2(){//Вывод страницы
        $user = Auth::user()->makeHidden(['id']);//Получаем id зарегистрированного пользователя
        $cart = Cart::where('user_id',$user->id)->get();//Выводим по id товары из корзины данного пользователя

        $product = Product::latest();//Сортировка по дате

        //Сортировка по полученному id категории
        foreach ($cart as $carts)
        {
            $carts->product_id;
        }
        if($carts){
            $product->where('category_id',$carts->product_id);
        }

        return view('cart',[
            'product'=>$product->get(),//Возвращаем записи по нужно категории
            'cart'=>$cart
        ]);
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
