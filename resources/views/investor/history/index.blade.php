@extends('layouts.investor')

@section('content')
    <div class="content error profile finance">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ route('investor.index') }}">Главная</a> / Филиалы</li>
            </ul>
        </div>
        <h3>Финансовая статистика:</h3>
        @include('investor._statistics')

        <div class="blockgroupe">
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
                                <option selected disabled></option>
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
                    <th></th>
                    <th>№</th>

                    <th>ФИО ученика</th>
                    <th>Группа</th>
                    <th>Тип оплаты</th>
                    <th>Дата оплаты</th>
                    <th>Сумма</th>
                </tr>
                </thead>
                <tbody class="main">
                <tr data-id="1" class="visible-md visible-lg">
                    <td>
                        <div class="checked-line">
                            <input type="checkbox" name="grid_selected[]">
                            <label for="checked-line"></label>
                        </div>
                    </td>
                    <td>1</td>
                    <td><span class="student-name">Длиннофамильевский И.В.</span></td>
                    <td><span class="group-number">Группа <a
                                    href="javascript:">№123</a></span></td>
                    <td>Длинный тип олаты</td>
                    <td>12.02.1254</td>
                    <td><a class="bold big" href="javascript:">6 000</a></td>
                </tr>
                <tr data-id="1" class="hidden-md hidden-lg">
                    <td>
                        <table>
                            <tbody>
                            <tr>
                                <td><input type="checkbox" name="grid_selected[]"></td>
                                <td><span class="big bold">01</span></td>
                                <td>
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
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
                <tfoot class="finance-line-height">
                <tr>
                    <td colspan="9">
                        <div class="row nero">
                            <div class="col-md-2 margin-12">
                                <input type="checkbox">  Для всех
                            </div>
                            <div class="col-md-2 margin-12">
                                Отмечено 1 из 12
                            </div>

                            <div class="col-xs-12 col-md-2"><a type="text" class="btn-grey">Анулировать</a></div>
                            <div class="col-xs-12 col-md-2"><a type="text" class="btn-grey">Удалить</a></div>
                            <div class="col-xs-12 col-md-4">
                                <select class="select">
                                    <option selected disabled>Виберите действие</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
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
        </div>
    </div>
@endsection
@push('scripts')
<script>
    (function ($) {
        $('.select').selectric();
    })(jQuery)
</script>
@endpush