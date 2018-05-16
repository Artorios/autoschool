@extends('layouts.autoschool')
@section('content')

    <div class="content error profile">
        <h1><a href="{{route('autoschool.index')}}">Главная</a> / Ученики</h1>
        <div class="blockforms student">
            <div class="searchform">
                <form>
                    <input type="text" placeholder="Введите что искать">
                    <button type="submit"><img src="img/search.png"></button>
                </form>
            </div>
            <ul class="dropforms">
                <li>
                    <select class="select">
                        <option selected disabled>ФИО ученика</option>
                        <option>Петров В.В.</option>
                        <option>Сидоров Г.А.</option>
                    </select>
                </li>
                <li>
                    <select class="select">
                        <option selected disabled>По дате</option>
                        <option>21.01.15</option>
                        <option>22.01.15</option>
                    </select>
                </li>
                <li><input id="date" type="text" placeholder="Дата" required=""></li>
            </ul>
            <div class="searchbut">
                <div class="button"><a href="#"><img src="img/search.png">Поиск по параметрам</a></div>
            </div>
        </div>
        <div class="studentgroupe">
            <h4>{{$group->name}}</h4>
            <ul>
                <li><span>№</span>ФИО ученика</li>
                <li>Группа</li>
                <li>Текущий урок</li>
                <li>Успеваемость</li>
                <li>Экзамен</li>
            </ul>
            @foreach($students as $key => $student)
                <ul>
                    <li><span>{{++$key}}</span><p><a href="#">{{$student->full_name}}</a></p></li>
                    <li><span>Группа</span><a href="">{{$student->autoschoolgroup->name}}</a></li>
                    <li><span>Текущий урок</span><p>Дорожные знаки. Предупреждающие знаки.</p></li>
                    <li><span>Успеваемость</span><p>80%</p></li>
                    <li><span>Экзамен</span><span>Экзамен в ГБДД</span> <a href="#">6 из 28</a></li>
                </ul>
            @endforeach
            <ul>
                <li><span>02</span><p><a href="#">Иванов И. В.</a></p></li>
                <li><span>Группа</span><a href="#">ИД-21</a></li>
                <li><span>Текущий урок</span><p>Приоритет МТС</p></li>
                <li><span>Успеваемость</span><p>80%</p></li>
                <li><span>Экзамен</span><span>Экзамен в ГБДД</span> <a href="#">28 из 28</a></li>
            </ul>
        </div>
        <div class="invitefilials num">
            <ul>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
            </ul>
        </div>
        <div class="addstudent">
            <a href="#">Добавить ученика</a>
        </div>
    </div>










    @endsection