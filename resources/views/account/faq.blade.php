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
                        <div class="menu-header-burger"></div><div>Меню справки</div>
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
        </div>

        <div class="col-md-7"></div>
    </div>
    </div>
@endsection