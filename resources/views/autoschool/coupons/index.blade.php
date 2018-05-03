@extends('layouts.autoschool')
@section('content')
    <div class="content error profile autoschool-coupons investor-coupons">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a></li>
                <li><a href="/autoschool/coupons">Купоны</a></li>
            </ul>
        </div>

        {{--<div class="coupons-top-button">--}}
            {{--<div class="form-inline top-button">--}}
                {{--<div class="form-group">--}}
                    {{--<select class="select" id="coupons">--}}
                        {{--<option disabled value="">Все(444)</option>--}}
                        {{--<option value="1">1</option>--}}

        {{--</select>--}}
        {{--</div>--}}
        {{--<button href="" class="btn-grey form-control">Генератор купонов</button>--}}
        {{--<button href="" class="btn-grey form-control">Статистика купонов</button>--}}
        {{--</div>--}}

{{--{{dd($coupons)}}--}}

<coupons :coupons="{{json_encode($coupons)}}"></coupons>




    </div>


@endsection