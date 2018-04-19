@extends('layouts.autoschool')
@section('content')

    <div class="content error profile autoschool">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a> / Филиал {{$filial->name}}</li>
            </ul>
        </div>
        <block-statistic-groups></block-statistic-groups>

        <filial-groups :filial="{{json_encode($filial)}}"
                       :groups="{{json_encode($groups)}}">
        </filial-groups>
    </div>
@endsection