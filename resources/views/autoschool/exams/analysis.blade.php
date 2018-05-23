@extends('layouts.autoschool')


@section('content')
    <exam-analysis :questions="{{json_encode($return_questions)}}"></exam-analysis>
@endsection