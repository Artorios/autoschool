@extends('layouts.investor')

@section('content')
    <div class="content error profile investor">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ route('investor.index') }}">Главная</a> / Филиалы</li>
            </ul>
        </div>
        
        <div class="blockgroupe">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="" id="type_filter" class="select">
                            <option value="all">Все(25)</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <button class="btn-grey w-100 no-margin">Генерация купонов</button>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <button class="btn-grey w-100 no-margin">Статистика купонов</button>
                    </div>
                </div>
            </div>

            <div class="search-form blockforms finance">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="search">
                                <input type="text" placeholder="Введите что искать">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="select">
                                <option selected disabled>ФИО ученика</option>
                                <option>Петров В.В.</option>
                                <option>Сидоров Г.А.</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="select">
                                <option selected disabled>По дате</option>
                                <option>21.01.15</option>
                                <option>22.01.15</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="data">
                                <input type="text" placeholder="Дата">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <table class="table manage-grid">
                <thead>
                <tr class="visible-md visible-lg">
                    <th>№</th>
                    <th>Автошкола/ID</th>
                    <th>ФИО ученика/Группа</th>
                    <th>Тип оплаты</th>
                    <th>Дата оплаты</th>
                    <th>Сумма</th>
                    <th>Комиссия</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody class="main">
                <tr data-id="1" class="visible-md visible-lg status-active">
                    <td>1</td>
                    <td><a class="school-name">Автошкола АБВ</a><span class="school-id">ID 6507</span></td>
                    <td><span class="student-name">Длиннофамильевский И.В.</span><span class="group-number">Группа <a href="javascript:">№123</a></span></td>
                    <td>Длинный тип оплаты</td>
                    <td>27.11.2017</td>
                    <td><span class="bold big">160&nbsp;000</span></td>
                    <td><a class="bold big" href="javascript:">6 000</a></td>
                    <td><a href="javascript:" class="status">Активирован</a></td>
                </tr>
                <tr data-id="1" class="hidden-md hidden-lg status-active">
                    <td>
                        <table>
                            <tbody>
                            <tr>
                                <td><span class="big bold">01</span></td>
                                <td colspan="2">
                                    <a class="school-name">Автошкола АБВ</a><span class="school-id">ID 6507</span>
                                    <span class="student-name">Длиннофамильевский И.В.</span><span class="group-number">Группа <a href="javascript:">№123</a></span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Тип оплаты</th>
                                <td>
                                    Длинный тип оплаты
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Дата оплаты</th>
                                <td>27.11.2017</td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Сумма</th>
                                <td><span class="bold big">160&nbsp;000</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Комиссия</th>
                                <td><a class="bold big" href="javascript:">6 000</a></td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Статус</th>
                                <td><a href="javascript:" class="status">Активирован</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr data-id="2" class="visible-md visible-lg status-free">
                    <td>1</td>
                    <td><a class="school-name">Автошкола АБВ</a><span class="school-id">ID 6507</span></td>
                    <td>{{--<span class="student-name">Длиннофамильевский И.В.</span><span class="group-number">Группа <a href="javascript:">№123</a></span>--}}</td>
                    <td></td>
                    <td>27.11.2017</td>
                    <td><span class="bold big">160&nbsp;000</span></td>
                    <td><a class="bold big" href="javascript:">6 000</a></td>
                    <td><a href="javascript:" class="status">Свободный</a></td>
                </tr>
                <tr data-id="2" class="hidden-md hidden-lg status-free">
                    <td>
                        <table>
                            <tbody>
                            <tr>
                                <td><span class="big bold">01</span></td>
                                <td colspan="2">
                                    <a class="school-name">Автошкола АБВ</a><span class="school-id">ID 6507</span>
                                    {{--<span class="student-name">Длиннофамильевский И.В.</span><span class="group-number">Группа <a href="javascript:">№123</a></span>--}}
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Тип оплаты</th>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Дата оплаты</th>
                                <td>27.11.2017</td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Сумма</th>
                                <td><span class="bold big">160&nbsp;000</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Комиссия</th>
                                <td><a class="bold big" href="javascript:">6 000</a></td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Статус</th>
                                <td><a href="javascript:" class="status">Свободный</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr data-id="3" class="visible-md visible-lg status-paid">
                    <td>1</td>
                    <td><a class="school-name">Автошкола АБВ</a><span class="school-id">ID 6507</span></td>
                    <td>{{--<span class="student-name">Длиннофамильевский И.В.</span><span class="group-number">Группа <a href="javascript:">№123</a></span>--}}</td>
                    <td></td>
                    <td>27.11.2017</td>
                    <td><span class="bold big">160&nbsp;000</span></td>
                    <td><a class="bold big" href="javascript:">6 000</a></td>
                    <td><a href="javascript:" class="status">Свободный</a></td>
                </tr>
                <tr data-id="2" class="hidden-md hidden-lg status-paid">
                    <td>
                        <table>
                            <tbody>
                            <tr>
                                <td><span class="big bold">01</span></td>
                                <td colspan="2">
                                    <a class="school-name">Автошкола АБВ</a><span class="school-id">ID 6507</span>
                                    {{--<span class="student-name">Длиннофамильевский И.В.</span><span class="group-number">Группа <a href="javascript:">№123</a></span>--}}
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Тип оплаты</th>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Дата оплаты</th>
                                <td>27.11.2017</td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Сумма</th>
                                <td><span class="bold big">160&nbsp;000</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Комиссия</th>
                                <td><a class="bold big" href="javascript:">6 000</a></td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Статус</th>
                                <td><a href="javascript:" class="status">Свободный</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                {{--<tr data-id="1" class="payment-form" style="display: none">
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
                </tr>--}}
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
@push('scripts')
<script>
    (function($){
        $('.select').selectric();
    })(jQuery)
</script>
@endpush