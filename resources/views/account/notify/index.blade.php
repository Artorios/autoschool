@extends('layouts.account')
@section('content')
<div class="content error notice">
    <div class="breadcrumbs">
        <ul>
            <li><a href="#">Главная</a></li>
            <li>Уведомления</li>
        </ul>
    </div>
    <div class="btn-wrapper">
        <a href="#" class="active">Новые</a>
        <a href="#">Все</a>
    </div>
    <div class="notice-wrapper">
        <div class="line">
            <span class="date-time"><img src="img/clock.png" alt="">02.09.2017 18:00</span>
            <p>Имеется задолженность за октябрь по договору Д752-17, подробности в разделе <a href="#">Финансы</a></p>
        </div>
        <div class="line">
            <span class="date-time"><img src="img/clock.png" alt="">9 дней назад</span>
            <p>Вы поступили в Школу Автотренер! <br> Мы скоро свяжемся с Вами и согласуем детали обучения.</p>
        </div>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link active" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
        </ul>
    </nav>
</div>
@endsection