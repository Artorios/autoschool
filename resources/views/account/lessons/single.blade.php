@extends('layouts.account')

@section('content')
    {{--<link type="text/css" rel="stylesheet" href="../node_modules/video.js/dist/video-js.min.css" />
    <script src="../node_modules/video.js/dist/video.min.js"></script>
    <script src="/js/Youtube.min.js"></script>--}}
    {{--{{dd($lesson)}}--}}

    <lesson-vue :lesson="{{json_encode($lesson)}}"></lesson-vue>

@endsection