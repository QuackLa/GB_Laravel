<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
   
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'text',
        'submit',
        'newCategory',
        'category_id'
    ];


    /**
     * Логика добавления новости
     */
    function createThisNews($text, $category)
    {
        if($text && $category)
        {
            $add = DB::table('news')
            ->insert([
                'body' => $text,
                'category_id' => $category,
                'created_at' => Carbon::now()
            ]);

            return 'Новость успешно добавлена';
        }
        elseif(!$text)
        {
            return 'Новость не может быть пустой';
        }
        elseif(!$category)
        {
            return 'Не выбрана категория для новой новости';
        }
    }  

    /**
     * Логика создания категории
     */
    function createNewsCategory($name)
    {
        // Проверяем, нет ли уже созданной категории с выбранным названием
        $select = DB::table('news_category')->where('name', $name)->get()->toArray();

        if(!$select) // Если такой категории ещё нет, то создаём её
        {
            $newCategory = DB::table('news_category')
                ->insert([
                    'name' => $name,
                    'created_at' => Carbon::now()
                ]);

            return 'Категория успешно добавлена';
        }
        else
        {
            return 'Категория с таким названием уже существует';
        }
    }

    /**
     * Логика изменения или удаления новости
     */
    function editThisNewsOrDelete($id, $text, $typeButton)
    {
        if($typeButton == 'edit' && $text && $id)
        {
            $editNews = DB::table('news')->where('id', $id)
                ->update([
                    'body' => $text,
                    'updated_at' => Carbon::now(),
                    'id' => $id
                ]);

            return 'Новость успешно обновлена';
        }
        elseif($typeButton == 'edit' && !$id && $text)
        {
            return 'Не выбрана новость для редактирования';
        }
        elseif($typeButton == 'edit' && $id && !$text)
        {
            return 'Не заполнено поле с текстом';
        }
        elseif($typeButton == 'edit' && !$id && !$text)
        {
            return 'Не выбрана новость для редактирования и не заполнено поле с текстом';
        }
        elseif($typeButton == 'delete')
        {
            return $this->deleteThisNews($id);
        }
    }

    /**
     * Отдельно логика удаления новости
     */
    function deleteThisNews($id)
    {
        if($id)
        {
            $deleteNews = DB::table('news')->where('id', $id)->delete();
            return 'Удаление новости прошло успешно';
        }
        else 
        {
            return 'Не выбрана новость для удаления';
        }
    }

}