<template>
    <div class="numberpeople">

        <div class="info row no-gutters-xs">
            <div class="col-xs-6 col-md-4">
                <div class="block">
                    <h3>Количество учеников:</h3>
                    <span class="number" v-text="countStudents"></span>
                </div>
            </div>

            <div class="col-xs-6  col-md-4">
                <div class="block">
                    <h3>Количество свободных купонов:</h3>
                    <span class="number" v-text="freeCoupons"></span>
                </div>
            </div>

            <div class="col-xs-6 col-md-4">
                <div class="block">
                    <h3>Общий доход филиала:</h3>
                    <span class="number" v-text="income"></span>
                </div>
            </div>
        </div>

    </div>
</template>

<script type="text/babel">
    export default {
        data: function () {
            return {
                countStudents: 0,
                freeCoupons: 0,
                income: 0,
            }
        },
        props:{
            filial: {}
        },
        created (){
            this.getData()
        },
        methods: {
            getData(){
                let data = {
                    'id': this.filial.id
                }
                this.$http.post('/autoschool/get-count-main-filial', data).then(res => {
                    this.countStudents = res.data.counts
                    this.freeCoupons = res.data.coupons
                    this.income = res.data.income
                })
            }
        },
    }
</script>

<style scoped>

</style>