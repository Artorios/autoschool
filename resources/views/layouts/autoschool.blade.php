<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                    <a href="{{route('autoschool.edit')}}" class="student-info">

                            @if($logo = \App\Models\Training\School\AutoSchool::where('director_id', Auth::user()->id)->get()->first())
                            <div class="img">
                                <img src="{{asset("storage/school/" . $logo->logo )}}" alt="">
                            </div>
                            @else
                                <div class="img">
                                    <img src="/img/profile-photo.png" alt="">
                                </div>
                            @endif
                            @if(!empty(Auth::user()->autoschool))
                                <h3>{{\App\Models\Training\School\AutoSchool::find(Auth::user()->autoschool)->title}}
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </h3>
                            @endif
                            <span>Комиссия {{all_sum(Auth::user()->id)}} руб.</span>
                    </a>
                    <a href="{{route('autoschool.notify')}}" class="notes">
                        <i class="fa fa-bell-o" aria-hidden="true"></i>
                        <span class="number">
                    {{count(\App\Models\User\Notification::where(['user_id' => Auth::user()->id, 'status' => '1'])->get())}}</span>
                        <span class="title">Уведомления</span>
                    </a>
                    <a href="{{route('faq')}}" class="help">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </header>

        <div class="inner-main-content">
            <div class="container">
                <div class="sidebar collapse" id="sbMenu">
                    <ul>
                        <li class="{{Route::currentRouteName() === 'autoschool.index' ? 'active' : ''}}">
                            <a href="{{route('autoschool.index')}}">
                                <i class="fa fa-suitcase" aria-hidden="true"></i>
                                <span class="text">Главная</span>
                            </a>
                        </li>
                        <li class="{{
                                    Route::currentRouteName() === 'autoschool.filials' ? 'active' : ''}}">
                            <a href="{{route('autoschool.filials')}}">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span class="text">Филиалы</span>
                            </a>
                        </li>
                        <li class="{{Route::currentRouteName() === 'autoschool.coupons' ? 'active' : ''}}">
                            <a href="{{route('autoschool.coupons')}}">
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                <span class="text">Купоны</span>
                            </a>
                        </li>
                        <li class="{{
                                    Route::currentRouteName() === 'autoschool.finance' ? 'active' : ''}}">
                            <a href="{{route('autoschool.finance')}}">
                                <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                                <span class="text">Финансы</span>
                            </a>
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
            <span>
                <i class="fa fa-envelope-open" aria-hidden="true"></i>
                e-mail:
                <a href="#">info@autotrener.com</a>
            </span>
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
<script src="/js/autoschool.js"></script>
@stack('scripts')
<script src="{{ asset('bower_components/matchHeight/dist/jquery.matchHeight-min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.ticket-inner').matchHeight();
    });
</script>
</html>