@extends('layouts.admin')

@section('content')
    {{--{{dd($schools)}}--}}
    <school-vue :schools="{{json_encode($schools)}}"></school-vue>
@endsection