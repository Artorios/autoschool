@extends('layouts.account')

@section('content')
        {{--{{dd($returnResult)}}--}}
        @if(!empty($returnLessons))
                @if(!empty($returnResult))
                        {{--{{dd($returnLessons)}}--}}
                        <statistic-vue :statistics="{{json_encode($returnLessons)}}"
                                :alldata="{{json_encode($returnResult)}}"></statistic-vue>
                @endif
                @else
        @endif
    @endsection