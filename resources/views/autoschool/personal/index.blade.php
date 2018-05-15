@extends('layouts.autoschool')
@section('content')
    <div class="content error">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ route('autoschool.filials') }}">Главная</a></li>
                <li>
                    <a href="{{'/autoschool/filials/groups/' .$studentWithOrders->auto_school_group_id}}"> Ученики</a></li>
                <li><a href="">Карточка ученика</a></li>
            </ul>
        </div>

        <index-student
            :student_with_orders="{{json_encode($studentWithOrders)}}"
            :student_with_auto_school="{{json_encode($studentWithAutoSchool)}}"
            :student_with_address="{{json_encode($studentWithAddress)}}"
        ></index-student>
    </div>
@endsection
@push('scripts')
<script>
    (function ($) {
        $('.select').selectric();
    })(jQuery)
</script>
@endpush