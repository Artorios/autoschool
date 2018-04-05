<template>
    <div>
        <div class="modal-backdrop in "></div>
        <div class="modal online-invoice-modal in" id="onlinePaymentModal" @click.self="close" aria-hidden="true">
            <div class="modal-dialog online-invoice-dialog">
                <div class="modal-content">
                    <div class="modal-body online-invoice-content city-choose">
                        <span class="close" data-dismiss="modal" aria-label="Close" @click="close"></span>
                        <div class="lessons finance">
                            <div class="receipt">
                                <div class="notice">
                                    <span>Извещание</span>
                                    <span>Касир</span>
                                </div>
                                <div class="blank">
                                    <div class="info-form">
                                        Форма №ПД-4
                                    </div>
                                    <div class="name-block out-data">
                                        ИП Рыбин Сергей Игорович
                                    </div>
                                    <div class="title-recipient">(найменование получателя платежа)</div>
                                    <div class="blank-line two-blocks-row">
                                        <div class="first">
                                            <div class="number-blank">
                                                <div class="correct-number">
                                                    7
                                                </div>
                                                <div class="correct-number">
                                                    7
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                            </div>
                                            <div class="blank-text">(ИНН получателя платежа)</div>
                                        </div>
                                        <div class="second">
                                            <div class="number-blank">
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                            </div>
                                            <div class="blank-text">(номер получателя платежа)</div>
                                        </div>
                                    </div>
                                    <div class="blank-line three-blocks-row">
                                        <div class="first dark-border-bottom">
                                            ОАО "АЛЬФА-БАНК", МОСКВА
                                        </div>
                                        <div class="second">
                                            БИК:
                                        </div>
                                        <div class="third">
                                            <div class="number-blank">
                                                <div class="correct-number">
                                                    0
                                                </div>
                                                <div class="correct-number">
                                                    4
                                                </div>
                                                <div class="correct-number">
                                                    4
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    2
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    9
                                                </div>
                                                <div class="correct-number">
                                                    3
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blank-line four-blocks-row">
                                        <div class="first">
                                            Номер кор./сч. банка получателя платежа:
                                        </div>
                                        <div class="second">
                                            <div class="number-blank">
                                                <div class="correct-number">
                                                    0
                                                </div>
                                                <div class="correct-number">
                                                    4
                                                </div>
                                                <div class="correct-number">
                                                    4
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    2
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    9
                                                </div>
                                                <div class="correct-number">
                                                    3
                                                </div>
                                                <div class="correct-number">
                                                    3
                                                </div>
                                                <div class="correct-number">
                                                    0
                                                </div>
                                                <div class="correct-number">
                                                    4
                                                </div>
                                                <div class="correct-number">
                                                    4
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    2
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    9
                                                </div>
                                                <div class="correct-number">
                                                    3
                                                </div>
                                                <div class="correct-number">
                                                    3
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="blank-line five-blocks-row custom">
                                        <div class="first">
                                            <div class="first-more dark-border-bottom">
                                                <span class="out-data">Оплата заказа №4</span>
                                            </div>
                                            <span class="title-recipient">(найменование платежа)</span>
                                        </div>
                                        <div class="second">
                                            <div class="second-less dark-border-bottom">
                                            </div>
                                            <span class="title-recipient">(номер лицевого счета (код) плательщика)</span>

                                        </div>

                                    </div>

                                    <div class="blank-line names-line">
                                        <div class="names-text">Ф.И.О. плательщика</div>
                                        <div class="dark-border-bottom"></div>
                                    </div>
                                    <div class="blank-line names-line">
                                        <div class="names-text">Адрес плательщика</div>
                                        <div class="dark-border-bottom"></div>
                                    </div>
                                    <div class="blank-line sum-line">
                                        <div class="first">
                                            <div>Сумма платежа</div>
                                            <div class="dark-tin-border-bottom"></div>
                                            <div>руб.</div>
                                            <div class="dark-tin-border-bottom short"></div>
                                            <div>коп.</div>
                                        </div>
                                        <div class="second">
                                            <div>Сумма платы за услуги</div>
                                            <div class="dark-tin-border-bottom"></div>
                                            <div>руб.</div>
                                            <div class="dark-tin-border-bottom short"></div>
                                            <div>коп.</div>
                                        </div>
                                    </div>
                                    <div class="blank-line sum-line">
                                        <div class="first">
                                            <div>Итого:</div>
                                            <div class="dark-tin-border-bottom"></div>
                                            <div>руб.</div>
                                            <div class="dark-tin-border-bottom short"></div>
                                            <div>коп.</div>
                                        </div>
                                        <div class="second">
                                            <span>"</span>
                                            <div class="dark-tin-border-bottom short">
                                            </div>
                                            <span>"</span>
                                            <div class="dark-tin-border-bottom"></div>
                                            <div>201</div>
                                            <div class="dark-tin-border-bottom short"></div>
                                            <div>г.</div>
                                        </div>
                                    </div>
                                    <div class="blank-text-block">
                                        С условиями приема указанной в платежном документе суммы, в т. ч. с суммой взымаемой платы за услуги банка, ознакомлен и
                                        согласен.
                                    </div>
                                    <div class="blank-line signature-line">

                                        <span>Подпись платильщика</span>
                                        <div class="dark-tin-border-bottom"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="receipt">
                                <div class="notice">
                                    <span>Извещание</span>
                                    <span>Касир</span>
                                </div>
                                <div class="blank">
                                    <div class="info-form">
                                        Форма №ПД-4
                                    </div>
                                    <div class="name-block out-data">
                                        ИП Рыбин Сергей Игорович
                                    </div>
                                    <div class="title-recipient">(найменование получателя платежа)</div>
                                    <div class="blank-line two-blocks-row">
                                        <div class="first">
                                            <div class="number-blank">
                                                <div class="correct-number">
                                                    7
                                                </div>
                                                <div class="correct-number">
                                                    7
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                            </div>
                                            <div class="blank-text">(ИНН получателя платежа)</div>
                                        </div>
                                        <div class="second">
                                            <div class="number-blank">
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                            </div>
                                            <div class="blank-text">(номер получателя платежа)</div>
                                        </div>
                                    </div>
                                    <div class="blank-line three-blocks-row">
                                        <div class="first dark-border-bottom">
                                            ОАО "АЛЬФА-БАНК", МОСКВА
                                        </div>
                                        <div class="second">
                                            БИК:
                                        </div>
                                        <div class="third">
                                            <div class="number-blank">
                                                <div class="correct-number">
                                                    0
                                                </div>
                                                <div class="correct-number">
                                                    4
                                                </div>
                                                <div class="correct-number">
                                                    4
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    2
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    9
                                                </div>
                                                <div class="correct-number">
                                                    3
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blank-line four-blocks-row">
                                        <div class="first">
                                            Номер кор./сч. банка получателя платежа:
                                        </div>
                                        <div class="second">
                                            <div class="number-blank">
                                                <div class="correct-number">
                                                    0
                                                </div>
                                                <div class="correct-number">
                                                    4
                                                </div>
                                                <div class="correct-number">
                                                    4
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    2
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    9
                                                </div>
                                                <div class="correct-number">
                                                    3
                                                </div>
                                                <div class="correct-number">
                                                    3
                                                </div>
                                                <div class="correct-number">
                                                    0
                                                </div>
                                                <div class="correct-number">
                                                    4
                                                </div>
                                                <div class="correct-number">
                                                    4
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    2
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    5
                                                </div>
                                                <div class="correct-number">
                                                    9
                                                </div>
                                                <div class="correct-number">
                                                    3
                                                </div>
                                                <div class="correct-number">
                                                    3
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="blank-line five-blocks-row custom">
                                        <div class="first">
                                            <div class="first-more dark-border-bottom">
                                                <span class="out-data">Оплата заказа №4</span>
                                            </div>
                                            <span class="title-recipient">(найменование платежа)</span>
                                        </div>
                                        <div class="second">
                                            <div class="second-less dark-border-bottom">
                                            </div>
                                            <span class="title-recipient">(номер лицевого счета (код) плательщика)</span>

                                        </div>

                                    </div>

                                    <div class="blank-line names-line">
                                        <div class="names-text">Ф.И.О. плательщика</div>
                                        <div class="dark-border-bottom"></div>
                                    </div>
                                    <div class="blank-line names-line">
                                        <div class="names-text">Адрес плательщика</div>
                                        <div class="dark-border-bottom"></div>
                                    </div>
                                    <div class="blank-line sum-line">
                                        <div class="first">
                                            <div>Сумма платежа</div>
                                            <div class="dark-tin-border-bottom"></div>
                                            <div>руб.</div>
                                            <div class="dark-tin-border-bottom short"></div>
                                            <div>коп.</div>
                                        </div>
                                        <div class="second">
                                            <div>Сумма платы за услуги</div>
                                            <div class="dark-tin-border-bottom"></div>
                                            <div>руб.</div>
                                            <div class="dark-tin-border-bottom short"></div>
                                            <div>коп.</div>
                                        </div>
                                    </div>
                                    <div class="blank-line sum-line">
                                        <div class="first">
                                            <div>Итого:</div>
                                            <div class="dark-tin-border-bottom"></div>
                                            <div>руб.</div>
                                            <div class="dark-tin-border-bottom short"></div>
                                            <div>коп.</div>
                                        </div>
                                        <div class="second">
                                            <span>"</span>
                                            <div class="dark-tin-border-bottom short">
                                            </div>
                                            <span>"</span>
                                            <div class="dark-tin-border-bottom"></div>
                                            <div>201</div>
                                            <div class="dark-tin-border-bottom short"></div>
                                            <div>г.</div>
                                        </div>
                                    </div>
                                    <div class="blank-text-block">
                                        С условиями приема указанной в платежном документе суммы, в т. ч. с суммой взымаемой платы за услуги банка, ознакомлен и
                                        согласен.
                                    </div>
                                    <div class="blank-line signature-line">

                                        <span>Подпись платильщика</span>
                                        <div class="dark-tin-border-bottom"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="btn-block">
                                <button class="btn btn-print" type="button" onclick="window.print();">Распечатать</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {Events} from '../../account'

    export default {
        name: "invoice-payment",
        props: {
            user: {type: Object},
            contract: {type: String},
            price: {type: Number}
        },
        methods: {
            close() {
                $('body').removeClass('modal-open')
                Events.$emit('close-invoice-payment-popup')
            },
        }
    }
