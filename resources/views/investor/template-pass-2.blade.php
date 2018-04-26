@extends('layouts.investor')
@section('content')
    <div class="content error profile">
        <div class="pass-change">
            <h4>Новый пароль:</h4>
            <span>Внимание! Пароль должен содержать цифру, заглавную и строчную букву и иметь длинну от 8 до 25 символов</span>
            <form>
                <div class="form-group">
                    <label>Новый пароль</label>
                    <input type="password" placeholder="*******">
                </div>
                <div class="form-group">
                    <label>Подтверждение</label>
                    <input type="password" placeholder="*******">
                </div>
                <button type="submit" class="btn-grey">Сохранить изменения</button>
            </form>
        </div>
    </div>
@endsection