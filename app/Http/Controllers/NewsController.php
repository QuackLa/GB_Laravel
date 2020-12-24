<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function CatNews()
    {
        return view('CatNews');
    }

    public function NewsByCat()
    {
        return view('NewsByCat');
    }

    public function OneNews($id = false)
    {
        return view('OneNews', ['id' => $id]);
    }

}
