@extends('layouts.investor')

@section('content')
    <div class="content error profile investor">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ route('investor.index') }}">Филиалы автошкол</a></li>
                <li>Финансы</li>
            </ul>
        </div>
        <statistic-finance-list></statistic-finance-list>
        <h3>Статистика купонов:</h3>
        @include('investor._statistics')
    </div>
@endsection
@push('scripts')
<script>
    (function($){
        $('.select').selectric();
    })(jQuery)
</script>
@endpush