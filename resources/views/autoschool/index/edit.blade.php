@extends('layouts.autoschool')
@section('content')
    <div class="content error profile">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a> / {{$info_about_school->autoschool->title}}</li>
            </ul>
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