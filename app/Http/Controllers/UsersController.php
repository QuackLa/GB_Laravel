<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{

    protected $user; // Для объекта модели

    function __construct(Request $request)
    {
        $this->user = new User;
        $this->user->fill($request->all());
    }

    /**
     * Форма для входа пользователя. С возможностью перехода в регистрацию.
     * Сюда же выводим сообщения об успехе или неудачи этих действий.
     */
    public function EnterUser($alarm = false)
    {
        return view('Auth',['alarm' => $alarm]);
    }

    /**
     * Форима для регистрации 
     */
    public function WannaReg($alarm = false)
    {
        return view('RegUser',['alarm' => $alarm]);
    }

    /** 
     * Регистрация пользователя с отправкой результатов во вьюшку с помощью редиректа
     */
    public function RegUser()
    {
        $model = $this->user;
        $addUser = $model->registrNewUser(
            $model->newlogin, 
            $model->newpass, 
            $model->newname,
            $model->newsurname,
            $model->newemail
        );
        return redirect()->route('EnterUser', ['alarm' => $addUser]);
    }

    /**
     * Авторизация пользователя с отправкой результатов во вьюшку с помощью редиректа
     */
    public function AuthUser()
    {
        $checkUser = $this->user->Auth($this->user->login, $this->user->pass);
        return redirect()->route('EnterUser', ['alarm' => $checkUser]);
    }

    /** 
     * Личный кабинет пользователя или админа
     */
    public function LC()
    {
        $login = session('user');
        $admin = session('admin');

        $info = $this->user->getInfoAboutUser($login, $admin);
        return view('LC', ['info' => $info]);
    }

    /**
     * Пользователь выходит с сайта 
     */
    public function Logout()
    {
        session()->forget('user');
        session()->forget('admin');
        return view('welcome');
    }

}