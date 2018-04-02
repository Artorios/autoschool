@extends('layouts.app')

@section('content')
    <registration-vue :cities="{{json_encode($cities)}}"></registration-vue>
@endsection