@extends('layouts.autoschool')
@section('content')
    <div class="content error profile autoschool">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{route('autoschool.index')}}">Главная</a></li>
            </ul>
        </div>
        <block-statistic-groups></block-statistic-groups>
        <filial-groups :groups="{{json_encode($groups)}}"
                       :unpay="{{json_encode($students_unpay)}}"
                       :pay="{{json_encode($students_pay)}}"
        ></filial-groups>
    </div>

@endsection