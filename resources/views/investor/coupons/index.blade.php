@extends('layouts.investor')
@section('content')
    <div class="content error profile autoschool-coupons investor-coupons">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ route('investor.index') }}">Филиалы автошкол</a></li>
                <li>Купоны</li>
            </ul>
        </div>
        <coupon-list></coupon-list>
    </div>

    <div class="modal fade" id="modal_dialog_cancel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-coupons-cancel">
                    <div class="row">
                        <div class="col-xs-12 col-sm-7">
                            <textarea name="" id="" rows="2" placeholder="Комментарий для истории причины действия">
                            </textarea>
                        </div>
                        <div class="col-xs-11 col-sm-4">
                            <a href="" class="btn-grey">Продолжить</a>
                        </div>
                    </div>
                    <span class="close" data-dismiss="modal"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_dialog_delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-coupons-delete">
                    <div>
                        <div class="row">
                            <div class="col-xs-12 text">
                                Подтвердите действие для отмеченых элементов
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <a href="" class="btn-grey">Удалить</a>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <button class="btn-link" data-dismiss="modal">Отмена</button>
                            </div>
                        </div>
                        <span class="close"></span>
                    </div>
                </div>
            </div>
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