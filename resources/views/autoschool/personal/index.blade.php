@extends('layouts.autoschool')
@section('content')
    <div class="content error">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ route('autoschool.index') }}">Главная</a></li>
                <li>
                    @if(!empty($studentWithOrders->auto_school_group_id))
                    <a href="{{'/autoschool/filials/groups/' .$studentWithOrders->auto_school_group_id}}"> Ученики</a></li>
                    @endif
                <li>Карточка ученика</li>
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