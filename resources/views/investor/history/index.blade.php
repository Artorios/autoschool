@extends('layouts.investor')

@section('content')
    <div class="content error profile finance">
        <div class="breadcrumbs">
            <ul>
                <li><a href="">Главная</a> / История</li>
            </ul>
        </div>
        <button href="" id="search-button" class="btn-grey visible-xs ">
            <img src="/img/search.png" alt="">Поиск по параметрам
        </button>

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
                                <option selected disabled>Название автошколы</option>
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
                    <th>Дата</th>
                    <th>Вид операции</th>
                    <th>Комментарий</th>
                </tr>
                </thead>
                <tbody class="main">
                <tr data-id="1" class="visible-md visible-lg">
                    <td>01</td>
                    <td>21,14,1112</td>
                    <td>Генерация купонов</td>
                    <td>Киров Автошкола</td>

                </tr>
                <tr data-id="1" class="hidden-md hidden-lg">
                    <td>
                        <table>
                            <tbody>
                            <tr>
                                <th><span class="big bold">01</span></th>
                                <td>21,14,1112</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Генерация купонов</td>

                            </tr>
                            <tr>
                                <td></td>
                                <td>Киров Автошкола</td>
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
                            <div class="col-md-2 margin-12 margin-y-10">
                                Отмечено 1 из 12
                            </div>

                            <div class="col-xs-12 col-md-2 margin-y-10"><a type="text" class="btn-grey">Анулировать</a></div>
                            <div class="col-xs-12 col-md-2 margin-y-10"><a type="text" class="btn-grey">Удалить</a></div>
                            <div class="col-xs-12 col-md-4 margin-y-10">
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
        $('#search-button').click(function(){
            $('.search-form').stop().toggle();
        });
    })(jQuery)
</script>
@endpush