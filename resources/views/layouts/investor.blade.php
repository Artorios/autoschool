<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Курс ПДД АвтоТренер - это возможность обучаться теории в любой
    автошколе онлайн по профессиональным видео урокам,
    решать тесты и зачеты по билетам ПДД в личном кабинете online.">
    <meta name="keywords" content="Автошкола online,автошкола онлайн,автошкола онлайн обучение,автошкола auto online,auto online автошкола education">
    <meta name="keywords" content="автошкола auto online отзывы,билеты ПДД решать онлайн,автошкола тесты онлайн,автошкола теория онлайн,автошкола онлайн видео уроки">
    <title>Автошкола online АвтоТренер - единый сервис online обучения в автошколах.
        Онлайн изучение ПДД - это дистанционное обучение теоретическому курсу в автошколах без обязательного посещения лекций.</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/selectric.css" />
    <link rel="stylesheet" type="text/css" href="/css/slick.css" />
    <link rel="stylesheet" type="text/css" href="/css/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="/css/app.min.css">
    
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="app">
    <div>
        <header class="inner">
            <div class="container">
                <div class="logo">
                    <a href="/"><img src="/img/logo.png" alt=""></a>
                </div>
                <div class="menu-toggle-wrapper">
                    <div class="menu-toggle" data-toggle="collapse" data-target="#sbMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div class="right">
                    <a href="{{ route('investor.profile.index') }}" class="student-info" style="color: black">
                        <div class="student-info">
                            <div class="img">
                                @if(Auth::user()->image)
                                    <img src="/storage/user/{{Auth::user()->image}}" alt="">
                                @else
                                    <img src="/img/profile-photo.png" alt="">
                                @endif
                            </div>
                            <h3>{{Auth::user()->name . ' ' . Auth::user()->last_name}}<img src="/img/arrow-down.png"></h3>
                            <span>Комиссия 10 000 руб.</span>
                        </div>
                    </a>
                    <a href="{{ route('investor.notifications.index', ['show' => 'new']) }}" class="notes">
                        <img src="/img/bell.png" alt="">
                        <span class="number">
                            {{ \App\Models\User\Notification::where(['user_id' => Auth::id(), 'status' => '1'])->count() }}
                        </span>
                        <span class="title">Уведомления</span>
                    </a>
                    <a href="{{route('faq')}}" class="help">
                        <img src="/img/help.png" alt="">
                    </a>
                </div>
            </div>
        </header>
        
        <div class="inner-main-content">
            <div class="container">
                <div class="sidebar collapse" id="sbMenu">
                    <ul>
                        <li class="{{Route::currentRouteName() === 'investor.index' ? 'active' : ''}}">
                            <a href="{{route('investor.index')}}"><img src="/img/menu-ico1.png" alt=""><span class="text">Главная</span></a>
                        </li>
                        <li class="{{Route::currentRouteName() === 'investor.coupons.index' ? 'active' : ''}}">
                            <a href="{{route('investor.coupons.index')}}"><img src="/img/menu-ico4.png" alt=""><span class="text">Купоны</span></a>
                        </li>
                        <li class="{{Route::currentRouteName() === 'investor.finance.index' ? 'active' : ''}}">
                            <a href="{{route('investor.finance.index')}}"><img src="/img/menu-ico2.png" alt=""><span class="text">Финансы</span></a>
                        </li>
                        <li class="{{Route::currentRouteName() === 'investor.history.index' ? 'active' : ''}}">
                            <a href="{{route('investor.history.index')}}"><img src="/img/menu-ico2.png" alt=""><span class="text">История</span></a>
                        </li>
                    </ul>
                </div>

                @yield('content')
            </div>
        </div>
    </div>
</div>


<footer class="inner">
    <div class="container">
        <div class="logo">
            <img src="/img/logo.png" alt="">
            <span>Единый сервис on-line обучения в автошколах</span>
        </div>
        <div class="right">
            <span><img src="/img/mail.png" alt="">e-mail:<a href="#">info@autotrener.com</a></span>
            <a href="#">8 (495)<span>369-43-49</span></a>
        </div>
    </div>
</footer>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.selectric.min.js"></script>
<script type="text/javascript" src="/js/slick.js"></script>
<script src="/js/scripts.js"></script>
<script src="/js/investor.js"></script>

@stack('scripts')

</html>