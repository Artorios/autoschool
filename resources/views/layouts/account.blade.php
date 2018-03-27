<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Автошкола</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/selectric.css" />
    <link rel="stylesheet" type="text/css" href="/css/slick.css" />
    <link rel="stylesheet" type="text/css" href="/css/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.css">

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
                <a href="/account"><img src="/img/logo.png" alt=""></a>
            </div>
            <div class="menu-toggle-wrapper">
                <div class="menu-toggle" data-toggle="collapse" data-target="#sbMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="right">
                <a href="{{route('user.edit')}}" class="student-info">
                    <div class="img">
                        <img src="/img/profile-photo.png" alt="">
                    </div>
                    <h3>{{Auth::user()->name . ' ' . Auth::user()->last_name}}<img src="/img/arrow-down.png"></h3>
                    <span>Группа № {{Auth::user()->auto_school_group_id}}</span>
                </a>
                <a href="{{route('user.notify')}}" class="notes">
                    <img src="/img/bell.png" alt="">
                    <span class="number">
                        {{count(\App\Models\User\Notification::where(['user_id' => Auth::user()->id, 'status' => '1'])->get())}}</span>
                    <span class="title">Уведомления</span>
                </a>
                <a href="#" class="help">
                    <img src="/img/help.png" alt="">
                </a>
            </div>
        </div>
    </header>

    <div class="inner-main-content">
        <div class="container">
            <div class="sidebar collapse" id="sbMenu">
                <ul>
                    <li class="{{Route::currentRouteName() === 'user.account' ? 'active' : ''}}">
                        <a href="{{route('user.account')}}"><img src="/img/menu-ico1.png" alt=""><span class="text">Главная</span></a>
                    </li>
                    <li class="{{
                                    Route::currentRouteName() === 'user.statistic' ? 'active' : ''}}">
                        <a href="{{route('user.statistic')}}"><img src="/img/menu-ico2.png" alt=""><span class="text">Успеваемость</span></a>
                    </li>
                    <li class="{{
                                    Route::currentRouteName() === 'user.lessons'
                                || Route::currentRouteName() === 'user.lessons.demo'
                                || Route::currentRouteName() === 'user.lessons.training'
                                ? 'active' : ''}}">
                        <a href="{{route('user.lessons')}}"><img src="/img/menu-ico3.png" alt=""><span class="text">Уроки</span><number-lessons></number-lessons></a>
                    </li>
                    <li class="{{Route::currentRouteName() === 'account.tickets' ? 'active' : ''}}">
                        <a href="{{route('account.tickets')}}"><img src="/img/menu-ico4.png" alt=""><span class="text">Билеты</span></a>
                    </li>
                    <li class="{{
                                    Route::currentRouteName() === 'user.exams' ? 'active' : ''}}">
                        <a href="{{route('user.exams')}}"><img src="/img/menu-ico2.png" alt=""><span class="text">Экзамены</span></a>
                    </li>
                    <li class="{{
                                    Route::currentRouteName() === 'user.finance' ? 'active' : ''}}">
                        <a href="{{route('user.finance')}}"><img src="/img/menu-ico2.png" alt=""><span class="text">Финансы</span></a>
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
            <span><img src="/img/mail.png" alt="">e-mail:<a href="#">хххххх@ххх.ru</a></span>
            <a href="#">+7 (495)<span>725-56-76</span></a>
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
<script src="less/less.js"></script>
</body>

</html>
