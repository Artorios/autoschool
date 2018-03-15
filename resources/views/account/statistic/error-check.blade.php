@extends('layouts.account')

@section('content')
<div class="content error">
    <div class="breadcrumbs">
        <ul>
            <li><a href="#">Главная</a></li>
            <li><a href="#">Статистика (Успеваемость)</a></li>
            <li>Разбор ошибок</li>
        </ul>
    </div>
    <h4>Разбор ошибок:</h4>
    <span>Урок № 02</span>
    <a href="#">Предупреждающие знаки</a>
    <span>Всего<span>5</span>ошибок</span>
    <div class="video-wrapper">
        <img src="/img/video.png" alt="">
    </div>
    <span>Ошибка № 1</span>
    <h5>Какие из указанных знаков устанавливают непосредственно перед железнодорожным переездом</h5>
    <form class="variants">
        <input type="radio" checked name="variant" id="typeA">
        <label for="typeA">Только А</label>
        <input type="radio" name="variant" id="typeB">
        <label for="typeB">Только Б</label>
        <input type="radio" name="variant" id="typeC">
        <label class="correct" for="typeC">Только В</label>
        <input type="radio" name="variant" id="typeD">
        <label for="typeD">А и Б</label>
    </form>
    <div class="comment">
        <img src="/img/attention.png" alt="">
        <h5>Комментарий</h5>
        <p>Перед нами информационный знак (Пр.1.р.6) «Место для разворота» (Пр.1.р.6.п.6.3.1). Проехать прямо по направлению «А» знак не запрещает. Также можно развернуться по траектории «В». А вот вариант с поворотом налево, то есть «Б», вызывает вот росы. Представим, что для поворота налево нам придется пересечь без перестроений две полосы. Это может быть просто очень опасно. На всякий случай, травила затрещают поворачивать налево в местах установки знака «Место для разворота» (Пр.1.р.6.п.6.3.1). Так что ехать можно по направлению траектории А и В. <span>Правильный вариант - 2.</span></p>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link active" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
        </ul>
    </nav>
</div>

@endsection