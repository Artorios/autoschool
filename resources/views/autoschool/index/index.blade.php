@extends('layouts.autoschool')
@section('content')
{{--    {{dd(Auth::user()->autoschool)}}--}}
    <div class="content error profile autoschool">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a></li>
            </ul>
        </div>
        <block-statistic-groups></block-statistic-groups>
    </div>
@endsection