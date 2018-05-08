@extends('layouts.autoschool')
@section('content')
    <div class="content error profile autoschool">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a> / Филиалы</li>
            </ul>
        </div>
        <block-statistic-groups></block-statistic-groups>
        <school-filials :autoschool="{{json_encode($autoschool)}}"
                        :filials="{{json_encode($autoschool->filials)}}"
        ></school-filials>
    </div>
@endsection