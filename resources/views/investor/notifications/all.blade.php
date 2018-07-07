@extends('layouts.investor')
@section('content')
<div class="content error notice">
    <div class="breadcrumbs">
        <ul>
            <li><a href="{{ route('investor.index') }}">Филиалы автошкол</a></li>
            <li>Уведомления</li>
        </ul>
    </div>
    <div class="btn-wrapper">
        <a href="{{ route('investor.notifications.index') }}" >Новые</a>
        <a href="{{ route('investor.notifications.all') }}" class="active">Все</a>
    </div>
    <notify-new :notifies="{{ json_encode($notifications->items()) }}"></notify-new>
    <nav aria-label="Page navigation example">
        <pages :page="{{json_encode($notifications->currentPage())}}"
               :pages="{{json_encode($notifications->total())}}"
               :total="{{json_encode($notifications->perPage())}}"></pages>
    </nav>
</div>

@endsection