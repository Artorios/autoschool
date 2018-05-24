@extends('layouts.investor')

@section('content')
    <div class="content error profile investor">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ route('investor.index') }}">Главная</a> /Финансы</li>
            </ul>
        </div>
        
        <finance-list></finance-list>
        <h3>Статистика купонов:</h3>
        @include('investor._statistics')
        
        <div class="invitegroupe">
            <ul class="pagination">
                <li class="page-item">
                    {{--<a :class="[{active: currentPage === 1}, 'page-link']" href="#">1</a>--}}
                    {{--<a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">2</a>--}}
                    {{--<a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">3</a>--}}
                    {{--<a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">4</a>--}}
                </li>
            </ul>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    (function($){
        $('.select').selectric();
    })(jQuery)
</script>
@endpush