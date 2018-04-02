@extends('layouts.account')
@section('content')
    <tickets-vue :tickets="{{json_encode($tickets)}}" :show-comments="{{json_encode($show_comment)}}"></tickets-vue>
@endsection