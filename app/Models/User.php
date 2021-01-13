<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'newlogin',
        'newpass',
        'newname',
        'newsurname',
        'newemail',
        'login',
        'pass',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    /**
     * Регистрация пользователя
     * С проверкой, на существование вводимого логина
     */
    function registrNewUser($login, $pass, $name, $surname, $email)
    {
        if(!$login or !$pass or !$name or !$surname or !$email)
        {
            return "Заполните все поля!";
        }
        else 
        {
            return $this->checkRegUser($login, $pass, $name, $surname, $email);
        }
    }

    /**
     * Логика регистрации пользователя
     */
    function checkRegUser($login, $pass, $name, $surname, $email)
    {
        if($login)
        {
            $select = DB::table('test')->where('login', $login)->get()->toArray();
   
            if(!$select)
            {
                $add = DB::table('test')->insert([
                    'login' => $login,
                    'password' => $pass,
                    'name' => $name,
                    'surname' => $surname,
                    'email' => $email
                ]);
            
                session(['user' => $login]);
                return "Вы успешно вошли, $login. Добро пожаловать!";
            }
            else 
            {
                return 'Такой пользователь уже существует';
            }
        }    
    }

    /**
     * Авторизация пользователя. Проверка логина и пароля по БД
     */
    function Auth($login, $pass)
    {
        if($login)
        {
            // Обычного пользователя ищем
            $select = DB::table('test')->where('login', $login)->where('user_status', 0)->get()->toArray();
            // Администратора ищем
            $selectAdmins = DB::table('test')->where('login', $login)->where('user_status', 1)->get()->toArray();

            if($select)
            {
                return $this->checkAuthUser($login, $pass);
            }
            elseif($selectAdmins)
            {
                return $this->checkAuthAdmin($login, $pass);
            }
            else
            {
                return 'Такого логина не существует, пройдите регистрацию';
            }
        }
    }

    /**
     * Логика проверки пользователя при авторизации
     */
    function checkAuthUser($login, $pass)
    {
        if($pass)
        {
            $select = DB::table('test')->where('login', $login)->where('password', $pass)->get();
            session(['user' => $login]);
            return "Привет, $login";
        }
        else 
        {
            return 'Пароль неверный';
        }
    }

    /**
     * Логика проверки администратора при авторизации
     */
    function checkAuthAdmin($login, $pass)
    {
        if($pass)
        {
            $checkPassAdmin = DB::table('test')->where('login', $login)->where('password', $pass)->get();
            session(['admin' => $login]);
            return "Привет администратор, $login";
        }
        else 
        {
            return 'Пароль неверный';
        }
    }

    /**
     * Получаем информацию о пользователе для личного кабинета ( а может и не только)
     * Проверку делаем по сессии, session('user') и session('admin')
     */
    function getInfoAboutUser($login = false, $admin = false)
    {
        if($login)
        {
            $select = DB::table('test')->where('login', $login)->get();
            return $select;
        }
        elseif($admin)
        {
            $select = DB::table('test')->where('login', $admin)->get();
            return $select;
        }
    }

}
