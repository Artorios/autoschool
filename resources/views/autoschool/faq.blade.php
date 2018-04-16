@extends('layouts.autoschool')
@section('content')
    <div class="content">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{route('admin.index')}}">Главная</a></li>
                <li><a href="{{route('faq')}}">Справка</a></li>
            </ul>
        </div>

        <div class="row faq-content">
            <div class="col-md-5 search-form-block">
                <div class="modal-backdrop in" style="display: none"></div>
                <div class="search-form">
                    <div class="row ">
                        <div class="col-sm-6 col-md-12">
                            <input type="text" class="icon">
                        </div>
                        <div class="col-sm-6 col-md-12">
                            <div class="menu-header text-uppercase" data-toggle="collapse" href="#link_menu"
                                 aria-expanded="false" aria-controls="link_menu">
                                <div class="menu-header-burger"></div>
                                <div>Меню справки</div>
                            </div>
                        </div>
                        <div class="link-menu collapse" id="link_menu">
                            <div class="col-sm-6 col-md-12">
                                    <ul> Вопросы по обучению:
                                        <li>
                                            <a href="">
                                                Что есть в занятии?
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                Как проходить тестирование?
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                Почему задание не доступно?
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                Как задать вопрос?
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <div class="col-sm-6 col-md-12">
                                    <ul> Вопросы по авторизации:
                                        <li>
                                            <a href="">
                                                Как восстановить пароль?
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                Как зарегистрироваться?
                                            </a>
                                        </li>
                                    </ul>
                                    <ul>Вопросы по оплате:
                                        <li>
                                            <a href="">
                                                Как оплатить обучение?
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 block-information">
                <h4>
                        <span class="heading-number">
                            1
                        </span>
                    <span class="heading-text">
                            Добро пожаловать в школу Автотренер!
                        </span>
                </h4>

                <div class="text-block">
                    <p>
                        Авторенер - автоматизированная система обучения Школы.
                        Звучит не плоо, но что это означает? А означает это следующее:
                    </p>
                    <p>
                        Авторенер - Ваш учебник, Ваша тетрадь и Ваш дневник. В Авторенер есть материалы, чтобы их
                        изучать;
                        есть задачи, чтобы их решать; через Автотренер Вам выставляют оценки за учебу и выдают задания
                        на
                        дом.
                    </p>
                </div>
                <h5>
                    <span  class="heading-text">Дорожные знаки. Предупреждающие знаки</span>
                </h5>
                <div class="text-block">
                    <ul>
                        В этом руководстве вы можете узнать:
                        <li>
                            <img src="/img/ok-gray.png" alt="">
                            <a href="">
                                Как зарегистрироваться очно?
                            </a>
                        </li>
                        <li>
                            <img src="/img/ok-gray.png" alt="">
                            <a href="">
                                Как зарегистрироваться онлайн?
                            </a>
                        </li>
                        <li>
                            <img src="/img/ok-gray.png" alt="">
                            <a href="">
                                Как зарегистрироваться родителям?
                            </a>
                        </li>
                    </ul>
                </div>
                <h4>
                        <span class="heading-number">
                            2
                        </span>
                    <span class="heading-text">
                          Расскажите, что Вы искали и не нашли
                        </span>
                </h4>
                <div class="text-block">

                    <p>
                        Авторенер - Ваш учебник, Ваша тетрадь и Ваш дневник. В Авторенер есть материалы, чтобы их
                        изучать;
                        есть задачи, чтобы их решать; через Автотренер Вам выставляют оценки за учебу и выдают задания
                        на
                        дом.
                    </p>
                    <div class="text-center">
                        <img src="/img/user5-128x128.jpg" alt="" class="user-avatar">
                    </div>
                    <form action="">
                        <textarea name="" class="form-control" placeholder="Какую информацию нам добавить?"></textarea>
                        <a class="btn-grey ">Отправить</a>
                    </form>
                </div>
                <h4>
                        <span class="heading-number">
                            3
                        </span>
                    <span class="heading-text">
                         Напишите в Поддержку
                        </span>
                </h4>
                <div class="text-block">

                    <p>
                        Если вы не нашли ответа, свяжитесь с нашими специалистами.
                        Команда Поддержки найдет решение.
                    </p>

                    <a class="btn-grey">Задать вопрос</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        var $linkMenu = $('#link_menu');

        $(window).resize(function () {
            if (window.matchMedia("(min-width: 992px)").matches) {
                $linkMenu.collapse('show');
                $('.faq-content').each(function(){
                    var highestBox = 0;
                    $('.col-md-5, .col-md-7', this).each(function(){
                        if($(this).height() > highestBox) {
                            highestBox = $(this).height();
                        }
                    });
                    $('.col-md-5, .col-md-7 ',this).height(highestBox);
                });
            } else {
                $linkMenu.collapse('hide');

                $('.faq-content').find('[class^="col-"]').removeAttr('style');
            }

        }).trigger('resize');

        $linkMenu.on('hide.bs.collapse', function (event) {
            if (window.matchMedia("(min-width: 992px)").matches) {
                event.preventDefault();
            } else {
                $(this).closest('.faq-content').find('.modal-backdrop').fadeOut('fast');
            }
        });

        $linkMenu.on('show.bs.collapse', function(event) {
            if(window.matchMedia("(max-width: 991px)").matches) {
                $(this).closest('.faq-content').find('.modal-backdrop').fadeIn('fast');
            }
        });

    });

</script>
@endpush