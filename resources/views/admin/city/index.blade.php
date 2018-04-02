@extends('layouts.admin')

@section('content')
    <city-vue :cities="{{json_encode($cities)}}"></city-vue>
@endsection