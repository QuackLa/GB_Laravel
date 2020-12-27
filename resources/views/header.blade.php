<header>
    <a href="{{ route('main') }}">Главная страница</a>
    <a href="{{ route('CatNews') }}">Основная страница новостей</a>
    <a href="{{ route('NewsByCat') }}">Выбрать категорию</a>
    <a href="{{ route('OneNews', ['id' => '']) }}">Конкретная новость</a>
    <br><br>
    <a href="{{ route('EnterUser') }}">Войти</a>
</header>
