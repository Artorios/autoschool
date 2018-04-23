@extends('layouts.autoschool')
@section('content')

    <div class="content error profile autoschool-student">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a> / Ученики</li>
            </ul>
        </div>

        <div class="blockforms student">
            <div class="search">
                <input type="text"placeholder="Введите что искать">
            </div>
            <div class="form-group">
                <select class="select">
                    <option selected disabled>ФИО ученика</option>
                    <option>Петров В.В.</option>
                    <option>Сидоров Г.А.</option>
                </select>
                <select class="select">
                    <option selected disabled>По дате</option>
                    <option>21.01.15</option>
                    <option>22.01.15</option>
                </select>
                <div class="data">
                    <input type="text" placeholder="Дата">
                </div>
            </div>
        </div>
        <div class="studentgroupe">
            <h4>Ученики группы ИД-21:</h4>
            <ul>
                <li><span>№</span>ФИО ученика</li>
                <li>Группа</li>
                <li>Текущий урок</li>
                <li>Успеваемость</li>
                <li>Экзамен</li>
            </ul>
            <ul>
                <li><span>01</span>
                    <p><a href="#">Длиннофальмилильнов И. В.</a></p></li>
                <li><span>Группа</span><a href="#">ИД-21 супер длинное</a></li>
                <li><span>Текущий урок</span>
                    <p>Дорожные знаки. Предупреждающие знаки.</p></li>
                <li><span>Успеваемость</span>
                    <p>80%</p></li>
                <li><span>Экзамен</span><span>Экзамен в ГБДД</span> <a href="#">6 из 28</a></li>
            </ul>
            <ul>
                <li><span>02</span>
                    <p><a href="#">Иванов И. В.</a></p></li>
                <li><span>Группа</span><a href="#">ИД-21</a></li>
                <li><span>Текущий урок</span>
                    <p>Приоритет МТС</p></li>
                <li><span>Успеваемость</span>
                    <p>80%</p></li>
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