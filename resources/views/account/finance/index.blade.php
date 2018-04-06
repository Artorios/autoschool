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
                    <a href="#">Д7584_17</a>
                </div>
                <div class="date">
                    <span class="mobile-name">Дата</span>
                    <span>27.11.17</span>
                </div>
                <div class="price">
                    <span class="mobile-name">Начисление (руб):</span>
                    <span>6400</span>
                </div>
                <div class="total-price">
                    <span class="mobile-name">Итого к оплате (руб.):</span>
                    <span>6400</span>
                </div>
            </div>
        </div>
        <payment-variants :user="{{json_encode($user)}}"
                          :contract="{{json_encode($user->contract->name)}}"
                          :price="{{json_encode($user->city->price)}}"
        ></payment-variants>
    </div>
@endsection