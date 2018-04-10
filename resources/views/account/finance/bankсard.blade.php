@extends('layouts.account')
@section('content')
    <div class="content error lessons finance">
        <span>ФИО {{$user->last_name}}  {{$user->name}} {{$user->second_name}} </span>
        <form method="POST" action="/account/finance/card-payment">
            <h2>Номер карты</h2>
            {{ csrf_field() }}
            <input type="text" name="numberCard" id="" value="">
            <h2>Срок действия</h2>
            <input type="text" name="validity_month" id="" value="" placeholder="месяц">
            <input type="text" name="validity_year" id="" value="" placeholder="год">
            <h2>CVV2-code</h2>
            <input type="text" name="cvv2Code" id="" value="">
            <span>Сумма {{$user->city->price}} руб.</span>
            <button class="btn-grey" type="submit">Оплатить</button>
        </form>
    </div>
@endsection