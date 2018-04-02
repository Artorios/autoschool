@extends('layouts.admin')

@section('content')
    <lessons-vue :lessons="{{json_encode($lessons)}}"></lessons-vue>
@endsection