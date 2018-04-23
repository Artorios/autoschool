@extends('layouts.autoschool')
@section('content')

    <div class="content error profile autoschool-student">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a> / Ученики / Добавить студента</li>
            </ul>
        </div>

        <h3>
            Добавить ученика
        </h3>
        <div class="row add-student">
            <div class="col-md-6">
                <div class="form-group">
                        <input type="text"  class="form-control" placeholder="Имя*">
                </div>
                <div class="form-group">
                    <input type="text"  class="form-control" placeholder="Фамилия*">
                </div>
                <div class="form-group">
                    <input type="text"  class="form-control" placeholder="Отчество">
                </div>

                <div class="form-group">
                        <input type="text"  class="form-control" placeholder="Электронная почта*">
                </div>
                <div class="form-group">
                        <input type="text"  class="form-control" placeholder="Телефон*">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <select class="select">
                        <option selected disabled>Купон</option>
                        <option>156145</option>
                        <option>С845</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="select">
                        <option selected disabled>Група</option>
                        <option>555</option>
                        <option>5545</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea name="" id="" class="form-control" rows="10"></textarea>
                </div>
            </div>
        </div>

        <div class="addstudent">
            <a href="#" class="btn-grey"> Добавить</a>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    (function($){
        $('.select').selectric();
    })(jQuery)
</script>
@endpush