@extends('layouts.autoschool')

@section('content')
    <div class="content error profile finance">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ route('autoschool.index') }}">Главная</a> / Финансы</li>
            </ul>
        </div>
        <h3>Финансовая статистика:</h3>
        <finance-statistic-main></finance-statistic-main>
        <finance-search-students :students="{{json_encode($users)}}"></finance-search-students>

    </div>
@endsection
@push('scripts')
    <script>
        (function ($) {
            $('.select').selectric();
        })(jQuery)
    </script>
@endpush

