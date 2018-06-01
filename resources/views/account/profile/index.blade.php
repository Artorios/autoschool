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
                    <a href="/logout" class="btn-grey btn-exit">
                        <i class="fa fa-power-off" aria-hidden="true"></i>
                        Выход
                    </a>
                </div>
            </div>
            <edit-profile-form :cities="{{json_encode($cities)}}" :userdata="{{json_encode($user)}}"></edit-profile-form>
            {{--<edit-pass-form ></edit-pass-form>--}}

            <div class="pass-change">
                <h4>Смените пароль:</h4>
                <span>Внимание! Пароль должен содержать цифру, заглавную и строчную букву и иметь длинну от 8 до 25 символов</span>

                <form id="form_change_pass" method="post" action="{{ route('account.change.password') }}">
                    <div class="inform"></div>
                    @if(Session::has('pass_message'))
                        <p class="alert alert-{{ Session::get('pass_class') }}">{{ Session::get('pass_message') }}</p>
                    @endif
                    <input type="hidden" value="{!! csrf_token() !!}" name="_token">
                    <div class="form-group">
                        <label>Старый пароль</label>
                        <input type="password" name="old_password">
                        @if ($errors->has('old_password'))
                            <p class="alert alert-danger">{{ $errors->first('old_password') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Новый пароль</label>
                        <input type="password" name="password">
                        @if ($errors->has('password'))
                            <p class="alert alert-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Подтверждение</label>
                        <input type="password" name="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                            <p class="alert alert-danger">{{ $errors->first('password_confirmation') }}</p>
                        @endif
                    </div>
                    <button type="submit" id="btn_change_pass" class="btn-grey">Сохранить изменения</button>
                </form>
            </div>
            <edit-notify-settings></edit-notify-settings>


        </div>
    </div>
@endsection