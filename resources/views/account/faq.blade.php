@extends('layouts.account')
@section('content')
    <div class="content">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{route('admin.index')}}">Главная</a></li>
                <li><a href="{{route('faq')}}">Справка</a></li>
            </ul>
        </div>

        <div class="row faq-content">
            <div class="col-md-5">
                <div class="search-form">
                    <input type="text" class="icon">
                    <div class="menu-header text-uppercase">
                        <div class="menu-header-burger"></div>
                        <div>Меню справки</div>
                    </div>
                    <div class="link-menu">
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
            <div class="col-md-7">
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
                <h4>
                    <span class="heading-text">Дорожные знаки. Предупреждающие знаки</span>
                </h4>
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
                    <textarea name="" class="form-control" placeholder="Какую информацию нам добавить?"></textarea>
                    <button class="btn-grey ">Отправить</button>
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

                    <button class="btn-grey">Задать вопрос</button>
                </div>
            </div>
        </div>
    </div>
@endsection