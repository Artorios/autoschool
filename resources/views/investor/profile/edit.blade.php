@extends('layouts.investor')
@section('content')
    <div class="content error profile">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a> / Карта ЮЛ</li>
            </ul>
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
                    <h3>OOO Франчази</h3>
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
        <div class="details">
            <h3>Реквизиты юр. лица:</h3>
            <form>
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
        <edit-pass-form></edit-pass-form>
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