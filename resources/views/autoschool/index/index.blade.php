@extends('layouts.autoschool')
@section('content')
{{--    {{dd(Auth::user()->autoschool)}}--}}
    <div class="content error profile autoschool">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a> / Филиалы</li>
            </ul>
        </div>
        <block-statistic></block-statistic>
        <div class="blockgroupe">
            <h2>Филиалы:</h2>

            <div class="table-wrapper">
                <div class="title-line">
                    <span class="number">№</span>
                    <span class="name">Название филиала</span>
                    <span class="data-and-time">Адрес филиала</span>
                    <span class="count">Кол-во учеников</span>
                    <span class="kupons">Купоны активные/неактивные/всего</span>
                </div>
                @foreach($filials as $filial)
                <div class="line">
                        <div class="number">{{$filial->id}}</div>
                        <div class="name"><a href="/autoschool/">{{$filial->name}}</a></div>
                        <div class="data-and-time">
                            <span>{{$filial->address}}</span>
                        </div>
                        <div class="count">
                            <span class="visible-xs hidden-sm">Количество учеников  8</span>
                            <span class="visible-sm hidden-xs visible-lg visible-md">8</span>
                        </div>
                        <div class="kupons">
                            <span>24/ 34 / 50</span>
                        </div>
                    <span class="name">24 / 12 / 36</span>

                </div>
                @endforeach
            </div>
        </div>
        <div class="invitegroupe">
            <ul class="pagination">
                <li class="page-item">
                    {{--<a :class="[{active: currentPage === 1}, 'page-link']" href="#">1</a>--}}
                    {{--<a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">2</a>--}}
                    {{--<a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">3</a>--}}
                    {{--<a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">4</a>--}}
                </li>
            </ul>
            <button-add-filial></button-add-filial>
        </div>
        <div class="blockform">
            <form action="">
                <div class="row nero">
                    <div class="col-xs-12 col-sm-4">
                        <input id="name" type="text" class="name-group" placeholder="Название филиала" required="">
                    </div>
                    <div class="col-xs-6 col-sm-2">
                        <input id="date" type="text" class="data" placeholder="Адрес" required="">
                    </div>
                    <div class="col-xs-6 col-sm-2">
                        <input id="time" type="text" class="time" placeholder="Время" required="">
                    </div>
                    <div class="col-xs-12 col-sm-3"><a href="#" class="btn-grey">Сохранить</a></div>
                  <span class="close"></span>
                </div>
            </form>
        </div>
    </div>

@endsection