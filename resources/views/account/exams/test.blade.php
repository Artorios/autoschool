@extends('layouts.account')
@section('content')
        {{dd($examsQuestion)}}
        <exam-vue :questions="{{json_encode($questions)}}" :lesson="{{json_encode($lesson)}}"
        :user-exam="{{json_encode($user_exam)}}" :time="{{json_encode($time)}}"></exam-vue>


@endsection