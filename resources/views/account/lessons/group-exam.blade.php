@extends('layouts.account')


@section('content')
    <group-exam-vue :questions="{{json_encode($questions)}}" :lessons="{{json_encode($lessons)}}" :lesson="{{json_encode($lesson)}}" :user-group-exam="{{json_encode($user_exam)}}" :time="{{json_encode($time)}}"></group-exam-vue>
@endsection