</script>
<style scoped>
    .receipt {
        display: flex;
    }
    .receipt .notice {
        display: flex;
        flex: 0 0 165px;
        flex-direction: column;
        justify-content: space-between;
        border-bottom: 2px solid black;
        border-right: 2px solid black;
        padding: 10px 0px;
        text-align: center;
        flex-wrap: wrap;
    }

    .receipt .blank {
        flex: 0 0 calc(100% - 165px);
        padding: 0 5px 20px;
        border-bottom: 2px solid black;
    }

    .blank-line {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        margin: 0 0 15px 0;
    }

    .blank-line.two-blocks-row {
        justify-content: space-between;
    }

    .info-form {
        text-align: right;
    }

    .two-blocks-row .first {
        flex: 0 0 40%;
        display: flex;
        flex-wrap: wrap;
    }

    .two-blocks-row .second {
        flex: 0 0 60%;
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .two-blocks-row .second .number-blank {
        justify-content: flex-end;
    }

    .two-blocks-row .second .blank-text {
        flex: 0 0 84%;
        text-align: center;
    }

    .four-blocks-row .second {
        flex-grow: 2;
    }

    .four-blocks-row .number-blank {
        justify-content: center;
    }

    .five-blocks-row .first {
        flex: 0 0 53%;
    }

    .five-blocks-row .second {
        flex: 0 0 45%;
        text-align: center;
    }

    .blank-line.five-blocks-row {
        align-items: flex-end;
        justify-content: space-between;
    }

    .blank-line.names-line {
        align-items: flex-end;
    }

    .blank-line.names-line .dark-border-bottom {
        flex-grow: 2;
    }

    .blank-line.sum-line {
        justify-content: space-between;
    }

    .blank-line.sum-line .first {
        display: flex;
        align-items: flex-end;
        flex: 0 0 45%;
    }

    .blank-line.sum-line .second {
        display: flex;
        align-items: flex-end;
        flex: 0 0 53%;
        justify-content: flex-end;
    }

    .blank-line.sum-line .dark-tin-border-bottom {
        flex: 0 0 130px;
    }

    .blank-line.sum-line .dark-tin-border-bottom.short {
        flex: 0 0 40px;
    }

    .blank-line.signature-line {
        justify-content: flex-end;
        align-items: flex-end;
    }

    .blank-line.signature-line .dark-tin-border-bottom {
        flex: 0 0 130px;
    }

    .receipt .blank .two-blocks-row .custom .first {
        flex: 0 0 60%;
    }

    .receipt .blank .two-blocks-row .custom .second {
        flex: 0 0 40%;
    }

    .receipt .blank .three-blocks-row .first {
        flex: 0 0 60%;
    }

    .three-blocks-row .third {
        flex-grow: 2;
        justify-content: center;
    }

    .receipt .half {
        flex: 0 0 50%;
    }

    .receipt .blank .name-of-recipient p:after {
        text-decoration: underline;
    }

    .receipt .title-recipient {
        flex: 0 0 100%;
        text-align: center;
    }

    .number-blank {
        display: flex;
        justify-content: flex-start;
        align-content: center;
    }

    .three-blocks-row .number-blank {
        justify-content: center;
    }

    .correct-number {
        border: 2px solid black;
        border-left: none;
        flex: 0 0 20px;
        text-align: center;
        height: 22px;
        line-height: 20px;
    }

    .correct-number:first-child {
        border: 2px solid black;
    }

    .name-block {
        border-bottom: 2px solid black;
    }

    .blank-text {
        flex: 0 0 100%;
    }

    .dark-border-bottom {
        border-bottom: 2px solid black;
    }

    .dark-tin-border-bottom {
        border-bottom: 1px solid black;
    }
    /*MODAL*/
    .modal-dialog.online-invoice-dialog {
        width: auto;
        margin: 15px auto 35px;
        padding: 0 15px;
        max-width: 1600px;
    }
    .modal.online-invoice-modal{
        display: block;
        overflow: auto;
    }
    .modal-dialog.online-invoice-dialog .city-choose{
        padding: 40px 35px 35px;
    }
    .modal-body.online-invoice-content .close{
        top: 10px;
        right: 5px;
    }
    @media print{

    }
</style>
