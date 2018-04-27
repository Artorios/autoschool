@extends('layouts.autoschool')
@section('content')

    <div class="content error profile autoschool">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a> / Филиал {{$filial->name}}</li>
            </ul>
        </div>
        <block-statistic-groups-in-filial
                :filial="{{json_encode($filial)}}">
        </block-statistic-groups-in-filial>

        <filial-groups :filial="{{json_encode($filial)}}"
                       :groups="{{json_encode($filial->autoschoolgroups)}}">
        </filial-groups>
    </div>
@endsection