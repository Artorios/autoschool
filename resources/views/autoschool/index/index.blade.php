@extends('layouts.autoschool')
@section('content')
    <div class="content error profile autoschool">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a></li>
            </ul>
        </div>
        {{--{{dd($groups)}}--}}
        <block-statistic-groups></block-statistic-groups>
        <filial-groups :groups="{{json_encode($groups)}}"></filial-groups>
    </div>

@endsection