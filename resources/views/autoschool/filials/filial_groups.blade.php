@extends('layouts.autoschool')
@section('content')

    <div class="content error profile autoschool">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a> / Филиал {{$filial->title.' '.$filial->id}}</li>
            </ul>
        </div>
        {{--<block-statistic-filial></block-statistic-filial>--}}
        <filial-groups :filial="{{json_encode($filial)}}"
                       :groups="{{json_encode($groups)}}"></filial-groups>
    </div>
@endsection