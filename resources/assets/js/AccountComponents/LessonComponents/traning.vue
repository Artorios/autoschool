<template>
    <div class="content error training">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/account">Главная</a></li>
                <li><a href="/account/lessons">Уроки</a></li>
                <li><a :href="'/account/lessons/' + lesson.id">Урок №{{lesson.lesson_num}}</a></li>
                <li>Тренировка</li>
            </ul>
        </div>
        <h4>Тренировка по теме:</h4>
        <span>Урок № {{lesson.lesson_num}}</span>
        <span class="ex-title">{{lesson.title}}</span>

        <questions-vue :questions="questions" :time="time" type="training" v-if="!stopTrain"></questions-vue>

        <div v-if="stopTrain">
            Правильных ответов {{correctAnswers}} из {{allQuestCount}}
            <!--Вы {{trainDone ? 'прошли' : 'не прошли'}}  тренировку.-->
            <p v-if="!trainDone"><a :href="'/account/lessons/training/' + lesson.id">Попробовать еще раз?</a></p>
            <p><a :href="'/account/lessons/exam/' + lesson.id">Перейти к зачету</a></p>
            <a :href="'/account/lessons/analysis/' + userTraining.id">Перейти к разбору ошибок</a>
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
                correctAnswers: null,
                allQuestCount: null
            }
        },
        props: ['questions', 'lesson', 'userTraining', 'time'],
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
            Events.$on('complete-questions', (questionIds) => {
                this.checkTrain()
            });
        },
        methods: {
            checkTrain () {
                this.stopTrain = true
                this.$http.post('/account/lessons/training/' + this.userTraining.id + '/check-training' , {}).then(res => {
                    if (res.data.status === 'passed') {
                        this.trainDone = true
                    }
                    this.correctAnswers = res.data.right_count
                    this.allQuestCount = res.data.all_count
                })
            },
            setAnswerFunc (answer) {
                this.$http.post('/account/lessons/training/' + this.userTraining.id + '/check', {answer_id: answer}).then(res => {
                    if (res.status == 200) {
                        Events.$emit('get-answer-data', {rightAnswer: res.data.answer_id, correct: res.data.correct});
                    }
                })
            }
        }
    }
</script>

<style lang="scss">
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
    .custom-wrap{
        .correct, .incorrect, p{
            font-weight: 600;
            font-size: 17px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            &:before{
                display: inline-block;
                width: 17px;
                height: 17px;
                content: '';
                margin-right: 10px;
            }
        }
        .correct {
            color: green;
            &:before {
                content: '\2DF';
                font-size: 22px;
                color: green;
                line-height: 1;
                border: 1px solid green;
                border-radius: 50%;
                text-align: center;
            }
        }
        .incorrect {
            color: red;
            &:before {
                content: '\2DF';
                font-size: 22px;
                color: red;
                line-height: 1;
                border: 1px solid red;
                border-radius: 50%;
                text-align: center;
            }
        }
    }
</style>