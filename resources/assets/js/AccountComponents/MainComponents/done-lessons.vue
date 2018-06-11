<template>
    <div class="block">
        <h3>Пройдено уроков</h3>
        <span><span class="number">{{doneLesson}}</span>из<span class="number">{{allLesson}}</span></span>
    </div>
</template>

<script type="text/babel">
    export default {
        data () {
            return {
                doneLesson: '',
                allLesson: ''
            }
        },
        created () {
            this.getData()
        },
        methods: {
            getData () {
                this.$http.get('/account/get-count-lessons').then(res => {
                    if (res.status === 202) {
                        this.doneLesson = res.data.done_lessons
                        this.allLesson = res.data.all_lessons
                    } else {
                        this.doneLesson = 0
                        this.allLesson = 0
                    }
                })
            }
        }
    }
</script>