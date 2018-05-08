@extends('layouts.investor')
@section('content')
    <div class="content error profile autoschool-coupons investor-coupons">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a></li>
                <li><a href="/autoschool/coupons">Купоны</a></li>
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
                        <a class="btn-grey w-100 no-margin" href="{{route('investor.coupons.create')}}">Генерация
                            купонов</a>
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
            <div class="coupon-table">
                <div class="table-wrapper">
                    <div class="title-line">
                        <span class="number">№</span>
                        <span class="coupon">Купон</span>
                        <span class="autoschool">Автошкола /ID</span>
                        <span class="city">Филиал /Город</span>
                        <span class="name-student">ФИО ученика /група</span>
                        <span class="generate-date">Дата генерации</span>
                        <span class="activate-date">Дата активации</span>
                        <span class="price">Сумма оплаты</span>
                        <span class="status">Комиссия /статус</span>
                    </div>

                    <div class="line active">
                        <div class="coupons-cheskbox"><input type="checkbox"></div>
                        <div class="number">01</div>
                        <div class="coupon"><a href="#">ИД-21</a></div>
                        <div class="autoschool">Автошкола <a href="">АБВ</a> ID 6701</div>
                        <div class="city">Центральный Киров</div>
                        <div class="name-student">
                            Длинно-фамилиевський И. В.
                            Група №<a href="">123</a>
                        </div>
                        <div class="generate-date">
                            <a href="">01.01.0000</a>
                        </div>
                        <div class="activate-date">
                            <a href="">01.01.2222</a>
                        </div>
                        <div class="price">15 000</div>
                        <div class="status">
                            <div class="status-fee">6000</div>
                            <div class="status-active"><a href="">Активирован</a></div>
                            <div class="status-free"><a href="">Свободный</a></div>
                            <div class="status-paid"><a href="">Выплачен</a> <img src="/img/attention.png" alt=""></div>
                        </div>
                    </div>

                    <div class="block-media-768 active">
                        <div>
                            <div class="coupons-cheskbox">
                                <input type="checkbox"></div>
                        </div>
                        <div>
                            <div class="number">01</div>
                        </div>
                        <div>
                            <span class="coupon"><a href="#">ИД-21</a></span>
                            <span class="autoschool">Автошкола <a href="">АБВ</a> ID 6701</span>
                            <div class="city">Центральный Киров</div>
                            <span class="name-student">
                             Длинно-фамилиевський И. В.
                             Група №<a href="">123</a>
                         </span>
                            <div class="generate-date">
                                <span>Дата генерации</span> <a href="">01.01.0000</a>

                            </div>
                            <div class="activate-date">
                                <span>Дата активации</span> <a href="">01.01.2222</a>
                            </div>
                            <div class="price"><span>Сумма оплаты </span><span style="font-weight: bold">15 000</span>
                            </div>
                            <div class="status-fee"><span>Комиссия </span> <span style="font-weight: bold">6000</span>
                            </div>
                            <div class="status">
                                <span>Статус</span>
                                <span class="status-active"><a href="">Активирован</a></span>
                                <span class="status-free"><a href="">Свободный</a></span>
                                <span class="status-paid"><a href="">Выплачен</a> <img src="/img/attention.png" alt=""></span>

                            </div>
                        </div>
                    </div>

                    <div class="blockform active">
                        <div class="form-inline">
                            <input type="text" placeholder="Комментарий">
                            <a href="" class="btn-grey">Выплатить</a>
                            <a href="" class="close"></a>
                        </div>
                    </div>
                    <div class="line free">
                        <div class="coupons-cheskbox"><input type="checkbox"></div>
                        <div class="number">01</div>
                        <div class="coupon"><a href="#">ИД-21</a></div>
                        <div class="autoschool">Автошкола <a href=""> АБВ </a> ID 6701</div>
                        <div class="city">Центральный Киров</div>
                        <div class="name-student">

                        </div>
                        <div class="generate-date">
                            <a href="">01.01.0000</a>
                        </div>
                        <div class="activate-date">
                            <a href=""></a>
                        </div>
                        <div class="price">15 000</div>
                        <div class="status">
                            <div class="status-fee">6000</div>
                            <div class="status-active"><a href="">Активирован</a></div>
                            <div class="status-free"><a href="">Свободный</a></div>
                            <div class="status-paid"><a href="">Выплачен</a> <img src="/img/attention.png" alt=""></div>
                        </div>
                        <div></div>
                    </div>
                    <div class="block-media-768 free">
                        <div>
                            <div class="coupons-cheskbox">
                                <input type="checkbox"></div>
                        </div>
                        <div>
                            <div class="number">01</div>
                        </div>
                        <div>
                            <span class="coupon"><a href="#">ИД-21</a></span>
                            <span class="autoschool">Автошкола <a href="">АБВ</a> ID 6701</span>
                            <div class="city">Центральный Киров</div>
                            <span class="name-student">
                             Длинно-фамилиевський И. В.
                             Група №<a href="">123</a>
                         </span>
                            <div class="generate-date">
                                <span>Дата генерации</span> <a href="">01.01.0000</a>

                            </div>
                            <div class="activate-date">
                                <span>Дата активации</span> <a href="">01.01.2222</a>
                            </div>
                            <div class="price"><span>Сумма оплаты </span> <span style="font-weight: bold">15 00</span>
                            </div>
                            <div class="status-fee"><span>Комиссия </span><span style="font-weight: bold">6000</span>
                            </div>
                            <div class="status">
                                <span>Статус</span>
                                <span class="status-active"><a href="">Активирован</a></span>
                                <span class="status-free"><a href="">Свободный</a></span>
                                <span class="status-paid"><a href="">Выплачен</a> <img src="/img/attention.png" alt=""></span>

                            </div>
                        </div>
                    </div>
                    <div class="line paid">
                        <div class="coupons-cheskbox"><input type="checkbox"></div>
                        <div class="number">01</div>
                        <div class="coupon"><a href="#">ИД-21</a></div>
                        <div class="autoschool">Автошкола <a href=""> АБВ </a> ID 6701</div>
                        <div class="city">Центральный Киров</div>
                        <div class="name-student">
                            Длинно-фамилиевський И. В.
                            Група №<a href="">123</a>
                        </div>
                        <div class="generate-date">
                            <a href="">01.01.0000</a>
                        </div>
                        <div class="activate-date">
                            <a href="">01.01.2222</a>
                        </div>
                        <div class="price">15 000</div>
                        <div class="status">
                            <div class="status-fee">6000</div>
                            <div class="status-active"><a href="">Активирован</a></div>
                            <div class="status-free"><a href="">Свободный</a></div>
                            <div class="status-paid"><a href="">Выплачен</a> <img src="/img/attention.png" alt=""></div>
                        </div>
                        <div></div>
                    </div>
                    <div class="block-media-768 paid">
                        <div>
                            <div class="coupons-cheskbox">
                                <input type="checkbox"></div>
                        </div>
                        <div>
                            <div class="number">01</div>
                        </div>
                        <div>
                            <span class="coupon"><a href="#">ИД-21</a></span>
                            <span class="autoschool">Автошкола <a href="">АБВ</a> ID 6701</span>
                            <div class="city">Центральный Киров</div>
                            <div class="name-student">
                                Длинно-фамилиевський И. В.
                                Група №<a href="">123</a>
                            </div>
                            <div class="generate-date">
                                <span>Дата генерации</span> <a href="">01.01.0000</a>

                            </div>
                            <div class="activate-date">
                                <span>Дата активации</span> <a href="">01.01.2222</a>
                            </div>
                            <div class="price"><span>Сумма оплаты </span><span style="font-weight: bold">15 000</span>
                            </div>
                            <div class="status-fee"><span>Комиссия </span> <span style="font-weight: bold">6000</span>
                            </div>
                            <div class="status">
                                <span>Статус</span>
                                <span class="status-active"><a href="">Активирован</a></span>
                                <span class="status-free"><a href="">Свободный</a></span>
                                <span class="status-paid"><a href="">Выплачен</a> <img src="/img/attention.png" alt=""></span>

                            </div>
                        </div>
                    </div>
                    <div class="blockform paid">
                        <div class="form-inline">

                            <div class="date">
                                25.10.1225
                            </div>
                            <div>
                                Выплата комисии
                            </div>
                            <div class="info"> По щету № <a href="">207</a> от 01.01.0147</div>

                            <a href="" class="close"></a>
                        </div>
                    </div>
                    <div class="blockform bottom-form">
                        <div class="row nero">
                            <div class="col-md-4 text-info">
                                <input type="checkbox">
                                <span class="all">Для всех</span>
                                <span>Отмечено 1 из 12</span>
                            </div>
                            <div class="col-md-2">
                                <a href="" class="btn-grey">Анулировать</a>
                            </div>
                            <div class="col-md-2">
                                <a href="" class="btn-grey" id="delete">Удалить</a>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="" id="type_filter" class="select">
                                        <option value="all">Выберите действие</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_dialog_cancel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-coupons-cancel">
                    <div class="row">
                        <div class="col-xs-12 col-sm-7">
                            <textarea name="" id="" rows="2" placeholder="Комментарий для истории причины действия">
                            </textarea>
                        </div>
                        <div class="col-xs-11 col-sm-4">
                            <a href="" class="btn-grey">Продолжить</a>
                        </div>
                    </div>
                    <span class="close" data-dismiss="modal"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_dialog_delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-coupons-delete">
                    <div>
                        <div class="row">
                            <div class="col-xs-12 text">
                                Подтвердите действие для отмеченых элементов
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <a href="" class="btn-grey">Удалить</a>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <button class="btn-link" data-dismiss="modal">Отмена</button>
                            </div>
                        </div>
                        <span class="close"></span>
                    </div>
                </div>
            </div>
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