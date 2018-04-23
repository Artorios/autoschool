@extends('layouts.autoschool')
@section('content')



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

            <div class="line">
                <div class="number"></div>
                <div class="name"><a href=""></a></div>
                <div class="data-and-time">
                    <span></span>
                </div>

                <div class="count">
                    <span class="visible-xs hidden-sm">Количество учеников  8</span>
                    <span class="visible-sm hidden-xs visible-lg visible-md">8</span>
                </div>
                <div class="kupons">
                    <span>24/ 34 / 50</span>
                </div>
            </div>
        </div>
    </div>
    <div class="invitegroupe">
        <ul class="pagination">
            <li class="page-item">
                <a class="[{active: currentPage === pageNumber}, 'page-link']" href="#"
                   </a>
            </li>
        </ul>
    </div>
@endsection