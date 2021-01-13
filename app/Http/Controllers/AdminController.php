<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MyRequest;

class AdminController extends Controller
{

    protected $adminModel; // Для объекта модели админки
    protected $newsModel; // Для объекта модели новостей

    function __construct(Request $request)
    {
        $this->adminModel = new Admin;
        $this->newsModel = new News;
        $this->adminModel->fill($request->all());
    }

    /**
     * Основаная страница для админа
     */
    public function Admin($alarm = false)
    {
        $news = $this->newsModel->renderAllNews();
        return view('Admin',['news' => $news, 'alarm' => $alarm]);
    }
  
    /**
     * Страничка создания новости
     */
    public function NewsCreate($alarm = false)
    {
        $category = $this->newsModel->onlyCategory();
        return view('AdminCreateNews', ['alarm' => $alarm, 'tableCategory' => $category]);
    }

    /**
     * Обработка создания новостей
     */
    public function NewsCreatePOST(MyRequest $request)
    {
        $create = $this->adminModel->createThisNews($this->adminModel->text, $this->adminModel->category_id);
        return redirect()->route('NewsCreate')->with('success', 'Новость успешно добавлена');
    }

    /**
     * Обработка создания категорий новостей
     */
    public function NewNewsCategory()
    {
        $create = $this->adminModel->createNewsCategory($this->adminModel->newCategory);
        return redirect()->route('NewsCreate', ['alarm' => $create]);
    }

    /**
     * Редактирование и удаление новостей
     */
    public function NewsEditOrDelete()
    {
        $model = $this->adminModel;
        $editDelete = $model->editThisNewsOrDelete($model->id, $model->text, $model->submit);
        return redirect()->route('Admin',['alarm' => $editDelete]);
    }

}