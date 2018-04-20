@extends('layouts.autoschool')
@section('content')

    <div class="content error profile autoschool">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a> / Филиал {{$filial->name}}</li>
            </ul>
        </div>
        <block-statistic-groups-in-filial
                :groups="{{json_encode($groups)}}">
        </block-statistic-groups-in-filial>

        <filial-groups :filial="{{json_encode($filial)}}"
                       :groups="{{json_encode($groups)}}">
        </filial-groups>
    </div>
@endsection