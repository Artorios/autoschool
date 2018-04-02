@extends('layouts.admin')

@section('content')
    <question-vue :questions="{{json_encode($questions)}}"></question-vue>
@endsection