<template>
    <div class="content error training">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/account">Главная</a></li>
                <li><a href="/account/lessons">Экзамены</a></li>
                <li>Тестовый</li>
            </ul>
        </div>
        <h4>Тестовый экзамен:</h4>
        <questions-vue :questions="questions" :time="time" type="exam" v-if="!stopTrain"></questions-vue>
        <div v-if="stopTrain">
            Правильных ответов {{rightAnswers}} из {{questions.length}}
            Вы {{trainDone ? 'сдали' : 'не сдали'}}  зачет.
            <p><a :href="'/account/exams/test'">Попробовать еще раз?</a></p>
            <a :href="'/account/exams/analysis/'" v-if="!trainDone">Перейти к разбору ошибок</a>
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
                rightAnswers: null,
                nextGroupExam: false
            }
        },
        props: ['questions', 'userExam', 'time'],
        components: {
            QuestionsVue
        },
        created () {
            Events.$on('time-ended', () => {
                this.checkTrain()
            })
            Events.$on('set-answer', (userAnswer) => {
                this.setAnswerFunc(userAnswer)
            });
            Events.$on('complete-questions', () => {
                this.checkTrain()
            });
        },
        watch: {
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
                data.lesson_ids = []
                this.questions.forEach(question => {
                    data.lesson_ids.push(question.id)
                })
//                this.$http.post('/account/lessons/training/' + this.userExam.id + '/check-exam' , data).then(res => {
                this.$http.post('/account/exams/test/' + this.userExam.id + '/check-exam' , data).then(res => {
                    if (res.data.status === 'passed') {
                        this.trainDone = true
                        this.rightAnswers = res.data.right_count
                    } else {
                        this.trainDone = false
                        this.rightAnswers = res.data.right_count
                    }
                })
            },
            setAnswerFunc (answer) {
//                this.$http.post('/account/lessons/training/' + this.userExam.id + '/send-answer', {answer_id: answer}).then(res => {
                this.$http.post('/account/exams/test/' + this.userExam.id + '/send-answer', {answer_id: answer}).then(res => {
                    if (res.status == 200) {
                        Events.$emit('get-answer-data', {});
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