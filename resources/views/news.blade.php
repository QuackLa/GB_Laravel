<?php
    // Если информация о кол-ве новостей не получена, то предполагаем, что будет одна новость
    $default = 1;
    // Если информация о кол-ве новостей есть, то используем её
    //if($newsCounter)
    //{
        //$default = $newsCounter;
    //}
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <header>
        <a href="../../public/index.php">Страница приветствия</a>
        <a href="../views/info.blade.php">Страница с информацией о проекте</a>
    </header>
    <body>
        <table>
        <?php for($n = 1; $n <= $default; ++$n):?>
            <tr>
                <td>
                    <div>Новость <?=$n?></div>
                    <div>Сегодня в мире... Что-то случилось</div>
                </td>
            </tr>
        <?php endfor; ?>
        </table>
    </body>
</html>