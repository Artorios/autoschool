@extends('layouts.autoschool')
@section('content')

    <div class="content error profile autoschool">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{route('autoschool.index')}}">Главная</a> / Филиал {{$filial->title.' '.$filial->id}}</li>
            </ul>
        </div>
        <block-statistic-filials :filial="{{json_encode($filial)}}"></block-statistic-filials>
        <filial-groups :filial="{{json_encode($filial)}}"
                       :groups="{{json_encode($groups)}}"></filial-groups>
    </div>
@endsection