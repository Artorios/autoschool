@extends('layouts.admin')

@section('content')
    {{--{{dd($users)}}--}}
    <user-vue :users="{{json_encode($users)}}" :role="{{json_encode($role)}}" :searchplaceholder="{{ json_encode('Поиск по пользователям') }}"></user-vue>
@endsection