@extends('layouts.account')


@section('content')
{{--{{dd($lessons)}}--}}
    <lessons-vue :lessons="{{json_encode($lessons)}}"></lessons-vue>
@endsection