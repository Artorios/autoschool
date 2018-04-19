<template>
    <div class="numberpeople">
        <div class="info row no-gutters-xs">
            <div class="col-xs-6 col-md-4">
                <div class="block">
                    <h3>Количество учеников:</h3>
                    <span class="number">{{countStudents}}</span>
                </div>

            </div>
            <div class="col-xs-6  col-md-4">
                <div class="block">
                    <h3>Количество свободных купонов:</h3>
                    <span class="number">{{freeCoupons}}</span>
                </div>

            </div>
            <div class="col-xs-6 col-md-4">
                <div class="block">
                    <h3>Общий доход автошколы:</h3>
                    <span class="number">{{income}}</span>
                </div>

            </div>
        </div>
    </div>
</template>
<script type="text/babel">
    export default {
        data() {
            return {
                countStudents: 0,
                freeCoupons: 0,
                income: 0
            }
        },
        created (){
            this.getData()
        },
        methods: {
            getData(){
                this.$http.post('/autoschool/get-count-main-groups').then(res => {
                    this.countStudents = res.data.counts
                    this.freeCoupons = res.data.coupons
                    this.income = res.data.income
                })
            }
        }
    }
</script>