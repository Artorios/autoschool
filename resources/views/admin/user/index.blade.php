@extends('layouts.admin')

@section('content')
    {{--{{dd($schools)}}--}}
    <user-vue :users="{{json_encode($users)}}"></user-vue>
@endsection