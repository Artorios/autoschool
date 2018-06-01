@extends('layouts.autoschool')
@section('content')
    <div class="content error profile autoschool-coupons investor-coupons">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a></li>
                <li>Купоны</li>
            </ul>
        </div>
{{--{{dd($coupons)}}--}}
        <coupons :coupons="{{json_encode($coupons)}}"></coupons>




    </div>


@endsection