@extends('layouts.investor')
@section('content')

    <div class="content error">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ route('investor.index') }}">Филиалы автошкол</a></li>
                <li>Финансы</li>

                <li><a href="#">Главная</a></li>
                <li><a href="#"> Страницы Автошколы АБВ</a></li>

            </ul>
        </div>
        <div class="personal">
            <div class="row">
                <div class="col-md-4">
                    <div class="img-profile">
                        <img src="" alt="" class="img-profile">
                    </div>
                </div>
                <div class="col-md-8">
                    <h3>
                        Автошкола АБВ
                    </h3>
                    <div class="row block-info">
                        <div class="col-md-12">
                            <div class="info">
                                <span class="address">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    Россия г.Киров, ул.Урицкого, дом 6
                                </span>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="info">
                                <span class="number">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    +7055<span>955211</span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="info">
                                <span class="time-work">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                   Мы работаем: пн - вс 9:00 - 18:00 Мск (без выходных)
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="info">
                                <span class="web">
                                    <i class="fa fa-edge" aria-hidden="true"></i>
                                    <a href="">www.DrivingABV.com</a>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="info">
                                <span class="mail">
                                    <i class="fa fa-envelope-open" aria-hidden="true"></i>
                                    <a href="mailto:mailto:ivan@email.ru">ivan@email.ru</a>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="info">
                                <span class="skype">
                                    <i class="fa fa-skype" aria-hidden="true"></i>
                                    <a href="">ABV_school</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3>Информация о юридичиском лице:</h3>
            <div class="row inner-block-investor">
                <div class="row">
                    <div class="col-md-4 col-xs-6 ">
                        ИИН:
                    </div>
                    <div class="col-md-8 col-xs-6">
                        6767689798
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-xs-6">
                        Сокращенное наименование организации:
                    </div>
                    <div class="col-md-8 col-xs-6">
                        ООО Франчайзи
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-xs-6">
                        Полное наименование организации:
                    </div>
                    <div class="col-md-8 col-xs-6">
                        Общество с органиченной
                        ответственностью Франчайзи
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-xs-6">
                        КПП:
                    </div>
                    <div class="col-md-8 col-xs-6">
                        16515615
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-xs-6">
                        Дата государственной регистрации:
                    </div>
                    <div class="col-md-8 col-xs-6">
                        12.04.2018
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-xs-6">
                        Ген. директор:
                    </div>
                    <div class="col-md-8 col-xs-6">
                        Иванов Иван Иванович
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection