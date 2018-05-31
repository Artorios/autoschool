@extends('layouts.admin')

@section('content')
    {{--{{dd($users)}}--}}
    <user-vue :users="{{json_encode($users)}}" :searchplaceholder="{{ json_encode('Поиск по пользователям') }}"></user-vue>
@endsection