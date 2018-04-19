@extends('layouts.autoschool')
@section('content')



    <div class="content error profile autoschool-coupons ">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a></li>
                <li><a href="/autoschool/coupons">Купоны</a></li>
            </ul>
        </div>

        <div class="coupons-top-button">
            {{--<div class="form-inline top-button">--}}
                {{--<div class="form-group">--}}
                    {{--<select class="select" id="coupons">--}}
                        {{--<option disabled value="">Все(444)</option>--}}
                        {{--<option value="1">1</option>--}}

                    {{--</select>--}}
                {{--</div>--}}
                {{--<button href="" class="btn-grey form-control">Генератор купонов</button>--}}
                {{--<button href="" class="btn-grey form-control">Статистика купонов</button>--}}
            {{--</div>--}}
            <div class="coupon-table ">
                <div class="table-wrapper">
                    <div class="title-line">
                        <span class="number">№</span>
                        <span class="coupon">Купон</span>
                        <span class="autoschool">Автошкола<br>/ID</span>
                        <span class="city">Филиал<br>/Город</span>
                        <span class="name-student">ФИО ученика<br>/група</span>
                        <span class="generate-date">Дата<br>генерации</span>
                        <span class="activate-date">Дата<br> активации</span>
                        <span class="price">Сумма<br> оплаты</span>
                        <span class="status">Комиссия<br>/статус</span>
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
                        <div></div>
                    </div>
                    <div class="line free">
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
                        <div></div>
                    </div>
                    <div class="line paid">
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
                        <div></div>
                    </div>

                </div>
            </div>
        </div>

@endsection