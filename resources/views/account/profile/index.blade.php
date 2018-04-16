@extends('layouts.account')
@section('content')

    <div class="content inner-main-content">
        <div class="content error profile">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="#">Главная</a></li>
                    <li>Мой профиль</li>
                </ul>
            </div>
            <div class="info-card">
                <profile-photo :user="{{json_encode(Auth::user())}}"></profile-photo>
                <h3>{{Auth::user()->last_name.' '.Auth::user()->name}}<span>(ID {{Auth::user()->id}}) Группа №
                        @if(!empty(Auth::user()->auto_school_group_id))
                        {{Auth::user()->auto_school_group_id}}
                            <?php $auto_school_group_id = Auth::user()->auto_school_group_id; ?>

                        @endif </span></h3>

                <a href="#">
                    @if(!empty($auto_school_group_id))
                    {{\App\Models\Training\School\AutoSchool::find(\App\Models\Training\School\AutoSchoolGroup::find($auto_school_group_id)->auto_school_id)->title }}
                        @endif
                </a>
                <div class="btn-wrapper">
                    <a href="/account/finance" class="btn-grey">Оплата</a>
                    <a href="/logout" class="btn-grey"><img src="/img/img/power.png" alt="">Выход</a>
                </div>
            </div>
            <edit-profile-form :cities="{{json_encode($cities)}}"></edit-profile-form>
            <edit-pass-form></edit-pass-form>
            <edit-notify-settings></edit-notify-settings>


        </div>
    </div>
@endsection