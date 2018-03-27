@extends('layouts.account')
@section('content')
    <div class="content">
        <div class="breadcrumbs">
            <ul>
                <li>Главная</li>
            </ul>
        </div>
        <div class="info">
            <school-exam></school-exam>

                {{--<h3>Школьный экзамен</h3>
                <span><img src="img/clock.png" alt=""> 02.09.2017 (понедельник) 18:00</span>
                <span>осталось:<span class="number">42</span> дня</span>--}}
            <done-lessons></done-lessons>
        </div>
        <current-lesson></current-lesson>
        <h3>Уроки, тренировки, зачеты:</h3>
        <slider-vue></slider-vue>
    </div>
    @endsection