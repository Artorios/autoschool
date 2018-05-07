<template>
    <div class="content error training">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/account">Главная</a></li>
                <li><a href="/account/tickets">Билеты</a></li>
            </ul>
        </div>
        <h4>Тренировка по теме:</h4>
        <span>Билет № {{ticketNum}}</span>
        <questions-vue :questions="questions" :time="time" :type="+withComment === 1 ? 'withComment' : 'exam'" v-if="!stopTrain"></questions-vue>
        <div v-if="stopTrain">
            <span v-if="rightAnswers">Правильных ответов {{rightAnswers}} из {{questions.length}}</span>
            Вы {{trainDone ? 'сдали' : 'не сдали'}}  билет.
            <a href="/account/tickets">Перейти к билетам</a>
            <a :href="'/account/tickets/analysis/' + userTicket">Перейти к разбору ошибок</a>
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
                userAnswer: null,
                trainDone: false,
                ticketNum: this.questions[0].ticket_num,
                rightAnswers: null
            }
        },
        props: ['questions', 'userTicket', 'time', 'withComment'],
        components: {
            QuestionsVue
        },
        created () {
            Events.$on('time-ended', () => {
                this.checkTrain()
            })
            Events.$on('set-answer', (userAnswer, questionStart) => {
                this.setAnswerFunc(userAnswer, questionStart)
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
                let data = {}
                data.questions = []
                this.questions.forEach(quest => {
                    data.questions.push(quest.id)
                })
                this.stopTrain = true
                this.$http.post('/account/tickets/' + this.userTicket + '/check-ticket' , data).then(res => {
                    if (res.data.status === 'passed') {
                        this.trainDone = true
                        this.rightAnswers = res.data.right_count
                    }
                })
            },
            setAnswerFunc (answer, position) {
                this.$http.post('/account/tickets/' + this.userTicket + '/check', {answer_id: answer, quest_pos: position}).then(res => {
                    if (res.status == 200) {
                        let data = {}
                        if (res.data.questions) {
                            res.data.questions.forEach(quest => {
                                this.questions.push(quest)
                            })
                            Events.$emit('add-questions')
                        }
                        if (res.data.hasOwnProperty('correct')) {
                            data.correct = res.data.correct
                            data.rightAnswer = res.data.answer_id
                        }

                        if (res.data.stop_test) {
                            data.stop_test = 1
                        }
                        Events.$emit('get-answer-data', data);
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
                background: url("../../../img/correct.svg") center;
                -webkit-background-size: 100%;
                background-size: 100%;
            }
        }
        .incorrect {
            color: red;
            &:before {
                background: url("../../../img/incorrect.svg") center;
                -webkit-background-size: 100%;
                background-size: 100%;
            }
        }
    }
</style>