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
                <profile-photo :user="{{json_encode($user)}}"></profile-photo>
                <h3>{{$user->last_name.' '.$user->name}}
                    <span>(ID {{$user->id}}) Группа №
                        @if(!empty($user->auto_school_group_id))
                            {{$user->auto_school_group_id}}
                        @endif
                    </span>
                </h3>
                <a href="#">
                    @if(!empty($user->auto_school_group_id))
                        {{\App\Models\Training\School\AutoSchool::find(\App\Models\User\User::find(Auth::user()->id)->autoschool)->title }}
                    @endif
                </a>
                <div class="btn-wrapper">
                    <a href="/account/finance" class="btn-grey">Оплата</a>
                    <a href="/logout" class="btn-grey"><img src="/img/img/power.png" alt="">Выход</a>
                </div>
            </div>
            <edit-profile-form :cities="{{json_encode($cities)}}" :userdata="{{json_encode($user)}}"></edit-profile-form>
            <edit-pass-form ></edit-pass-form>
            <edit-notify-settings></edit-notify-settings>


        </div>
    </div>
@endsection