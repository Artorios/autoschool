@extends('layouts.admin')

@section('content')
    <user-vue :users="{{json_encode($users)}}"></user-vue>
@endsection