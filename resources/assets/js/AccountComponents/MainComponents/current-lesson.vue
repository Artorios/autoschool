<template>
    <div class="start-video">
        <h3>Текущее задание</h3>

        <!--getFirst type-->
        <span v-if="type === 'getFirst'">У вас нет пройденных уроков</span>
        <a href="/account/lessons" class="btn-red" v-if="type === 'getFirst'">Перейти к урокам</a>
        <!--getFirst type END        -->

        <!--notViewed type-->
        <span v-if="type === 'notViewed'">Просмотрите видео по теме № {{lesson.lesson_num}}</span>
        <span v-if="type === 'notViewed'">{{lesson.title}}</span>
        <a :href="'/account/lessons/' + lesson.id" class="btn-red" v-if="type === 'notViewed'">Начать просмотр</a>
        <!--notViewed type END        -->

        <!--notTraining type-->
        <span v-if="type === 'notTraining'">Пройдите тестирование по теме № {{lesson.lesson_num}}</span>
        <span v-if="type === 'notTraining'">{{lesson.title}}</span>
        <a :href="'/account/lessons/training/' + lesson.id" class="btn-red" v-if="type === 'notTraining'">Перейти к тестированию</a>
        <!--notTraining type END        -->

        <!--notExam type-->
        <span v-if="type === 'notExam'">Пройдите зачет по теме № {{lesson.lesson_num}}</span>
        <span v-if="type === 'notExam'">{{lesson.title}}</span>
        <a :href="'/account/lessons/exam/' + lesson.id" class="btn-red" v-if="type === 'notExam'">Перейти к зачету</a>
        <!--notExam type END        -->

        <!--notExam type-->
        <span v-if="type === 'notGroup'">Пройдите групповой зачет по темам</span>
        <div v-if="type === 'notGroup'">
            <span v-for="lesson in lessons">{{lesson.title}}</span>
        </div>
        <a :href="'/account/lessons/group-exam/' + lesson.id" class="btn-red" v-if="type === 'notGroup'">Перейти к зачету</a>
        <!--notExam type END        -->

        <!--allDone type-->
        <span v-if="type === 'allDone'">Поздравляем! Вы закончили курс!</span>
        <!--allDone type END        -->
    </div>
</template>

<script type="text/babel">
    export default {
        data () {
            return {
                lesson: null,
                type: '',
                lessons: []
            }
        },
        created () {
            this.getData()
        },
        methods: {
            getData () {
                this.$http.get('/account/get-current-lesson').then(res => {
                    this.lesson = res.data.lesson
                    this.type = res.data.type
                        if(res.data.lesson.isGroup){
                        this.getGroupLessons()
                        }
                })

            },

            getGroupLessons (){
                this.$http.post('/account/get-group-lessons', this.lesson).then(res => {
                    this.lessons = res.data.lessons
                })
            }
        }
    }
</script>