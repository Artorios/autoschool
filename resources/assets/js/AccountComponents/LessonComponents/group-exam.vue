<template>
    <div class="content error training">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/account">Главная</a></li>
                <li><a href="/account/lessons">Уроки</a></li>
                <li><a :href="'/account/lessons/' + lesson.id">Урок №{{lesson.lesson_num}}</a></li>
                <li>Групповой зачет</li>
            </ul>
        </div>
        <h4>Групповой зачет по темам:</h4>
        <div v-for="lesson in lessons">
            <span>Урок № {{lesson.lesson_num}}</span>
            <span class="ex-title">{{lesson.title}}</span>
        </div>
        <questions-vue :questions="questions" :time="time" type="exam" v-if="!stopTrain"></questions-vue>
        <div v-if="stopTrain">
            <p>Правильных ответов {{rightAnswers}} из {{questions.length}}</p>
            <p v-if="trainDone">Вы сдали групповой зачет.</p>
            <p v-if="!trainDone">К сожалению, вы не сдали групповой зачёт. Допускается совершить не более одной ошибки. Попробуйте пересдать зачёт через час. Перед этим рекомендуем снова просмотреть соответствующие уроки и пройти тренировки.</p>
            <p v-if="!trainDone"><a :href="'/account/lessons/group-exam/' + lesson.id">Попробовать еще раз?</a></p>
            <a :href="'/account/lessons/analysis/' + userGroupExam.id">Перейти к разбору ошибок</a>
            <!--<a :href="'/account/lessons/' + nextLesson" v-if="nextLesson">Перейти к новому уроку</a>-->
        </div>

    </div>
</template>

<script type="text/babel">
    import QuestionsVue from '../HelperModules/questions.vue'
    import {Events} from '../../account'
    export default {
        data () {
            return {
                stopTrain: false,
                trainDone: false,
                nextLesson: null,
                rightAnswers: null
            }
        },
        props: ['questions', 'lessons', 'lesson', 'userGroupExam', 'time'],
        components: {
            QuestionsVue
        },
        created () {
            Events.$on('time-ended', () => {
                this.checkTrain()
            });
            Events.$on('set-answer', (userAnswer) => {
                this.setAnswerFunc(userAnswer)
            });
            Events.$on('complete-questions', () => {
                this.checkTrain()
            });
        },
        mounted () {
//            window.onbeforeunload = function(){
//                    return "Are you sure you want to close the window?";
//            }.bind(this)
        },
        methods: {
            checkTrain () {
//                check train here
                this.stopTrain = true
                let data = {}
                data.question_ids = []
                this.questions.forEach(question => {
                    data.question_ids.push(question.id)
                })
                this.$http.post('/account/lessons/training/' + this.userGroupExam.id + '/check-group-exam' , data).then(res => {
                    if (res.data.status === 'passed') {
                        this.trainDone = true
                        this.nextLesson = res.data.next_lesson
                        this.rightAnswers = res.data.right_count
                    } else {
                        this.trainDone = false
                        this.rightAnswers = res.data.right_count
                    }
                })
            },
            setAnswerFunc (answer) {
                this.$http.post('/account/lessons/training/' + this.userGroupExam.id + '/send-answer', {answer_id: answer}).then(res => {
                    if (res.status == 200) {
                        Events.$emit('get-answer-data', res.data);
                    }
                })
            }
        }
    }
</script>

<style>
    .slide.correct a {
        color: green!important;
        border-color: green!important;
        opacity: 1!important;
    }
    .slide.wrong a {
        color: red!important;
        border-color: red!important;
        opacity: 1!important;
    }
</style>