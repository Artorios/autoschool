@extends('layouts.autoschool')
@section('content')
    <div class="content error profile">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a> /Карта ЮЛ</li>
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
                    <h3>АШ "Старт"</h3>
                    <div class="form-group">
                        <div class="selectric-wrapper">
                            <div class="selectric">
                                <span class="label">Филиал Главный</span>
                                <b class="button">▾</b>
                                <select  class="select" id="fillials_select">
                                    <option selected disabled>Филиал Главный</option>
                                    <option>филиал1</option>
                                    <option>филиал2</option>
                                </select>
                            </div>
                        </div>
                    </div>
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
        <edit-notify-settings></edit-notify-settings>
    </div>


@endsection
@push('scripts')
<script>
    (function ($) {
        $('#fillials_select').selectric();
    })(jQuery)
</script>
@endpush