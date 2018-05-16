<template>
    <div class="numberpeople clearfix">
        <div class="info row no-gutters-xs ">
            <div class="col-xs-6 col-md-6 col-lg-3">
                <div class="block finance-block">
                    <h3>Количество учеников:</h3>
                    <span class="number" v-text="countStudents"></span>
                </div>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-3">
                <div class="block finance-block">
                    <h3>Оплаты по карте:</h3>
                    <span class="number" v-text="paymentCart"></span>
                </div>

            </div>
            <div class="col-xs-6 col-md-6 col-lg-3">
                <div class="block finance-block">
                    <h3>Оплаты купоном:</h3>
                    <span class="number" v-text="paymentCoupon"></span>
                </div>

            </div>
            <div class="col-xs-6 col-md-6 col-lg-3">
                <div class="block finance-block">
                    <h3>Сумма дохода:</h3>
                    <span class="number" v-text="income"></span>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                countStudents: 0,
                paymentCart: 0,
                paymentCoupon: 0,
                income: 0
            }
        },
        created (){
            this.getData()
        },
        methods: {
            getData(){
                this.$http.post('/autoschool/get-count-main-finance').then(res => {
                    this.countStudents = res.data.counts
                    this.paymentCart= res.data.card
                    this.paymentCoupon = res.data.coupons
                    this.income = res.data.income
                })
            }
        }
    }
</script>

<style scoped>

</style>