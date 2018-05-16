@extends('layouts.autoschool')
@section('content')

    <div class="content error profile autoschool-student">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{route('autoschool.index')}}">Главная</a></li>
                <li><a href="{{route('autoschool.index')}}">Ученики</a></li>
                <li><a href="">Добавить студента</a></li>
            </ul>
        </div>
        <h3>
            Добавить ученика
        </h3>
        <add-student
                :schools="{{json_encode($autoschool)}}"
                :coupons="{{json_encode($coupons)}}"
        ></add-student>
    </div>

@endsection
@push('scripts')
<script>
    (function($){
        $('.select').selectric();
    })(jQuery)
</script>
@endpush