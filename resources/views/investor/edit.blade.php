@extends('layouts.investor')
@section('content')
    <div class="content error profile">
        <h1><a href="#">Главная</a> / Карта ЮЛ</h1>
        <div class="ashstart">
            <div class="cblock">
                <h4>c</h4>
                <a href="#"><img src="/img/penbut.png"></a>
            </div>
            <div class="profile-edit">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="img-profile text-center">
                            <img src="" alt="">c
                            <a class="pen-but" href="#"><img src="/img/penbut.png"></a>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <h3>АШ "Старт"</h3>
                        <div>
                            <a href="" class="btn-grey"><img src="/img/img/power.png" alt="">Выход</a>
                        </div>
                    </div>

                </div>

                <div class="requsites">
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
        <div class="pass-change">
            <h4>Смените пароль:</h4>
            <span>Внимание! Пароль должен содержать цифру, заглавную и строчную букву и иметь длинну от 8 до 25 символов</span>
            <form>
                <div class="form-group">
                    <label>Старый пароль</label>
                    <input type="password" placeholder="*******">
                </div>
                <div class="form-group">
                    <label>Новый пароль</label>
                    <input type="password" placeholder="*******">
                </div>
                <div class="form-group">
                    <label>Подтверждение</label>
                    <input type="password" placeholder="*******">
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