@extends('layouts.autoschool')
@section('content')



    <div class="blockgroupe">
        <h2>Филиалы:</h2>
        <div class="table-block table-filial">
            <div class="table-head">
                <span class="table-head-item number-item">№</span>
                <span class="table-head-item name-filial-item">Название филиала</span>
                <span class="table-head-item address-filial-item">Адрес филиала</span>
                <span class="table-head-item count-item">Кол-во учеников</span>
                <span class="table-head-item kupons-item">Купоны активные/неактивные/всего</span>
            </div>
            <div class="table-item-row">
                    <div class="table-item number-item">
                        <div class="table-head-item hidden-head-text">№</div>
                        <div class="table-item-content">
                            number
                        </div>
                    </div>
                    <div class="table-item name-filial-item">
                        <div class="table-head-item hidden-head-text">Название филиала</div>
                        <div class="table-item-content">
                            <a :href="'/autoschool/filials/' + filial.id" class="table-item-link text-underline">
                                name
                            </a>
                        </div>
                    </div>
                    <div class="table-item address-filial-item">
                        <div class="table-head-item hidden-head-text">Адрес филиала</div>
                        <div class="table-item-content">
                            <span>address</span>
                        </div>
                    </div>
                    <div class="table-item count-item">
                        <div class="table-head-item hidden-head-text">Кол-во учеников</div>
                        <div class="table-item-content">
                            <span class="text-bold text-big">count</span>
                        </div>
                    </div>
                    <div class="table-item kupons-item">
                        <div class="table-head-item hidden-head-text">Купоны активные/неактивные/всего</div>
                        <div class="table-item-content">
                            <span>24 / 34 / 50</span>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="invitegroupe">
        <ul class="pagination">
            <li class="page-item">
                <a class="[{active: currentPage === pageNumber}, 'page-link']" href="#"></a>
            </li>
        </ul>
    </div>
@endsection