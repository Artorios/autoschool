<template>
    <div>
        <div class="modal-backdrop in "></div>
        <div class="modal online-payment-modal in" id="onlinePaymentModal" @click.self="close" aria-hidden="true">
            <div class="modal-dialog online-payment-dialog">
                <div class="modal-content">
                    <div class="modal-body online-payment-content city-choose">
                        <span class="close" data-dismiss="modal" aria-label="Close" @click="close"></span>

                        <div class="modal-online-top">
                            <h3>Введите реквизиты карты</h3>
                        </div>
                        <div class="modal-online-block">
                            <form  v-on:submit.prevent="paymentSend">
                                <div class="input-block">
                                    <div class="form-group">
                                        <div class="label-text">Номер карты:</div>
                                        <input type="text" name="numberCard" class=""
                                               v-model="cardInfo.numberCard"
                                               v-bind:class="{'input-error': errors.numberCard}">
                                    </div>
                                    <div class="form-group form-group-two-short">
                                        <div class="label-text">Срок действия:</div>
                                        <input type="text" name="validity_month" value="" placeholder="месяц"
                                               v-model="cardInfo.validityMonth"
                                               v-bind:class="{'input-error': errors.validityMonth}">
                                        <input type="text" name="validity_year" value="" placeholder="год"
                                               v-model="cardInfo.validityYear"
                                               v-bind:class="{'input-error': errors.validityYear}">
                                    </div>
                                    <div class="form-group">
                                        <div class="label-text">CVV2-code:</div>
                                        <input type="text" name="cvv2Code" class=""
                                               v-model="cardInfo.cvv2Code"
                                               v-bind:class="{'input-error': errors.cvv2Code}">
                                    </div>
                                </div>
                                <div class="result-wrap">
                                    <div class="result-block">
                                        <div class="result-text">
                                            <span>Контракт:</span>
                                            <span>{{contract}}</span>
                                        </div>
                                        <div class="result-text">
                                            <span>Сумма:</span>
                                            <span>{{price}}</span>
                                            <span>руб.</span>
                                        </div>
                                    </div>
                                    <button class="btn" type="submit">Оплатить</button>
                                </div>
                            </form>
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
        name: "online-payment",
        data () {
            return {
                cardInfo:{
                    numberCard: '',
                    validityMonth: '',
                    validityYear: '',
                    cvv2Code: '',
                    amount: 0
                },
                errors: {
                    numberCard: false,
                    validityMonth: false,
                    validityYear: false,
                    cvv2Code: false,
                },
                serverError: '',
            }
        },
        props: {
            user: {type: Object},
            contract: {type: String},
            price: {type: Number}
        },
        methods: {
            close(){
                $('body').removeClass('modal-open')
                Events.$emit('close-online-payment-popup')
            },
            paymentSend () {
                if (this.validate()) return false
                this.cardInfo.amount = this.price
                this.$http.post('/account/finance/card-payment', this.cardInfo).then(res => {
                    if (res.status === 201) {
                        console.log(res)
                        this.close()
                    }
                }, err => {
                    if (+err.status === 400) {
                        this.serverError = true
                    }
                })
            },
            validate () {
                for (let key in this.cardInfo) {
                    switch (key) {
                        case 'numberCard':
                            if (!this.cardInfo[key] || this.cardInfo[key].length < 16) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'validityMonth':
                            if (!this.cardInfo[key] || this.cardInfo[key].length < 2) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'validityYear':
                            if (!this.cardInfo[key] || this.cardInfo[key].length < 2) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'cvv2Code':
                            if (!this.cardInfo[key] || this.cardInfo[key].length < 2) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                    }
                }
                let hasError = false
                for (let key in this.errors) {
                    if (this.errors[key]) {
                        hasError = true
                    }
                }
                return hasError
            },
        }
    }
</script>

<style scoped>
    .modal-dialog.online-payment-dialog {
        width: auto;
        margin: 0;
    }

    .modal.online-payment-modal {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .modal-body.online-payment-content{
        padding: 0;
    }
    .modal-online-top{
        text-align: center;
        background-color: #ccc;
        padding: 35px 15px 25px;
    }
    .modal-body.online-payment-content .close{
        top: 15px;
        right: 10px;
    }
    .modal-online-block{
        padding: 25px 20px;
    }
    .result-wrap{
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }
    .form-group input {
        width: 100%;
    }
    .form-group.form-group-two-short input{
        width: 100px;
    }
</style>