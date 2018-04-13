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
        <h4>Групповой зачет по теммам:</h4>
        @foreach(session('lessons') as $lesson)
            <p>Урок № {{$lesson['lesson_num']}} {{$lesson['title']}}</p>
        @endforeach
        <div class="error-access">
            <h4>Приступить к выполнению зачета можно не раньше чем через {{session('minutes')}} минут</h4>
            <p>Мы рекомендуем вам снова просмотреть соответствующие уроки и пройти тренировки</p>
            @foreach(session('lessons') as $lesson)
                <p>Перейти к уроку <a href="/account/lessons/{{$lesson['id']}}">"{{$lesson['title']}}"</a></p>
            @endforeach
        </div>

    </div>
@endsection