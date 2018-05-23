@extends('layouts.account')

@section('content')

    <lesson-vue :lesson="{{json_encode($lesson)}}"></lesson-vue>

@endsection