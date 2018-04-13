@extends('layouts.autoschool')
@section('content')

        <div class="content error profile">
            <h1><a href="#">Главная</a></h1>
            <div class="numberpeople">
                <ul>
                    <li>
                        <p>Количество учеников:</p>
                        <span>42</span>
                    </li>
                    <li>
                        <p>Количество свободных купонов:</p>
                        <span>15</span>
                    </li>
                    <li>
                        <p>Общий доход филиала:</p>
                        <span>1000000</span>
                    </li>
                </ul>
            </div>
            <div class="blockgroupe">
                <h2>Группы:</h2>
                <ul>
                    <li><span>№</span>Название группы</li>
                    <li>Дата и время экзамена</li>
                    <li>Кол-во учеников</li>
                </ul>
                <ul>
                    <li><span>01</span><span><a href="#">ИД-21</a></span></li>
                    <li><img src="img/clock.png"> 02.09.2017  18:00</li>
                    <li><span>Кол-во учеников</span>8</li>
                </ul>
                <ul>
                    <li><span>02</span><span><a href="#">Группа супер</a></span></li>
                    <li><img src="img/clock.png"> 02.09.2017  18:00</li>
                    <li><span>Кол-во учеников</span>8</li>
                </ul>
            </div>
            <div class="invitegroupe">
                <ul>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                </ul>
                <div class="button"><a href="#">Добавить группу</a></div>
            </div>
            <div class="blockform">
                <ul>
                    <li><input id="name" type="text" placeholder="Название группы" required=""></li>
                    <li><input id="date" type="text" placeholder="Дата" required=""></li>
                    <li><input id="time" type="text" placeholder="Время" required=""></li>
                    <li><a href="#">Сохранить</a></li>
                    <li><a href="#"><img src="img/x.png"><img src="img/x-active.png"></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection