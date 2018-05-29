<template>
    <div class="block">
        <h3>Школьный экзамен</h3>
        <span>
            <i class="fa fa-clock-o" aria-hidden="true"></i>
            {{examDate}} ({{examDay}}) {{examTime}}
        </span>
        <span v-if="examLeftDay == '--'">
            осталось:
            <span class="number">{{examLeftDay}}</span>
            дней
        </span>
        <span v-if="examLeftDay == 0">
            осталось:
            <span class="number">{{examLeftDay}}</span>
            дней
        </span>
        <span v-if="examLeftDay == 1">
            осталось:<span class="number">
            {{examLeftDay}}</span>
            день
        </span>
        <span v-if="examLeftDay >= 2 && examLeftDay < 5">
            осталось:
            <span class="number">{{examLeftDay}}</span>
            дня
        </span>
        <span v-if="examLeftDay >= 5">
            осталось:
            <span class="number">{{examLeftDay}}</span>
            дней
        </span>
    </div>
</template>

<script type="text/babel">
    export default {
        data () {
            return {
                examDate: '--.--.----',
                examTime: '--:--',
                examDay: '-----',
                examLeftDay: '--',
            }
        },
        created () {
            this.getData()
        },
        methods: {
            getData () {
                this.$http.get('/account/get-count-school-exam').then(res => {
                        this.examDate = res.data.date
                        this.examTime = res.data.time
                        this.examDay = res.data.day
                        this.examLeftDay = res.data.leftDay
                })
            }
        }
    }
</script>