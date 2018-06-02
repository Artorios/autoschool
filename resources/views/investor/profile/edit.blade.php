@extends('layouts.investor')
@section('content')
    <div class="content error profile">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ route('investor.index') }}">Филиалы автошкол</a></li>
                <li>Карта ЮЛ</li>
            </ul>
        </div>

        @include('partials.messages')

        @include('partials.errors')

        <investor-profile :investor="{{json_encode($investor)}}"></investor-profile>
        <div class="pass-change">
            <h4>Смените пароль:</h4>
            <span>Внимание! Пароль должен содержать цифру, заглавную и строчную букву и иметь длинну от 8 до 25 символов</span>
            <form action="{{ route('investor.profile.password.edit') }}" method="post">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Старый пароль</label>
                    <input type="password" placeholder="*******" name="old_password">
                </div>
                <div class="form-group">
                    <label>Новый пароль</label>
                    <input type="password" placeholder="*******" name="password">
                </div>
                <div class="form-group">
                    <label>Подтверждение</label>
                    <input type="password" placeholder="*******" name="password_confirmation">
                </div>
                <button type="submit" class="btn-grey">Сохранить изменения</button>
            </form>
        </div>
        <edit-notify-settings></edit-notify-settings>
    </div>
@endsection