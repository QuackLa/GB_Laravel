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
        'name',
        'email',
        'password',
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
     * Логика регистрации пользователя
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
            if($login)
            {
                $select = DB::select('SELECT * FROM test WHERE login = ?', [$login]);
    
                if(empty($select))
                {
                    $add = DB::insert('INSERT INTO `test` (`login`, `password`, `name`, `surname`, `email`) 
                    values (:login, :password, :name, :surname, :email)',
                    ['login' => $login, 'password' => $pass, 'name' => $name, 'surname' => $surname, 'email' => $email]);
                    session(['user' => $login]);
    
                    return "Вы успешно вошли, $login. Добро пожаловать!";
                }
                else 
                {
                    return 'Такой пользователь уже существует';
                }
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
            $select = DB::select('SELECT * FROM test WHERE login = :login AND user_status = :user_status', 
            ['login' => $login, 'user_status' => 0]);
            // Администратора ищем
            $selectAdmins = DB::select('SELECT * FROM test WHERE login = :login AND user_status = :user_status', 
            ['login' => $login, 'user_status' => 1]);

            // Если админ с таким логином найден, то проверяем пароль и даём доступ
            if($selectAdmins)
            {
                if($pass)
                {
                    $checkPassAdmin = DB::select('SELECT * FROM test WHERE login = :login AND password = :pass', 
                    ['login' => $login, 'pass' => $pass]);
                    session(['admin' => $login]);

                    return "Привет администратор, $login";
                }
                else 
                {
                    return 'Пароль неверный';
                }
            }

            // Аналогичная проверка для обычного пользователя
            if(empty($select)) 
            {
                return 'Такого логина не существует, пройдите регистрацию';
            }
            elseif($select)
            {
                if($pass)
                {
                    $select = DB::select('SELECT * FROM test WHERE login = :login AND password = :pass', 
                    ['login' => $login, 'pass' => $pass]);
                    session(['user' => $login]);

                    return "Привет, $login";
                }
                else 
                {
                    return 'Пароль неверный';
                }
            }
        }
    }

    /**
     * Получаем информацию о пользователе для личного кабинета ( а может и не только)
     */
    function getInfoAboutUser($login)
    {
        $select = DB::select('SELECT * FROM test WHERE login = :login', ['login' => $login]);
        return $select;
    }

}
