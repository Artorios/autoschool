@extends('layouts.account')


@section('content')
    <div class="content error training">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/account">Главная</a></li>
                <li><a href="/account/lessons">Уроки</a></li>
                <li><a href="/account/lessons/{{session('lesson')['id']}}">Урок №{{session('lesson')['lesson_num']}}</a></li>
                <li>Зачет</li>
            </ul>
        </div>
        <h4>Зачет по теме:</h4>
        <span>Урок № {{session('lesson')['lesson_num']}}</span>
        <span class="ex-title"> {{session('lesson')['title']}}</span>
        <div class="error-access">
            <h4>Приступить к выполнению зачета можно не раньше чем через {{session('minutes')}} минут</h4>
            <p>Мы рекомендуем вам еще раз посмотреть урок и пройти тренировку</p>
            <a href="/account/lessons/{{session('lesson')['id']}}">Перейти к уроку "{{session('lesson')['title']}}"</a>
        </div>

    </div>
@endsection