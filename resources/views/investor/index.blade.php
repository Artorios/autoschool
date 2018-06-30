@extends('layouts.investor')

@section('content')
    <div class="content error profile investor">
        <div class="breadcrumbs">
            <ul>
                <li>Филиалы автошкол</li>
            </ul>
        </div>
        {{--{{dd($schools)}}--}}
        <schools-list :schools="{{json_encode($schools)}}"></schools-list>
        <statistic :coupons="{{json_encode($coupons)}}"></statistic>

        <div class="invitegroupe">
            <ul class="pagination">
                <li class="page-item">
                   {{-- <a :class="[{active: currentPage === 1}, 'page-link']" href="#">1</a>
                    <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">2</a>
                    <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">3</a>
                    <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#">4</a>--}}
                </li>
            </ul>
        </div>
    </div>
@endsection