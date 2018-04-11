@extends('layouts.account')


@section('content')
    {{--{{dd($return_questions)}}--}}
    <tickets-analysis :questions="{{json_encode($return_questions)}}"
                      :ticket="{{json_encode($ticket)}}"></tickets-analysis>
@endsection