<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    // Для объекта модели новостей
    protected $model;

    function __construct()
    {
        $this->model = new News;
    }

    // Выводим все новости
    public function CatNews()
    {
        $news = $this->model->renderAllNews();
        return view('CatNews', ['news' => $news]);
    }

    // Новости по категориям
    public function NewsByCat(Request $request, $id = false)
    {
        $id = $request->get('choseCategory');
        $category = $this->model->onlyCategory();
        $news = $this->model->renderNewsByCat($id);
        return view('NewsByCat', ['cat' => $category, 'news' => $news]);
    }

    // Вывод одной выбранной новости
    public function OneNews($id = false)
    {
        return view('OneNews', ['id' => $id]);
    }

}
