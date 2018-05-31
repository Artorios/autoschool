@extends('layouts.admin')

@section('content')
    <lessons-vue :lessons="{{json_encode($lessons)}}" :searchplaceholder="{{ json_encode('Поиск по урокам') }}"></lessons-vue>
@endsection