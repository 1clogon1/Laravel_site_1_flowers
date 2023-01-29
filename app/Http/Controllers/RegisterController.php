<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{


    public function create(){
        //dd(session()->all());//Просмотр всех данных
        //dd(old());//Просмотр страх введенных данных
        return view('register');
    }

    public function store(Request $request){


//Проверка данных
            $request->validate([
                'name'=>['required','string'],
                'surname'=>['required','string'],
                'patronymic'=>['required','string'],
                'login'=>['required','string','unique:users'],
                'email'=>['required','string','email','unique:users'],
                'password'=>['required','confirmed','min:8'],
                'checkbox'=>[],
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
            return redirect(RouteServiceProvider::HOME);


    }
}
