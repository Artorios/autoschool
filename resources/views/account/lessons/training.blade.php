@extends('layouts.account')


@section('content')
{{--    {{dd($questions['1'])}}--}}
    <training-vue :questions="{{json_encode($questions)}}" :lesson="{{json_encode($lesson)}}" :user-training="{{json_encode($user_training)}}" :time="{{json_encode($time)}}"></training-vue>
@endsection