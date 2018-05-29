@extends('layouts.investor')

@section('content')
    <div class="content error profile autoschool-coupons">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ route('investor.index') }}">Филиалы автошкол</a></li>
                <li><a href="{{ route('investor.coupons.index') }}">Купоны</a></li>
                <li>Генерация купонов</li>
            </ul>
        </div>

        @include('partials.messages')

        @include('partials.errors')

        @if(count($auto_schools) > 0)
        <h3>
           Генерация купонов
        </h3>
        <div class="row add-student">
            <form action="{{ route('investor.coupons.create') }}" method="post">
                {{ method_field('POST') }}
                {{ csrf_field() }}
                <div class="col-md-6">
                    <div class="form-group">
                        <select class="select" name="auto_school" required>
                            <option selected disabled>Выбрать автошколу</option>
                            @foreach($auto_schools as $auto_school)
                                <option value="{{ $auto_school->id }}">{{ $auto_school->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="fee_amount" placeholder="Сумма комисии" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="count" placeholder="Количество купонов" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="addstudent">
                        <input type="submit" class="btn-grey" value="Генерировать">
                    </div>
                </div>
            </form>
        </div>
        @else
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="text-center">Для создания купона требуется минимум одна автошкола.</h3>
                </div>
            </div>
        @endif

    </div>

@endsection
@push('scripts')
    <script>
        (function ($) {
            $('.select').selectric();
        })(jQuery)
    </script>
@endpush