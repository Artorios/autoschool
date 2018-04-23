@extends('layouts.autoschool')
@section('content')
    <div class="content error">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a></li>
                <li><a href="#"> /Ученики</a></li>
                <li><a href="#">/Карточка ученика</a></li>
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
                        Иванов Иван Васильевич
                    </h3>
                    <div class="date-examination">
                        <div class="row">
                            <div class="col-md-4">Дата и время укзамена</div>
                            <div class="col-md-3"><img src="/img/clock.png" alt=""> 02.09.2018</div>
                            <div class="col-md-3">18:00</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <a href="" class="btn-grey">Статистика зачетов</a>
                        </div>
                        <div class="col-md-5">
                            <a href="" class="btn-grey">Статистика экзамена</a>
                        </div>
                    </div>
                    <div class="row block-info">
                        <div class="col-md-12">
                            <div class="info">
                                <span class="address">
                                    <img src="/img/location.png" alt="">
                                Россия г.Киров, ул.Урицкого, дом 6
                                </span>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="info"><img src="/img/tel.png" alt="">
                                <span class="number">
                                    +7055<span>955211</span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="info"><img src="/img/mail.png" alt="">
                                <span class="mail">
                                    <a href="mailto:mailto:ivan@email.ru">ivan@email.ru</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row inner-block">
                <div class="col-md-4 col-xs-12 col-sm-12">
                    Филиал:
                </div>
                <div class="col-md-8 col-xs-12 col-sm-12">
                    <div class="form-group">
                        <select class="select">
                            <option selected disabled>Купон</option>
                            <option>156145</option>
                            <option>С845</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12 col-sm-12">
                    Группа:
                </div>
                <div class="col-md-8 col-xs-12 col-sm-12">
                    <div class="form-group">
                        <select class="select">
                            <option selected disabled>Купон</option>
                            <option>156145</option>
                            <option>С845</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-xs-6 ">
                    Метод оплаты:
                </div>
                <div class="col-md-8 col-xs-6">
                    Online
                </div>
                <div class="col-md-4 col-xs-6">
                    Дата оплаты:
                </div>
                <div class="col-md-8 col-xs-6">
                    21.04.18
                </div>
                <div class="col-md-4 col-xs-6">
                    Дата регистрации в ситеме:
                </div>
                <div class="col-md-8 col-xs-6">
                    12.04.2018
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-8 col-xs-12 col-sm-12">
                    <textarea name="" id="" class="form-control" cols="0" rows="5" placeholder="Комментарий">
                    </textarea>
                    <a href="" class="btn-grey">Сохранить изменения</a>
                </div>
            </div>
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