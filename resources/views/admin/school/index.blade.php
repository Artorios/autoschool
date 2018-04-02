@extends('layouts.admin')

@section('content')
    <school-vue :schools="{{json_encode($schools)}}"></school-vue>
@endsection