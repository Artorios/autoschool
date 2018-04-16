@extends('layouts.account')
@section('content')
    <div class="content error notice" id="app">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/account">Главная</a></li>
                <li>Уведомления</li>
            </ul>
        </div>
        <div class="btn-wrapper">
            <a href="{{route('user.notify')}}">Новые</a>
            <a href="{{route('user.notify.all')}}" class="active">Все</a>
        </div>
        <notify-all :notifies="{{json_encode($notifies->items())}}"></notify-all>
        <nav aria-label="Page navigation example">
            <pages :page="{{json_encode($notifies->currentPage())}}"
                    :pages="{{json_encode($notifies->total())}}"
                    :total="{{json_encode($notifies->perPage())}}"></pages>
        </nav>
    </div>

@endsection