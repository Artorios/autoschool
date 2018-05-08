@extends('layouts.investor')
@section('content')
<div class="content error notice">
    <div class="breadcrumbs">
        <ul>
            <li><a href="/investor">Главная</a></li>
            <li>Уведомления</li>
        </ul>
    </div>
    <div class="btn-wrapper">
        <a href="{{ route('investor.notifications.index', ['show' => 'new']) }}" class="{{ app('request')->input('show') == 'new' ? 'active' : '' }}">Новые</a>
        <a href="{{ route('investor.notifications.index') }}" class="{{ app('request')->input('show') != 'new' ? 'active' : '' }}">Все</a>
    </div>
    <notify-new :notifies="{{ json_encode($notifications->items()) }}"></notify-new>
    <nav aria-label="Page navigation example">
        <pages :page="{{ json_encode($notifications->currentPage()) }}"
               :pages="{{ json_encode($notifications->total()) }}"></pages>
    </nav>
</div>

@endsection