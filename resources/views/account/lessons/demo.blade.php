@extends('layouts.account')

@section('content')
    <demo-lesson-vue :lesson="{{json_encode($lesson)}}"></demo-lesson-vue>
@endsection