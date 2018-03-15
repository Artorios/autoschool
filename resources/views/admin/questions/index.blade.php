@extends('layouts.admin')

@section('content')
    <questions-vue :questions="{{json_encode($questions)}}"></questions-vue>
@endsection