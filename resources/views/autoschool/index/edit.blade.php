@extends('layouts.autoschool')
@section('content')
    <div class="content error profile">
        <autoschool-profile-edit :autoschools="{{json_encode($info_about_school)}}"></autoschool-profile-edit>
        <edit-pass-form></edit-pass-form>
        <edit-notify-settings :user="{{json_encode(auth()->user())}}"></edit-notify-settings>
    </div>
@endsection
@push('scripts')
<script>
    (function ($) {
        $('#fillials_select').selectric();
    })(jQuery)

</script>
@endpush

