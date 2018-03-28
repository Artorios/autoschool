<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Автошкола</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/slick.css" />
    <link rel="stylesheet" type="text/css" href="/css/slick-theme.css" />
    @if(Route::currentRouteName() === 'regUser')
        <link rel="stylesheet" type="text/css" href="/css/selectric.css" />
    @endif
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <!--<link rel="stylesheet/less" href="css/style.less">-->

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div id="app">
    <header>
        <div class="top-line">
            <div class="container">
                <ul>
                    <li><a href="/#kak-uchim">Как мы учим</a></li>
                    <li><a href="/#top7plus">7 плюсов</a></li>
                    <li><a href="/#komu">Для кого</a></li>
                    <li><a href="/#otzuv">Отзывы</a></li>
                    <li><a href="/#sale">Купить</a></li>
                    <li><a href="/#contact">Контакты</a></li>
                </ul>
                <div class="right">
                    @if(Auth::check())
                        @if(Auth::user()->isAdmin())
                            <a href="{{route('admin.users')}}"><img src="img/lock.png" alt="">Админ панель</a>
                            <a href="{{route('logout')}}">Выход</a>
                        @else
                            <a href="{{route('user.account')}}"><img src="img/lock.png" alt="">Кабинет
                                {{Auth::user()->name . ' ' . Auth::user()->last_name}}</a>
                            {{--<a href="#">Активировать купон</a>--}}
                            <a href="{{route('logout')}}">Выход</a>
                        @endif

                    @else
                        <a href="{{route('authUser')}}"><img src="img/lock.png" alt="">Войти</a>
                        <a href="#">Активировать купон</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="logo-line">
            <div class="container">
                <div class="logo">
                    <img src="/img/logo.png" alt="">
                    <span>Единый сервис on-line обучения в автошколах</span>
                </div>
                <a href="#" class="phone">+7 (495) <span>725-56-76</span></a>
                <modal-vue></modal-vue>
            </div>
        </div>
        @if(!in_array(Route::currentRouteName(), ['regUser', 'authUser']))
            <div class="header-block">
                <div class="container">
                    <div class="info">
                        <h1>Сдайте ПДД с 1-го раза</h1>
                        <span>Онлайн-курс «АвтоТренер» вместо посещения лекций в автошколе</span>
                        <a href="{{route('regUser')}}" class="btn-red">Попробуйте  бесплатно</a>
                    </div>
                    <img src="/img/box.png" alt="">
                </div>
            </div>
        @endif
    </header>
    @yield('content')
    <yandex-map :city="'Санкт Петербург'"></yandex-map>
</div>
<footer>
    <div class="info" id="contact">
        <div class="container">
            <div class="contacts">
                <h4>Контакты:</h4>
                <ul>
                    <li class="adress">
                        <div class="ico"><img src="img/location.png" alt=""></div>
                        <span>Россия, г. Москва, ул. Условная, д. 8.</span>
                    </li>
                    <li class="time">
                        <div class="ico"><img src="img/clock.png" alt=""></div>
                        <span>мы работаем: пн - вс 9:00 - 18:00 Mск (без выходных)</span>
                    </li>
                    <li class="tel">
                        <div class="ico"><img src="img/tel.png" alt=""></div>
                        <a href="#">+7 (495) <span>725-56-76</span></a>
                    </li>
                    <li class="mail">
                        <div class="ico"><img src="img/mail.png" alt=""></div>
                        <a href="#">xxxxx@xxxxx.su</a>
                    </li>
                </ul>
            </div>
            <div class="question">
                <span>Остались вопросы?</span>
                <form>
                    <input type="text" placeholder="Ваш телефон">
                    <input type="text" placeholder="Ваше имя">
                    <textarea placeholder="Текст вопроса*"></textarea>
                    <a href="#" class="btn-red">Задать вопрос</a>
                </form>
            </div>
        </div>
    </div>
    {{--<div class="map">--}}
    {{--<div class="map-wrapper">--}}
    {{--<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Aabb13e8ec510da7acc3e1d31034688dcd1efe4d341a74497bef8ef1d6cf69a0e&amp;width=100%25&amp;height=240&amp;lang=ru_RU&amp;scroll=true"></script>--}}
    {{--</div>--}}
    {{--</div>--}}
    <div class="bottom-line">
        <div class="container">
            <div class="logo">
                <img src="img/logo.png" alt="">
                <span>Единый сервис on-line обучения в автошколах</span>
            </div>
            <div class="site-map">
                <div class="middle">
                    <span>2017 © онлайн-курс «АвтоТренер»</span>
                    <a href="#">Политика конфиденциальности</a>
                </div>
                <div class="right">
                    <a href="#">Карта сайта</a>
                    <span>Разработка сайта KAOMA.ru</span>
                    <img src="img/stat.png" alt="">
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Modal -->
<div class="modal text" id="textModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body city-choose">
                    <span class="close" data-dismiss="modal" aria-label="Close">
              </span>
                <h3>Спасибо, Ваша заявка принята.</h3>
                <span>Наши специалисты свяжутся с вами в течение 30 минут.</span>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/slick.js"></script>
<script type="text/javascript" src="/js/jquery.selectric.min.js"></script>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script src="/js/scripts.js"></script>
<script src="/js/distrib.js"></script>
</body>
</html>
