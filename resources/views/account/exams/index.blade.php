@extends('layouts.account')
@section('content')
    <div class="content error lessons exam">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a></li>
                <li>Экзамены</li>
            </ul>
        </div>
        <a href="#" class="start btn-grey">Начать пробный экзамен</a>
        <div class="lessons-wrapper exam-wrapper">
            <div class="title">
                <span class="number">№</span>
                <span class="name">Название</span>
                <span class="result">Результат</span>
                <span>Дата</span>
            </div>
            <div class="line">
                <span class="name"><span class="number">01</span><a href="#">Пробный экзамен</a></span>
                <span class="result">6 из 28<span class="refresh"></span></span>
                <span class="date">27.11.2017</span>
                <a href="#" class="btn-grey">Пройти</a>
            </div>
            <div class="line">
                <span class="name"><span class="number">01</span><a href="#">Школьный</a></span>
                <span class="result green">28 из 28<span class="refresh"></span></span>
                <span class="date">27.11.2017</span>
                <a href="#" class="btn-grey">Пройти</a>
            </div>
            <div class="line">
                <span class="name"><span class="number">01</span><a href="#">Пробный</a></span>
                <span class="result"></span>
                <span class="date">29.11.2017</span>
                <a href="#" class="btn-grey">Пройти</a>
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