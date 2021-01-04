<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    // Логика добавления новости
    function createThisNews($text, $category)
    {
        $add = DB::insert('INSERT INTO news (`body`, `category_id`, `created_at`) VALUES (:text , :category, :now)',
        ['text' => $text, 'category' => $category, 'now' => Carbon::now()]);
        return 'Новость успешно добавлена';
    }  


    // Логика создания категории
    function createNewsCategory($name)
    {
        $newCategory = DB::insert('INSERT INTO news_category (`name`, `created_at`) VALUES (:name, :now)',
        ['name' => $name, 'now' => Carbon::now()]);
        return 'Категория успешно добавлена';
    }


    // Логика изменения или удаления новости
    function editThisNewsOrDelete($id, $text, $typeButton)
    {
        if($typeButton == 'edit' && $text && $id)
        {
            $editNews = DB::update('UPDATE news SET body = :body, updated_at = :update WHERE id = :id',
            ['body' => $text, 'update' => Carbon::now(), 'id' => $id]);
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


    // Отдельно логика удаления новости
    function deleteThisNews($id)
    {
        if($id)
        {
            $deleteNews = DB::delete('DELETE FROM news WHERE id = :id' ,
            ['id' => $id]);
            return 'Удаление новости прошло успешно';
        }
        else 
        {
            return 'Не выбрана новость для удаления';
        }
    }


    // Выгрузка категорий новостей
    function ByCategory()
    {
        $select = DB::select('SELECT * FROM news_category', []);
        return $select;
    }


}