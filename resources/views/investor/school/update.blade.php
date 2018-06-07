@extends('layouts.investor')
@section('content')
    <div class="content error profile">
        <auto-school-profile-edit
                :autoschool="{{json_encode($autoschool)}}">
        </auto-school-profile-edit>
    </div>
@endsection