@extends('layouts.account')
@section('content')
    <div class="content error profile">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/account">Главная</a></li>
                <li>Мой профиль</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="img">
                <img src="/img/prof-photo-full.png" alt="">
                <a href="#" class="photo-edit">
                    <img src="/img/pencil.png" alt="">
                </a>
            </div>
            <h3>{{Auth::user()->name . ' ' . Auth::user()->last_name}}<span>(ID 123) Группа № 123</span></h3>
            <a href="#">Автошкола АБВ</a>
            <div class="btn-wrapper">
                <a href="#" class="btn-grey">Оплата</a>
                <a href="/logout" class="btn-grey"><img src="img/power.png" alt="">Выход</a>
            </div>
        </div>
        <form>
            <div class="form-group">
                <label>Имя пользователя:</label>
                <input type="text" value="{{$uinfo->name}}" readonly>
            </div>
            <div class="form-group">
                <label>Фамилия:</label>
                <input type="text" value="{{$uinfo->last_name}}" readonly>
            </div>
            <div class="form-group">
                <label>Отчество:</label>
                <input type="text" value="{{$uinfo->second_name}}" readonly>
            </div>
            <div class="form-group">
                <label>Электронная почта:</label>
                <input type="text" value="{{$uinfo->email}}" readonly>
            </div>
            <div class="form-group">
                <label>Телефон:</label>
                <input type="text" value="{{$uinfo->phone}}" readonly>
            </div>
            <div class="form-group">
                <label>Город:</label>
                <input type="text" value="Москва" readonly>
            </div>
            <div class="form-group">
                <label>Категория:</label>
                <input type="text" value="{{$uinfo->license_category}}" readonly>
            </div>
           {{-- <button type="submit" class="btn-grey">Сохранить изменения</button>--}}
        </form>
        <div class="pass-change">
            <h4>Смените пароль:</h4>
            <span>Внимание! Пароль должен содержать цифру, заглавную и строчную букву и иметь длинну от 8 до 25 символов</span>

            <form id="form_change_pass" method="post" action="{{ route('password.create') }}">
                <div class="inform"></div>
                <input type="hidden" value="{!! csrf_token() !!}" name="_token">
                <div class="form-group">
                    <label>Старый пароль</label>
                    <input type="password" name="old_password">
                </div>
                <div class="form-group">
                    <label>Новый пароль</label>
                    <input type="password" name="password">
                </div>
                <div class="form-group">
                    <label>Подтверждение</label>
                    <input type="password" name="password_confirmation">
                </div>
                <button type="submit" id="btn_change_pass" class="btn-grey">Сохранить изменения</button>
            </form>
        </div>
        <div class="pass-change notes-config">
            <h4>Настройка уведомлений:</h4>
            <form id="form_set_notices">
                <div class="inform"></div>
                <input type="hidden" value="{!! csrf_token() !!}" name="_token">
                <div class="form-group">
                    <input type="checkbox" id="mail" name="email_notice" value="1">
                    <label for="mail">Получать уведомления на почту</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="tel" name="sms_notice" value="1">
                    <label for="tel">Получать уведомления на телефон</label>
                </div>
                <button type="submit" id="btn_set_notices" class="btn-grey">Сохранить изменения</button>
            </form>
        </div>

    </div>
@endsection