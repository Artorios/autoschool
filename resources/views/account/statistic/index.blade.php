@extends('layouts.account')

@section('content')
        {{--{{dd($returnResult)}}--}}
        <statistic-vue :statistics="{{json_encode($returnLessons)}}"
                        :alldata="{{json_encode($returnResult)}}"></statistic-vue>
    @endsection