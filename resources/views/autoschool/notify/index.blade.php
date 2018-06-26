@extends('layouts.autoschool')
@section('content')
<div class="content error notice">
    <div class="breadcrumbs">
        <ul>
            <li><a href="/autoschool">Главная</a></li>
            <li>Уведомления</li>
        </ul>
    </div>
    <div class="btn-wrapper">
        <a href="{{route('autoschool.notify')}}" class="active">Новые</a>
        <a href="{{route('autoschool.notify.all')}}" >Все</a>
    </div>

    <notify-new :notifies="{{json_encode($notifies->items())}}"></notify-new>
    <nav aria-label="Page navigation example">
        <pages :page="{{json_encode($notifies->currentPage())}}"
               :pages="{{json_encode($notifies->total())}}"
               :total="{{json_encode($notifies->perPage())}}"></pages>


    </nav>
</div>

@endsection