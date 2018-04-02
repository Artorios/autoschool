@extends('layouts.admin')

@section('content')
    <district-vue :districts="{{json_encode($districts)}}"></district-vue>
@endsection