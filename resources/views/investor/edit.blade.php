@extends('layouts.investor')
@section('content')
    <div class="content error profile">
        <h1><a href="#">Главная</a> / Карта ЮЛ</h1>
        <div class="ashstart">
            <div class="cblock">
                <h4>c</h4>
                <a href="#"><img src="/img/penbut.png"></a>
            </div>
            <div class="ashblock">
                <ul>
                    <li><h3>АШ "Старт"</h3></li>
                    <li>
                        <select class="select">
                            <option selected disabled>Филиал Главный</option>
                            <option>филиал1</option>
                            <option>филиал2</option>
                        </select>
                    </li>
                    <li class="but"><a href="#"><i class="fa fa-power-off" aria-hidden="true"></i>Выход</a></li>
                </ul>
            </div>
        </div>
        <div class="requsites">
            <ul>
                <li><a href="#">Реквизиты юр. лица</a></li>
                <li><a href="#">Фактический адрес</a></li>
                <li><a href="#">Юридический адрес</a></li>
                <li><a href="#">Банк</a></li>
                <li><a href="#">Контакты</a></li>
            </ul>
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