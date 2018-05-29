@extends('layouts.investor')

@section('content')
    <div class="content error profile finance">
        <div class="breadcrumbs">
            <ul>
                <li><a href="">Главная</a> / История</li>
            </ul>
        </div>
        <button href="" id="search-button" class="btn-grey visible-xs ">
            <img src="/img/search.png" alt="">Поиск по параметрам
        </button>

            <history-list></history-list>

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
    (function ($) {
        $('.select').selectric();
        $('#search-button').click(function(){
            $('.search-form').stop().toggle();
        });
    })(jQuery)
</script>
@endpush