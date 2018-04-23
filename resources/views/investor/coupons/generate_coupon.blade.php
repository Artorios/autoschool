@extends('layouts.investor')
@section('content')
    <div class="content error profile autoschool-coupons">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a></li>
                <li><a href="/autoschool/coupons">Купоны</a></li>
                <li><a href="/autoschool/coupons">Генерація купонов</a></li>
            </ul>
        </div>

        <h3>
           Генерация купонов
        </h3>
        <div class="row add-student">
            <div class="col-md-6">
                <div class="form-group">
                    <select class="select">
                        <option selected disabled>Выбрать город</option>
                        <option>156145</option>
                        <option>С845</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="select">
                        <option selected disabled>Количество купонов</option>
                        <option>555</option>
                        <option>5545</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <select class="select">
                        <option selected disabled>Выбрать автошколу</option>
                        <option>156145</option>
                        <option>С845</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Сумма комисии">
                </div>
            </div>
        </div>

        <div class="addstudent">
            <a href="#" class="btn-grey">Генерировать</a>
        </div>

    </div>

@endsection
@push('scripts')
<script>
    (function ($) {
        $('.select').selectric();
    })(jQuery)
</script>
@endpush