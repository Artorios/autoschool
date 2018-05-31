@extends('layouts.admin')

@section('content')
    {{--{{dd($schools)}}--}}
    <school-vue :schools="{{json_encode($schools)}}" :searchplaceholder="{{ json_encode('Поиск по автошколам') }}"></school-vue>
@endsection