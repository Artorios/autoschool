@extends('layouts.account')
@section('content')
    <ticket-questions-vue :questions="{{json_encode($data['questions'])}}"
                          :time="{{json_encode($data['time'])}}"
                          :user-ticket="{{json_encode($data['user_ticket_id'])}}"
                          :with-comment="{{json_encode($data['with_comment'])}}">

    </ticket-questions-vue>
@endsection