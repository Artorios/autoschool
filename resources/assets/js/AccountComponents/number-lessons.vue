<template>
    <span class="number" v-if="countLessons">{{countLessons}}</span>
</template>

<script type="text/babel">
    export default {
        data () {
            return {
                countLessons: false
            }
        },
        created () {
            this.getCountLessons()
        },
        methods: {
            getCountLessons () {
                this.$http.get('/account/get-count-lesson').then(res => {
                    this.countLessons = res.data.count
                })
            }
        }
    }
</script>