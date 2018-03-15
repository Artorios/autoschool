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
        <form class="payment variants">
            <h5>Выберите способ оплаты</h5>
            <input type="radio" name="variant" id="typeA">
            <label for="typeA">Банковской картой, платежных систем Master Card и VISA.</label>
            <input type="radio" name="variant" id="typeB">
            <label for="typeB">Банковским переводом, на наши реквизиты (квитанция)</label>
            <input type="radio" name="variant" id="typeC">
            <label class="correct" for="typeC">Оплатить купоном</label>
            <div class="coupon">
                <span>Введите номер купона:</span>
                <input type="password">
            </div>
            <a href="#" class="btn-grey" type="submit">Оплатить</a>
        </form>
    </div>
@endsection