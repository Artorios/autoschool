<template>
    <div class="payment variants">
        <p class="error" style="color: red" v-if="user.activated === 0">Подтвердите сылку на почте</p>
        <p class="error" style="color: red" v-if="errors_school">Выберите автошколу</p>
        <h5>Выберите способ оплаты</h5>
        <input type="radio" name="variant" id="typeA" value="typeA" v-model="variant">
        <label for="typeA">Банковской картой, платежных систем Master Card и VISA.</label>
        <input type="radio" name="variant" id="typeB" value="typeB" v-model="variant">
        <label for="typeB">Банковским переводом, на наши реквизиты (квитанция)</label>
        <input type="radio" name="variant" id="typeC" value="typeC" v-model="variant">
        <label class="correct" for="typeC">Оплатить купоном</label>
        <div v-if="variant=='typeC'" class="coupon">
            <p class="error" style="color: red" v-if="errors_coupon">Неверный номер купона</p>
            <span>Введите номер купона:</span>
            <input type="password" name="coupon" v-model="coupon">
        </div>
        <online-payment :user="user" :contract="contract" :price="price"
                        v-show="showOnlinePaymentPopup"></online-payment>
        <invoice-payment :user="user" :contract="contract" :price="price"
                         v-show="showInvoicePaymentPopup"></invoice-payment>
        <button class="btn-grey" @click="checkPaymentMethod" :disabled="!variant">Оплатить</button>
    </div>
</template>

<script>
    import {Events} from '../../account'
    import OnlinePayment from './online-payment'
    import InvoicePayment from './invoice-payment'

    export default {
        name: "payment-variants",
        components: {
            OnlinePayment,
            InvoicePayment
        },
        data() {
            return {
                variant: '',
                showOnlinePaymentPopup: false,
                showInvoicePaymentPopup: false,
                coupon: '',
                errors_coupon: false,
                errors_school: false,
            }
        },
        props: {
            user: {type: Object},
            contract: {type: String},
            price: {type: Number},
            school: {}
        },
        methods: {
            checkPaymentMethod() {
                if (this.variant === 'typeA') {
                    if (this.school) {
                        this.errors_school = false
                        this.showInvoicePaymentPopup = false
                        this.showOnlinePaymentPopup = true
                    }
                    else {
                        this.errors_school = true
                    }

                } else if (this.variant === 'typeB') {
                    this.showInvoicePaymentPopup = true
                    this.showOnlinePaymentPopup = false
                } else if (this.variant === 'typeC') {
                    this.showInvoicePaymentPopup = false
                    this.showOnlinePaymentPopup = false
                    this.paymentByCupon()
                } else {

                }
            },
            paymentByCupon() {
                this.$http.post('/cupon-payment', {'number_cupon': this.coupon}).then(res => {
                    if (res.status === 201) {
                        this.errors_coupon = false
                        location.href = '/account/'
                    }
                }, err => {
                    if (+err.status === 400) {
                        this.errors_coupon = true
                    }
                })
            },
        },
        created() {
            Events.$on('close-online-payment-popup', () => {
                this.showInvoicePaymentPopup = false
                this.showOnlinePaymentPopup = false
            })
            Events.$on('close-invoice-payment-popup', () => {
                this.showInvoicePaymentPopup = false
                this.showOnlinePaymentPopup = false
            })
        },
    }
</script>

<style scoped>
    button[disabled='disabled'] {
        cursor: not-allowed;
        background: linear-gradient(to top, #bababa, #ebeaea);
        opacity: 0.5;
    }
</style>