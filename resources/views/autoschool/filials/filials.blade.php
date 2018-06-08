@extends('layouts.autoschool')
@section('content')
    <div class="content error profile autoschool">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{route('autoschool.index')}}">Главная</a>/ Филиалы</li>
            </ul>
        </div>
        <block-statistic-groups></block-statistic-groups>
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
                <div class="line" >
                    <div class="number">0</div>
                    <div class="name"><a href="/autoschool/filials/new">Нераспределённые</a></div>
                    <div class="data-and-time">
                        <span></span>
                    </div>

                    <div class="count">
                        <span class="visible-xs hidden-sm"></span>
                    </div>
                    <div class="kupons">
                        <span></span>
                    </div>
                </div>
                @foreach($filials as $filial)
                    <div class="table-content">
                        <div class="table-item-row">
                            <div class="table-item number-item">
                                <div class="table-head-item hidden-head-text">№</div>
                                <div class="table-item-content">
                                    {{$filial->id}}
                                </div>
                            </div>
                            <div class="table-item name-filial-item">
                                <div class="table-head-item hidden-head-text">Название филиала</div>
                                <div class="table-item-content">
                                    @if(!empty($filial->filial_name))
                                        <a href="/autoschool/filials/{{$filial->id}}/" class="table-item-link text-underline">
                                            {{$filial->filial_name}}
                                        </a>
                                    @else
                                        <a href="/autoschool/filials/{{$filial->id}}/" class="table-item-link text-underline">
                                            {{$filial->title}}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="table-item address-filial-item">
                                <div class="table-head-item hidden-head-text">Адрес филиала</div>
                                <div class="table-item-content">
                                    @if(!empty($filial->city->name) && !empty($filial->addresses[0]->value))
                                        <span>{{'г. '.$filial->city->name.', '.$filial->addresses[0]->value}}</span>
                                    @elseif(!empty($filial->city->name) && empty($filial->addresses[0]->value))
                                        <span>{{'г. '.$filial->city->name}}</span>
                                    @elseif(empty($filial->city->name) && !empty($filial->addresses[0]->value))
                                        <span>{{$filial->addresses[0]->value}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="table-item count-item">
                                <div class="table-head-item hidden-head-text">Кол-во учеников</div>
                                <div class="table-item-content">
                                    <span>{{$filial->count_student}}</span>
                                </div>
                            </div>
                            <div class="table-item kupons-item">
                                <div class="table-head-item hidden-head-text">Купоны активные/неактивные/всего</div>
                                <div class="table-item-content">
                                    <span>{{$filial->coupons_active}} / {{$filial->coupons_passive}} / {{$filial->coupons_active + $filial->coupons_passive}}</span>
                                </div>
                            </div>
                        </div>
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
            {{--{{dd($autoschool)}}--}}
            @if(!empty($autoschool))
            <button-add-filial :autoschool="{{json_encode($autoschool)}}"></button-add-filial>
                @endif
        </div>
    </div>

@endsection