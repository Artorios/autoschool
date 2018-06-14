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
                <a href="{{route('user.edit')}}" class="student-info" style="color: black">
                    <div class="img">
                        @if(Auth::user()->image)
                            <img src="/storage/user/{{Auth::user()->image}}" alt="">
                            @else
                            <img src="/img/profile-photo.png" alt="">
                        @endif
                    </div>
                    <h3>{{Auth::user()->name . ' ' . Auth::user()->last_name}}
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </h3>
                    @if(Auth::user()->auto_school_group_id)
                    <span>Группа №{{group_name(Auth::user()->id)}}</span>
                        @endif
                </a>
                <a href="{{route('user.notify')}}" class="notes">
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
                    <li class="{{Route::currentRouteName() === 'user.account' ? 'active' : ''}}">
                        <a href="{{route('user.account')}}">
                            <i class="fa fa-suitcase" aria-hidden="true"></i>
                            <span class="text">Главная</span>
                        </a>
                    </li>
                    <li class="{{
                                    Route::currentRouteName() === 'user.statistic' ? 'active' : ''}}">
                        <a href="{{route('user.statistic')}}">
                            <i class="fa fa-area-chart" aria-hidden="true"></i>
                            <span class="text">Успеваемость</span>
                        </a>
                    </li>
                    <li class="{{
                                    Route::currentRouteName() === 'user.lessons'
                                || Route::currentRouteName() === 'user.lessons.demo'
                                || Route::currentRouteName() === 'user.lessons.training'
                                ? 'active' : ''}}">
                        <a href="{{route('user.lessons')}}">
                            <i class="fa fa-film" aria-hidden="true"></i>
                            <span class="text">Уроки</span>
                            <number-lessons></number-lessons>
                        </a>
                    </li>
                    <li class="{{Route::currentRouteName() === 'account.tickets' ? 'active' : ''}}">
                        <a href="{{route('account.tickets')}}">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <span class="text">Билеты</span>
                        </a>
                    </li>
                    <li class="{{
                                    Route::currentRouteName() === 'user.exams' ? 'active' : ''}}">
                        <a href="{{route('user.exams')}}">
                            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                            <span class="text">Экзамены</span>
                        </a>
                    </li>
                    <li class="{{
                                    Route::currentRouteName() === 'user.finance' ? 'active' : ''}}">
                        <a href="{{route('user.finance')}}">
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
                <a href="mailto:info@autotrener.com">info@autotrener.com</a>
            </span>
            <a href="#">8 (495)<span>369-43-49</span></a>
        </div>
    </div>
</footer>
<div class="modal fade text" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body city-choose">
                    <span class="close" data-dismiss="modal" aria-label="Close">
              </span>
                <h3>Вы еще не просмотрели видео.</h3>
                <span>Поэтому не можете пройти тренировку по данной теме</span>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text" id="errorModalExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body city-choose">
                    <span class="close" data-dismiss="modal" aria-label="Close">
              </span>
                <h3>Вы еще не прошли тренировку.</h3>
                <span>Поэтому не можете пройти зачет по данной теме</span>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.selectric.min.js"></script>
<script type="text/javascript" src="/js/slick.js"></script>
<script src="/js/scripts.js"></script>
<script src="/js/account.js"></script>
@stack('scripts')
<script src="{{ asset('bower_components/matchHeight/dist/jquery.matchHeight-min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.ticket-inner').matchHeight();
    });
</script>
</body>

</html>
