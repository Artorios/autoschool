@extends('layouts.admin')

@section('content')
    <question-single :question="{{json_encode($question)}}" :answers="{{json_encode($answers)}}" :tickets="{{json_encode($ticket_list)}}"></question-single>
@endsection

@section('styles')
    <link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection