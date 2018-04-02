@extends('layouts.admin')

@section('content')
    <lesson-vue :lesson="{{json_encode($lesson)}}" :questions="{{json_encode($questions)}}" :tickets="{{json_encode($all_tickets)}}"></lesson-vue>
@endsection