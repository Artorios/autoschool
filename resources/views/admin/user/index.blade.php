@extends('layouts.admin')

@section('content')
{{--    {{dd($users)}}--}}
    <user-vue :users="{{json_encode($users)}}"></user-vue>
@endsection