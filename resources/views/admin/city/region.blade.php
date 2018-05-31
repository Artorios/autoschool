@extends('layouts.admin')

@section('content')
    <region-vue :regions="{{json_encode($regions)}}" :searchplaceholder="{{ json_encode('Поиск по регионам') }}"></region-vue>
@endsection