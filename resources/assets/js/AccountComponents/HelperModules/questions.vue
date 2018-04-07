<template>
    <div>
        <list-questions :questions="questions" :checked-question="checkedQuestion" :type="type"></list-questions>
        <div class="info-block">
            <span>Вопрос<span>{{questionStart + 1}}</span>из {{questions.length}}</span>
            <timer-vue :time="time"></timer-vue>
        </div>
        <div class="img">
            <img class="imgTicket" v-if="checkedQuestion.image" :src="'http://'+checkedQuestion.image"  alt="">
        </div>
        <h5>{{checkedQuestion.description}}</h5>
        <form class="variants">
            <!--correct-->
            <div class="form-group" v-for="answer in checkedQuestion.answers" v-if="!checkedQuestion.has_answer">
                <input type="radio" name="variant" :value="answer.id" v-model="userAnswer" :id="'type' + answer.id">
                <label :for="'type' + answer.id">{{answer.title}}</label>
            </div>
            <div class="custom-wrap" v-if="checkedQuestion.has_answer && (type === 'training' || type === 'withComment')">
                <p :class="[
                        {'correct': answer.id == rightAnswerId},
                        {'incorrect':  !correct && (answer.id == userAnswer)}
                    ]"
                   v-for="answer in checkedQuestion.answers">{{answer.title}}</p>
            </div>
        </form>
        <div class="comment" v-if="setAnswer && (type === 'training' || type === 'withComment')">
            <img src="/img/attention.png" alt="">
            <h5>Комментарий</h5>
            <p>{{checkedQuestion.comment}}</p>
        </div>
        <div class="btn-wrapper">
            <a href="#" class="btn-grey" @click.prevent="prevQuestion">Назад</a>
            <a href="#" class="btn-grey" v-if="(type == 'training' || type == 'withComment') && setAnswer" @click.prevent="nextQuestion">Далее</a>
            <a href="#" class="btn-grey" v-if="!setAnswer && !checkedQuestion.has_answer" @click.prevent="setAnswerFunc">Ответить</a>
        </div>
    </div>
</template>

<script type="text/babel">
    import ListQuestions from './list-questions.vue'
    import TimerVue from './timer.vue'
    import {Events} from '../../account'
    export default {
        data () {
            return {
                checkedQuestion: this.questions[0],
                questionStart: 0,
                userAnswer: null,
                setAnswer: false,
                rightAnswerId: null,
                correct: null,
                allAnswers: [],
            }
        },
        props: ['questions', 'type', 'time'],
        components: {
            ListQuestions,
            TimerVue
        },
        watch: {
            allAnswers: function (val) {
                if (val.length === this.questions.length) {
                    Events.$emit('complete-questions');
                }
            }
        },
        created () {
            Array.prototype.diff = function(a) {
                return this.filter(function(i) {return a.indexOf(i) < 0;});
            }
//            events collection
            Events.$on('get-answer-data', (data) => {
                this.setAnswerData(data)
            })

            Events.$on('set-question', (i) => {
                this.setQuestion(i)
            })

            Events.$on('time-ended')
            Events.$on('set-checked-index', (i) => {
                this.questionStart = i;
            })
        },
        methods: {
            setQuestion(i) {
                this.setAnswer = false
                this.questionStart = i
                this.userAnswer = null
                this.checkedQuestion = this.questions[i]
            },
            prevQuestion () {
                this.setAnswer = false
                this.userAnswer = null
                if (this.questionStart) {
                    this.checkedQuestion = this.questions[--this.questionStart]
                } else if(!this.questionStart) {
                    this.checkedQuestion = this.questions[0]
                }
            },
            nextQuestion () {
                this.setAnswer = false
                this.userAnswer = null
                let checkQuest = this.questions[++this.questionStart]
                if (checkQuest) {
                    this.checkedQuestion = checkQuest
                } else if (this.allAnswers.length !== this.questions.length) {
                    let questionIds = []
                    this.questions.forEach((question, i) => {
                        questionIds.push(i)
                    })
                    let setNext = questionIds.diff(this.allAnswers)
                    this.checkedQuestion = this.questions[setNext[0]]
                } else {
                    Events.$emit('complete-questions');
                }
            },
            setAnswerFunc () {
                Events.$emit('set-answer', this.userAnswer, this.questionStart);
            },
            setAnswerData (data) {
                if (this.type === 'training' || this.type === 'withComment') {
                    this.rightAnswerId = data.rightAnswer
                    this.correct = data.correct
                    this.$set(this.checkedQuestion, 'correct', data.correct)
                }
                this.questions.forEach((question, i) => {
                    if (question.id === this.checkedQuestion.id) {
                        this.allAnswers.push(i)
                    }
                })
                this.$set(this.checkedQuestion, 'has_answer', 1)
                this.setAnswer = true;
                if (data.stop_test) {
                    Events.$emit('time-ended')
                }

                if (this.type !== 'training' && this.type !== 'withComment') {
                    this.nextQuestion()
                }
            }
        }
    }
</script>