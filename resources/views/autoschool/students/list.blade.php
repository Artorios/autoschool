@extends('layouts.autoschool')
@section('content')

    <div class="content error profile autoschool-student">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{route('autoschool.index')}}">Главная</a> / Ученики</li>
            </ul>
        </div>
        <div class="studentgroupe">
            <h4>Ученики группы {{$group->name}}:</h4>
            <student-list   :students="{{json_encode($students)}}"
                            :group="{{json_encode($group)}}"
            ></student-list>
        </div>
        <div class="addstudent">
            <a href="{{ route('autoschool.add-student') }}" class="btn-grey"> Добавить ученика</a>
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