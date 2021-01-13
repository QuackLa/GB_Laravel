<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    
    protected $model; // Для объекта модели новостей

    function __construct(Request $request)
    {
        $this->model = new News;
        $this->model->fill($request->all());
    }

    /**
     * Выводим все новости
     */
    public function CatNews()
    {
        $news = $this->model->renderAllNews();
        return view('CatNews', ['news' => $news]);
    }

    /**
     * Новости по категориям
     */
    public function NewsByCat()
    {
        $checkButton = $this->model->choseCategory;
        $category = $this->model->onlyCategory();
        $news = $this->model->renderNewsByCat($this->model->choseCategory);
        return view('NewsByCat', ['cat' => $category, 'news' => $news, 'checkButton' => $checkButton]);
    }

    /**
     * Вывод одной выбранной новости
     */
    public function OneNews($id = false)
    {
        return view('OneNews', ['id' => $id]);
    }

}
