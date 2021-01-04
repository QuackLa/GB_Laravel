<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class News extends Authenticatable
{

    // Выборка всех новостей
    function renderAllNews()
    {
        $select = DB::select('SELECT * FROM news' , []);
        return $select;
    }

    // Выборка новостей по категориям
    function renderNewsByCat($idByCat)
    {
        $select = DB::select('SELECT * FROM news JOIN news_category ON category_id = news_category.id WHERE category_id = :id', 
        ['id' => $idByCat]);
        return $select;
    }

    // Выгрузка категорий новостей
    function onlyCategory()
    {
        $select = DB::select('SELECT * FROM news_category', []);
        return $select;
    }

}