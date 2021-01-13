<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'choseCategory',
    ];


    /**
     * Выборка всех новостей
     */
    function renderAllNews()
    {
        $select = static::query()->get();
        return $select;
    }

    /**
     * Выборка новостей по категориям
     */
    function renderNewsByCat($idByCat)
    {
        $select = static::query()->where('category_id', $idByCat )->get();
        return $select;
    }

    /**
     * Выгрузка категорий новостей
     */
    function onlyCategory()
    {
        $select = DB::table('news_category')->get();
        return $select;
    }
    
}