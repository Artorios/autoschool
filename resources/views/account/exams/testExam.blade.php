@extends('layouts.account')
@section('content')
        {{--{{dd($examsQuestion)}}--}}
        <test-exam :questions="{{json_encode($examsQuestion)}}" :user-exam="{{json_encode($userExam)}}" :time="{{json_encode($time)}}"></test-exam>




@endsection