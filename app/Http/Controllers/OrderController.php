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

class OrderController extends Controller
{
    public function create(){//Вывод страницы
        return view('cart');
    }

    public function index(){//Вывод страницы
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
    public function order()
    {
        $user = Auth::user()->makeHidden(['id']);//Получаем id зарегистрированного пользователя
        $cart = Cart::where('user_id',$user->id)->latest();//Выводим по id товары из корзины данного пользователя
        $product = Product::latest();//Сортировка по дате

        $users = DB::table('order')//Через leftjoin мы связываем 3 таблицы, за счет чего мы через одну переменную передаем все нужные нам данные, то есть мне это было нужно для вывода товаров в корзину, зная только id продуктов, я смог связать через этот id  product_id из таблицы cart, за счет чего я смог вывести в корзине все нужыне данные из двух таблизц, а также я еще связал id пользователя с user_id в таблице cart, за счет чего смог вывести только те товары которе добавил это пользователь
        ->leftJoin('product', 'order.product_id', '=', 'product.id')
            ->leftJoin('users', 'order.user_id', '=', 'users.id')
            ->select('product.name','product.price','order.sum','product.id','order.user_id','product.image','order.product_id','order.status','order.resons','order.id as order_id','order.price')->where('users.id', '=', $user->id)->get();

        return view('order',[
            'users'=>$users,
            'cart'=>$cart->get(),//Возвращаем записи по нужно категории
            'product'=>$product->get(),
        ]);
    }

    //Удаление продукта по id
    public function delete_order($id)
    {
        $orderr = Order::where('id',$id)->get();
        $order = Order::where('id', $id)->first();
        if($order!==null) {
            if ($orderr[0]->status == "Новый") {

                $order->delete();


                $user = Auth::user()->makeHidden(['id']);//Получаем id зарегистрированного пользователя
                $cart = Cart::where('user_id', $user->id)->latest();//Выводим по id товары из корзины данного пользователя
                $product = Product::latest();//Сортировка по дате

                $users = DB::table('order')//Через leftjoin мы связываем 3 таблицы, за счет чего мы через одну переменную передаем все нужные нам данные, то есть мне это было нужно для вывода товаров в корзину, зная только id продуктов, я смог связать через этот id  product_id из таблицы cart, за счет чего я смог вывести в корзине все нужыне данные из двух таблизц, а также я еще связал id пользователя с user_id в таблице cart, за счет чего смог вывести только те товары которе добавил это пользователь
                ->leftJoin('product', 'order.product_id', '=', 'product.id')
                    ->leftJoin('users', 'order.user_id', '=', 'users.id')
                    ->select('product.name', 'product.price', 'order.sum', 'product.id', 'order.user_id', 'product.image', 'order.product_id', 'order.status', 'order.resons', 'order.id as order_id','order.price')->where('users.id', '=', $user->id)->get();

                $Ok_zakaz = "Заказ был успешно удален";
                return view('order', [
                    'users' => $users,
                    'cart' => $cart->get(),//Возвращаем записи по нужно категории
                    'product' => $product->get(),
                    'Ok_zakaz' => $Ok_zakaz

                ]);
            } else {
                $user = Auth::user()->makeHidden(['id']);//Получаем id зарегистрированного пользователя
                $cart = Cart::where('user_id', $user->id)->latest();//Выводим по id товары из корзины данного пользователя
                $product = Product::latest();//Сортировка по дате

                $users = DB::table('order')//Через leftjoin мы связываем 3 таблицы, за счет чего мы через одну переменную передаем все нужные нам данные, то есть мне это было нужно для вывода товаров в корзину, зная только id продуктов, я смог связать через этот id  product_id из таблицы cart, за счет чего я смог вывести в корзине все нужыне данные из двух таблизц, а также я еще связал id пользователя с user_id в таблице cart, за счет чего смог вывести только те товары которе добавил это пользователь
                ->leftJoin('product', 'order.product_id', '=', 'product.id')
                    ->leftJoin('users', 'order.user_id', '=', 'users.id')
                    ->select('product.name', 'product.price', 'order.sum', 'product.id', 'order.user_id', 'product.image', 'order.product_id', 'order.status', 'order.resons', 'order.id as order_id','order.price')->where('users.id', '=', $user->id)->get();
                $Error_zakaz = "Ошибка. Можно удалить только те заказы у которых статус \"Новый\", а у вашего заказа статус \"" . $orderr[0]->status . "\". За помощью обратитесь в службу поддержки";
                return view('order', [
                    'users' => $users,
                    'cart' => $cart->get(),//Возвращаем записи по нужно категории
                    'product' => $product->get(),
                    'Error_zakaz' => $Error_zakaz

                ]);
            }
        }
        else{
            $user = Auth::user()->makeHidden(['id']);//Получаем id зарегистрированного пользователя
            $cart = Cart::where('user_id', $user->id)->latest();//Выводим по id товары из корзины данного пользователя
            $product = Product::latest();//Сортировка по дате

            $users = DB::table('order')//Через leftjoin мы связываем 3 таблицы, за счет чего мы через одну переменную передаем все нужные нам данные, то есть мне это было нужно для вывода товаров в корзину, зная только id продуктов, я смог связать через этот id  product_id из таблицы cart, за счет чего я смог вывести в корзине все нужыне данные из двух таблизц, а также я еще связал id пользователя с user_id в таблице cart, за счет чего смог вывести только те товары которе добавил это пользователь
            ->leftJoin('product', 'order.product_id', '=', 'product.id')
                ->leftJoin('users', 'order.user_id', '=', 'users.id')
                ->select('product.name', 'product.price', 'order.sum', 'product.id', 'order.user_id', 'product.image', 'order.product_id', 'order.status', 'order.resons', 'order.id as order_id','order.price')->where('users.id', '=', $user->id)->get();
            $Error_zakaz = "Ошибка. Вы пытаетесь удалить не существующий заказ или вы его ранее уже удаляли";
            return view('order', [
                'users' => $users,
                'cart' => $cart->get(),//Возвращаем записи по нужно категории
                'product' => $product->get(),
                'Error_zakaz' => $Error_zakaz

            ]);
        }



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
