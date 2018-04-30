@extends('layouts.investor')

@section('content')
    <div class="content error profile investor">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ route('investor.index') }}">Главная</a> / Филиалы</li>
            </ul>
        </div>

        <div class="blockgroupe">
            <h2>Список автошкол:</h2>
            
            <table class="table manage-grid">
                <thead>
                <tr class="visible-md visible-lg">
                    <th>№</th>
                    <th>Автошкола/ID</th>
                    <th>Филиал</th>
                    <th>Город</th>
                    <th>Купоны активные/неактивные/всего</th>
                    <th>Комиссия</th>
                    <th>К оплате</th>
                </tr>
                </thead>
                <tbody class="main">
                <tr data-id="1" class="visible-md visible-lg">
                    <td>1</td>
                    <td><a class="school-name">Автошкола АБВ</a><span class="school-id">ID 6507</span></td>
                    <td>Центральный</td>
                    <td>Киров</td>
                    <td><a class="coupon coupon-active" href="javascript:">24</a> / <a class="coupon coupon-active" href="javascript:">34</a> / <a class="coupon coupon-active" href="javascript:">50</a></td>
                    <td><span class="bold big">160 000</span></td>
                    <td><a class="bold big" href="javascript:">160 000</a></td>
                </tr>
                <tr data-id="1" class="hidden-md hidden-lg">
                    <td>
                        <table>
                            <tbody>
                            <tr>
                                <td><span class="big bold">01</span></td>
                                <td><a class="school-name">Автошкола АБВ</a><span class="school-id">ID 6507</span></td>
                                <td>Центральный</td>
                                <td>Киров</td>

                            </tr>
                            <tr>
                                <td></td>
                                <th>Купоны активные/неактивные/всего</th>
                                <td>
                                    <a href="javascript:">24</a> /
                                    <a href="javascript:">34</a> /
                                    <a href="javascript:">50</a>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Комиссия</th>
                                <td><span class="bold big">160 000</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>К оплате</th>
                                <td><a class="bold big" href="javascript:">160 000</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr data-id="1" class="payment-form" style="display: none">
                    <td colspan="7">
                        <form action="">
                            <div class="close hidden-md hidden-lg"></div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button class="btn-grey">Сохранить</button>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="close visible-md visible-lg"></div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <h3>Статистика купонов:</h3>
        @include('investor._statistics')

        <div class="invitegroupe">
            <ul class="pagination">
                <li class="page-item">
                    {{--<a :class="[{active: currentPage === 1}, 'page-link']" href="#">1</a>--}}
                    {{--<a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">2</a>--}}
                    {{--<a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">3</a>--}}
                    {{--<a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">4</a>--}}
                </li>
            </ul>
        </div>
    </div>
@endsection