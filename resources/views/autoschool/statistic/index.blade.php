@extends('layouts.autoschool')

@section('content')
        <div class="content error statistics">
                <div class="breadcrumbs">
                        <ul>
                                <li><a href="#">Главная</a></li>
                                <li>Статистика (Успеваемость)</li>
                        </ul>
                </div>
                <div class="content error statistics">
                        <div class="table-wrapper">
                                <div class="title-line">
                                        <span class="number">№</span>
                                        <span class="name">Название</span>
                                        <span class="lesson">Урок</span>
                                        <span class="train">Тренировка</span>
                                        <span class="exam">Зачет</span>
                                        <span class="group-exam">Групповой зачет</span>
                                </div>
                                @if(!empty($returnLessons))
                                        @if(!empty($returnResult))
                                                <statistic-vue :statistics="{{json_encode($returnLessons)}}"
                                                               :alldata="{{json_encode($returnResult)}}"></statistic-vue>
                                        @endif
                                @else
                                   <h2>Еще не пройдено ни одного зачета</h2>
                                @endif
                        </div>

                </div>
        </div>

@endsection