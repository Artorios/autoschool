@extends('layouts.admin')

@section('content')
    <lessons-settings :lessons-settings="{{json_encode($settings)}}"></lessons-settings>
@endsection