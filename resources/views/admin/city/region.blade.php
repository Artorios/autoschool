@extends('layouts.admin')

@section('content')
    <region-vue :regions="{{json_encode($regions)}}"></region-vue>
@endsection