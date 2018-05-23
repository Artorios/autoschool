@extends('layouts.investor')
@section('content')
    <div class="content error profile">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a> / Карта ЮЛ</li>
            </ul>
        </div>

        @include('partials.messages')

        @include('partials.errors')

        <div class="profile-edit">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="img-profile text-center">
                        <img src="" alt="">c
                        <a class="pen-but" href="#"><img src="/img/penbut.png"></a>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <h3>{{ $profile->short_company_name }}</h3>
                    <div>
                        <a href="{{ route('logout') }}" class="btn-grey"><img src="/img/img/power.png" alt="">Выход</a>
                    </div>
                </div>
            </div>
            <div class="requsites clearfix">
                <div class="radio-button">
                    <input type="radio" name="address-type" id="address-type-1">
                    <label for="address-type-1">Реквизиты юр. лица</label>
                </div>
                <div class="radio-button">
                    <input type="radio" name="address-type" id="address-type-2">
                    <label for="address-type-2">Фактический адрес</label>
                </div>
                <div class="radio-button">
                    <input type="radio" name="address-type" id="address-type-3">
                    <label for="address-type-3">Юридический адрес</label>
                </div>
                <div class="radio-button">
                    <input type="radio" name="address-type" id="address-type-4">
                    <label for="address-type-4">Банк</label>
                </div>
                <div class="radio-button">
                    <input type="radio" name="address-type" id="address-type-5">
                    <label for="address-type-5">Контакты</label>
                </div>
            </div>
        </div>
        <div class="details">
            <form>
                <h3>Реквизиты юр. лица:</h3>
                <div class="form-group">
                    <label>ИНН:</label>
                    <input type="text" placeholder="*****">
                </div>
                <div class="form-group">
                    <label>Сокращенное наименование организации: </label>
                    <input type="text" placeholder="ООО Франчайзи ">
                </div>
                <div class="form-group">
                    <label>Полное наименование организации:</label>
                    <input type="text" placeholder="Общество с ограниченной ответвеностью Франчайзи ">
                </div>
                <div class="form-group">
                    <label>КПП:</label>
                    <input type="text" placeholder="*****">
                </div>
                <div class="form-group">
                    <label>Дата государственной регистрации: </label>
                    <input type="text" placeholder="01.12.2017">
                </div>
                <div class="form-group">
                    <label>Ген. директор: </label>
                    <input type="text" placeholder=" Иванов Иван Иванович">
                </div>
                <button type="submit" class="btn-grey">Сохранить изменения</button>
            </form>
        </div>
        <div class="pass-change">
            <h4>Смените пароль:</h4>
            <span>Внимание! Пароль должен содержать цифру, заглавную и строчную букву и иметь длинну от 8 до 25 символов</span>
            <form action="{{ route('investor.profile.password.edit') }}" method="post">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Старый пароль</label>
                    <input type="password" placeholder="*******" name="old_password">
                </div>
                <div class="form-group">
                    <label>Новый пароль</label>
                    <input type="password" placeholder="*******" name="password">
                </div>
                <div class="form-group">
                    <label>Подтверждение</label>
                    <input type="password" placeholder="*******" name="password_confirmation">
                </div>
                <button type="submit" class="btn-grey">Сохранить изменения</button>
            </form>
        </div>
        <div class="pass-change notes-config">
            <h4>Настройка уведомлений:</h4>
            <form>
                <div class="form-group">
                    <input type="checkbox" id="site">
                    <label for="site">Старый пароль</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="mail">
                    <label for="mail">Получать уведомления на сайт</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="tel">
                    <label for="tel">Получать уведомления на телефон</label>
                </div>
                <button type="submit" class="btn-grey">Сохранить изменения</button>
            </form>
        </div>
    </div>


@endsection