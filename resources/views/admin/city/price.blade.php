@extends('layouts.admin')

@section('content')
    <price-vue :prices="{{json_encode($cities)}}" :region="{{json_encode($region)}}"
               :regions="{{json_encode($regions)}}"
               :searchplaceholder="{{ json_encode('Поиск по городам') }}"></price-vue>
@endsection