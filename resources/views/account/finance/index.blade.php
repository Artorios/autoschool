@extends('layouts.account')
@section('content')
    <div class="content error lessons finance">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a></li>
                <li>Финансы</li>
            </ul>
        </div>
        <div class="finance-wrapper">
            <div class="title-line">
                <span class="number">Договор</span>
                <span class="date">Дата</span>
                <span class="price">Начисление (руб):</span>
                <span class="total-price">Итого к оплате (руб.):</span>
            </div>
            <div class="line">
                <div class="number">
                    <span class="mobile-name">Договор</span>
                    <a href="#">{{$contract['name']}}</a>
                </div>
                <div class="date">
                    <span class="mobile-name">Дата</span>
                    <span>{{$contract['date']}}</span>
                </div>
                <div class="price">
                    <span class="mobile-name">Начисление (руб):</span>
                    <span>{{$contract['price']}}</span>
                </div>
                <div class="total-price">
                    <span class="mobile-name">Итого к оплате (руб.):</span>
                    <span>{{$contract['amount']}}</span>
                </div>
            </div>
        </div>
        @if(!empty($user->contract->name))
        <payment-variants :user="{{json_encode($user)}}"
                          :contract="{{json_encode($user->contract->name)}}"
                          :price="{{json_encode($user->city->price)}}"
        ></payment-variants>
        @endif
    </div>
@endsection