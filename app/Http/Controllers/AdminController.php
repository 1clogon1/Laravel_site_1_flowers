<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function index()
    {
        return view("admin");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //Возвращаемся на страницу к обновленным продуктам
        $product = Product::latest()->get();
        $category = Category::latest()->get();
        $order = Order::latest()->get();

        return view('admin',[
            'product'=>$product,
            'category'=>$category,
            'order'=>$order

        ]);
    }
    public function category_spisok(){//Вывод страницы
        $category = Category::get();
        return view('admin',[
            'category'=>$category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */

    public function store(Request $request){

        ///Проверка данных
        $request->validate([
            'name'=>['required','string'],
            'surname'=>['required','string'],
            'patronymic'=>['required','string'],
            'login'=>['required','string'],
            'email'=>['required','string','email','unique:users'],
            'password'=>['required','confirmed','min:8'],

        ]);

        //Полученные данные(Создаем пользователя - регистрация)
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),//Hash::make - хэшируем пароль
        ]);

        //Аунтефикация(Сразу после регистрации аутентифицируемся)
        Auth::login($user);

        //Переадресация(переходим на страницу пользователя)
        return redirect()->route('admin');
    }
   /* public function create_product(Request $request)
    {

        $error = Validator::make($request->all(), [
            'name'=>['required','string'],
            'price'=>['required','string'],
            'country'=>['required','string'],
            // 'category_id'=>['required','string'],
            'count'=>['required','string'],
            'color'=>['required','string'],
            'photo'=>'required|mimes:png',
        ]);
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->country = $request->country;
       // $product->category_id = $request->category_id;
        $product->count = $request->count;
        $product->color = $request->color;
        $product->photo = $request->file('photo')->store('public/images');
        $product->save();

        return redirect()->route('admin');
    }*/

    public function create_product(Request $request)
    {
        $error = Validator::make($request->all(), [
            'name'=>['required','string'],
            'price'=>['required','string'],
            'country'=>['required','string'],
             'category_id'=>['required','string'],
            'count'=>['required','string'],
            'color'=>['required','string'],
            'image' => ['required','mimes:png'],
        ]);//1024

        $productt = new Product;
        $productt->name = $request->name;
        $productt->price = $request->price;
        $productt->country = $request->country;
         $productt->category_id = $request->category_id;
        $productt->count = $request->count;
        $productt->color = $request->color;
        $productt->image = $request->file('image')->store('uploads','public');

        $productt->save();

        //Возвращаемся на страницу к обновленным продуктам
        $product = Product::latest()->get();
        $category = Category::latest()->get();
        $order = Order::latest()->get();

        return view('admin',[
            'product'=>$product,
            'category'=>$category,
            'order'=>$order

        ]);

    }



    public function create_category(Request $request)
    {
        $request->validate([
            'category'=>['required','string','unique:category'],
        ]);

        //Полученные данные(Создаем пользователя - регистрация)
        $Category = Category::create([
            'category' => $request->category,
        ]);

        //Возвращаемся на страницу к обновленным продуктам
        $product = Product::latest()->get();
        $category = Category::latest()->get();
        $order = Order::latest()->get();

        return view('admin',[
            'product'=>$product,
            'category'=>$category,
            'order'=>$order

        ]);
    }



    //Удаление продукта по id
    public function delete_product($id)
    {
        $product = Product::where('id',$id)->first();
            if($product!==null)
            {
                //File::delete($product->image);
                Storage::delete($product->image); // If $file is path to old image
                $product->delete();
            }

        //Возвращаемся на страницу к обновленным продуктам
        $product = Product::latest()->get();
        $category = Category::latest()->get();
        $order = Order::latest()->get();

        return view('admin',[
            'product'=>$product,
            'category'=>$category,
            'order'=>$order

        ]);

    }

    public function update_product(Request $request, $id)
    {
        //Продукт под данным id
        $product = Product::where('id',$id)->first();

            //Проверяем
        $error = Validator::make($request->all(), [
            'name'=>['required','string'],
            'price'=>['required','string'],
            'country'=>['required','string'],
            'category_id'=>['required','string'],
            'count'=>['required','string'],
            'color'=>['required','string'],
            'image' => ['required','mimes:png'],
        ]);

        //Удаляем старое фото

        //Заполняем
            $product->name = $request->name;
            $product->price = $request->price;
            $product->country = $request->country;
            $product->category_id = $request->category_id;
            $product->count = $request->count;
            $product->color = $request->color;

            if ($request->file('image')) {//Если мы добавили фотографию, то тогда можно удалить предыдущую и добавить новую в место нее
                Storage::delete($product->image); // If $file is path to old image
                $product->image = $request->file('image')->store('uploads','public');
             }
            $product->update($request->input());

        //Возвращаемся на страницу к обновленным продуктам
        $product = Product::latest()->get();
        $category = Category::latest()->get();
        $order = Order::latest()->get();

        return view('admin',[
            'product'=>$product,
            'category'=>$category,
            'order'=>$order

        ]);
    }


    public function update_category(Request $request, $id)
    {
        //Продукт под данным id
        $category = Category::where('id',$id)->first();

        //Проверяем
        $error = Validator::make($request->all(), [
            'category'=>['required','string'],
        ]);

        //Заполняем
        $category->category = $request->category;
        $category->update($request->input());

        //Возвращаемся на страницу к обновленным продуктам
        $product = Product::latest()->get();
        $category = Category::latest()->get();
        $order = Order::latest()->get();

        return view('admin',[
            'product'=>$product,
            'category'=>$category,
            'order'=>$order

        ]);
    }

    public function update_order(Request $request, $id)
    {
        //Продукт под данным id
        $order= Order::where('id',$id)->first();

        //Проверяем
        $error = Validator::make($request->all(), [
           'status'=>['required','string'],
            'resons'=>['required','string'],

        ]);

        //Заполняем

        if ($request->status) {//Если мы добавили фотографию, то тогда можно удалить предыдущую и добавить новую в место нее
            $order->status = $request->status;
        }

        if ($request->resons) {//Если мы добавили фотографию, то тогда можно удалить предыдущую и добавить новую в место нее
            $order->resons = $request->resons;
        }




        $order->update($request->input());

        //Возвращаемся на страницу к обновленным продуктам
        $product = Product::latest()->get();
        $category = Category::latest()->get();
        $order = Order::latest()->get();

        return view('admin',[
            'product'=>$product,
            'category'=>$category,
            'order'=>$order

        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
