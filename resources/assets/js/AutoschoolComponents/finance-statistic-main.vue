<template>
    <!--<h2>{{countStudents}}</h2>-->
    <!--<h2>{{paymentCart}}</h2>-->
    <!--<h2>{{paymentCoupon}}</h2>-->
    <div>
        <h2>{{countStudents}}</h2>
        <h2>{{paymentCart}}</h2>
        <h2>{{paymentCoupon}}</h2>
        <h2>{{income}}</h2>
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