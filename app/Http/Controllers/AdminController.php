<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\News;
use Request;

class AdminController
{
    // Для объекта модели админки
    protected $adminModel;
    // Для объекта модели новостей
    protected $newsModel;

    function __construct()
    {
        $this->adminModel = new Admin;
        $this->newsModel = new News;
    }

    // Основаная страница для админа
    public function Admin($alarm = false)
    {
        $news = $this->newsModel->renderAllNews();
        return view('Admin',['news' => $news, 'alarm' => $alarm]);
    }

    // Страничка создания новости
    public function NewsCreate($alarm = false)
    {
        $category = $this->adminModel->ByCategory();
        return view('AdminCreateNews', ['alarm' => $alarm, 'tableCategory' => $category]);
    }

    // Обработка создания новостей
    public function NewsCreatePOST()
    {
        $text = Request::input('text');
        $nameOfCategory = Request::input('category_id');
        $create = $this->adminModel->createThisNews($text, $nameOfCategory);
        return redirect()->route('NewsCreate',['alarm' => $create]);
    }

    // Обработка создания категорий новостей
    public function NewNewsCategory()
    {
        $category = Request::input('newCategory');
        $create = $this->adminModel->createNewsCategory($category);
        return redirect()->route('NewsCreate',['alarm' => $create]);
    }

    // Редактирование и удаление новостей
    public function NewsEditOrDelete()
    {
        $id = Request::input('id');
        $text = Request::input('text');
        $typeButton = Request::input('submit');

        $editDelete = $this->adminModel->editThisNewsOrDelete($id, $text, $typeButton);
        return redirect()->route('Admin',['alarm' => $editDelete]);
    }

}