<header>
    <a href="{{ route('welcome') }}">Страница приветствия</a>
    <a href="{{ route('CatNews') }}">Основная страница новостей</a>
    <a href="{{ route('NewsByCat') }}">Выбрать категорию</a>
    <a href="{{ route('OneNews', ['id' => '']) }}">Конкретная новость</a>
</header>
