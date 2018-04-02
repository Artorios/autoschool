@extends('layouts.admin')

@section('content')
    <price-vue :prices="{{json_encode($cities)}}" :region="{{json_encode($region)}}" :regions="{{json_encode($regions)}}"></price-vue>
@endsection