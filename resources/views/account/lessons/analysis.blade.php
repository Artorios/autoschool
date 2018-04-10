@extends('layouts.account')


@section('content')
    {{--{{dd($lesson)}}--}}
    <analysis-vue :questions="{{json_encode($return_questions)}}" :lesson="{{json_encode($lesson)}}" :training="{{json_encode($training)}}"></analysis-vue>
@endsection