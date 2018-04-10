@extends('layouts.account')


@section('content')
    {{--{{dd($return_questions)}}--}}
    <exam-analysis :questions="{{json_encode($return_questions)}}"></exam-analysis>
@endsection