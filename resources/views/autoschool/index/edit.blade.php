@extends('layouts.autoschool')
@section('content')
    <div class="content error profile">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a> / {{$info_about_school->autoschool->title}}</li>
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
        <autoschool-profile-edit :profile="{{json_encode($info_about_school)}}"></autoschool-profile-edit>
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