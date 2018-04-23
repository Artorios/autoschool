@extends('layouts.autoschool')
@section('content')

    <div class="content error profile autoschool-student">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a> / Ученики</li>
            </ul>
        </div>

        <div class="search-form blockforms student">
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

        <div class="studentgroupe">
            <h4>Ученики группы ИД-21:</h4>


            <table class="table manage-grid">
                <thead>
                <tr class="visible-md visible-lg">
                    <th>№</th>
                    <th>ФИО ученика</th>
                    <th>Группа</th>
                    <th>Текущий урок</th>
                    <th>Успеваемость</th>
                    <th>Экзамен</th>
                </tr>
                </thead>
                <tbody class="main">
                <tr data-id="1" class="visible-md visible-lg">
                    <td>01</td>
                    <td><a href="#">Длиннофальмилильнов И. В.</a></td>
                    <td><a href="#">ИД-21 супер длинное</a></td>
                    <td>Дорожные знаки. Предупреждающие знаки.</td>
                    <td>80%</td>
                    <td><span>Экзамен в ГБДД</span><a href="#">6 из 28</a></td>
                </tr>
                <tr data-id="1" class="hidden-md hidden-lg">
                    <td>
                        <table>
                            <tbody>
                            <tr>
                                <td><span class="big bold">01</span></td>
                                <td colspan="2"><a href="#">Длиннофальмилильнов И. В.</a></td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Группа</th>
                                <td>
                                    <a href="#">ИД-21 супер длинное</a>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Текущий урок</th>
                                <td>Дорожные знаки. Предупреждающие знаки.</td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Успеваемость</th>
                                <td>80%</td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Экзамен</th>
                                <td><span>Экзамен в ГБДД</span><a href="#">6 из 28</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr data-id="1" class="payment-form" style="display: none">
                    <td colspan="6">
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
                <tr data-id="2" class="visible-md visible-lg">
                    <td>02</td>
                    <td><a href="#">Длиннофальмилильнов И. В.</a></td>
                    <td><a href="#">ИД-21 супер длинное</a></td>
                    <td>Дорожные знаки. Предупреждающие знаки.</td>
                    <td>80%</td>
                    <td><span>Экзамен в ГБДД</span><a class="success" href="#">28 из 28</a></td>
                </tr>
                <tr data-id="2" class="hidden-md hidden-lg">
                    <td>
                        <table>
                            <tbody>
                            <tr>
                                <td><span class="big bold">02</span></td>
                                <td colspan="2"><a href="#">Длиннофальмилильнов И. В.</a></td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Группа</th>
                                <td>
                                    <a href="#">ИД-21 супер длинное</a>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Текущий урок</th>
                                <td>Дорожные знаки. Предупреждающие знаки.</td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Успеваемость</th>
                                <td>80%</td>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Экзамен</th>
                                <td><span>Экзамен в ГБДД</span><a class="success" href="#">28 из 28</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="addstudent">
            <a href="{{ route('autoschool.add-student') }}" class="btn-grey"> Добавить ученика</a>
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