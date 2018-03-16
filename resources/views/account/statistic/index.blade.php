@extends('layouts.account')

@section('content')
        <statistic-vue :statistics="{{json_encode($returnLessons)}}"></statistic-vue>
@endsection