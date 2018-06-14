@extends('layouts.autoschool')
@section('content')
    <div class="content error">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ route('autoschool.index') }}">Главная</a></li>
                <li>Карточка ученика</li>
            </ul>
        </div>
        {{--{{dd($school)}}--}}
        <index-student-new
            :student="{{json_encode($student)}}"
            :status="{{json_encode($status)}}"
            :director="{{json_encode($director)}}"
            :school="{{json_encode($school)}}"
        ></index-student-new>
    </div>
@endsection
@push('scripts')
<script>
    (function ($) {
        $('.select').selectric();
    })(jQuery)
</script>
@endpush