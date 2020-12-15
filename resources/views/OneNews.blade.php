@extends('main')

@section('head')
    <link rel="stylesheet" href="../../resources/css/main.css">
@endsection


@section('header')
<header>
    <a href="../welcome">Страница приветствия</a>
    <a href="../CatNews">Основная страница новостей</a>
    <a href="../NewsByCat">Выбрать категорию</a>
    <a href="../OneNews/{{ 'id' or '' }}">Конкретная новость</a>
</header>
@endsection


@section('content')
    <h3>Новость номер {{ $id }}</h3>
    <div>Некий текст новости</div>
@endsection