<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{


    /**
     * Для объекта модели
     */
    protected $user;

    function __construct()
    {
        $this->user = new User;
    }

    /**
     * Форма для входа пользователя. С возможностью перехода в регистрацию.
     * Так же сообщения об успехе или неудачи этих действий.
     */
    public function EnterUser($alarm = false)
    {
        return view('Auth',['alarm' => $alarm]);
    }

    /** Форима для регистрации */
    public function WannaReg($alarm = false)
    {
        return view('RegUser',['alarm' => $alarm]);
    }

    /** Регистрация пользователя с отправкой результатов во вьюшку с помощью редиректа */
    public function RegUser(Request $request)
    {
        $login = $request->input('newlogin');
        $pass = $request->input('newpass');
        $name = $request->input('newname');
        $surname = $request->input('newsurname');
        $email = $request->input('newemail');

        $addUser = $this->user->registrNewUser($login,$pass,$name,$surname,$email);
        return redirect()->route('EnterUser', ['alarm' => $addUser]);
    }

    /** Авторизация пользователя с отправкой результатов во вьюшку с помощью редиректа */
    public function AuthUser(Request $request)
    {
        $login = $request->input('login');
        $pass = $request->input('pass');

        $checkUser = $this->user->Auth($login, $pass);
        return redirect()->route('EnterUser', ['alarm' => $checkUser]);
    }

    /** Личный кабинет пользователя или админа */
    public function LC()
    {
        if(session('user'))
        {
            $info = $this->user->getInfoAboutUser(session('user'));
            return view('LC', 
            [
                'info' => $info
            ]);
        }
        elseif(session('admin'))
        {
            $info = $this->user->getInfoAboutUser(session('admin'));
            return view('LC', 
            [
                'info' => $info
            ]);
        }
    }

    /** Пользователь выходит с сайта */
    public function Logout()
    {
        //Auth::logout();
        session()->forget('user');
        session()->forget('admin');
        return view('welcome');
    }

}