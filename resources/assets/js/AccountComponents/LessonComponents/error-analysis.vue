<template>
    <div class="content error training" >
        <div class="breadcrumbs">
            <ul>
                <li><a href="/account">Главная</a></li>
                <li><a href="/account/lessons">Уроки</a></li>
                <li><a :href="'/account/lessons/' + lesson.id">Урок №{{lesson.lesson_num}}</a></li>
                <li>Разбор ошибок {{training ? '( тренировка )' : '(зачет)'}}</li>
            </ul>
        </div>
        <h4>Разбор ошибок по {{training ? 'тренировке' : 'зачету'}}:</h4>
        <span>Урок № {{lesson.lesson_num}}</span>
        <span class="ex-title">{{lesson.title}}</span>
        <div v-if="checkedQuestion">
            <div class="slick-wrapper">
                <div class="slick-training">
                    <!--active wrong correct-->
                    <div class="slide"
                         :class="[
                             {'correct': question.correct},
                             {'wrong': question.hasOwnProperty('correct') && !question.correct},
                             {'slick-current slick-slide active': question.id === checkedQuestion.id},
                             {'slick-slide slick-active': question.id !== checkedQuestion.id}
                         ]"
                         v-for="(question, i) in questions">
                        <a href="#" @click.prevent="setQuestion(i)">{{i+1}}</a>
                    </div>
                </div>
            </div>
            <div class="info-block">
                <span>Вопрос<span>{{questionStart + 1}}</span>из {{questions.length}}</span>
                <!--<timer-vue :time="time"></timer-vue>-->
            </div>
            <div class="img">
                <img v-if="checkedQuestion.image" :src="'http://'+checkedQuestion.image" alt="">
            </div>
            <h5>{{checkedQuestion.description}}</h5>
            <form class="variants">
                <div class="custom-wrap">
                    <p :class="[
                        {'correct': (checkedQuestion.correct && answer.id == checkedQuestion.user_answer_id) || (checkedQuestion.correct_answer ? answer.id === checkedQuestion.correct_answer.id : false)},
                        {'incorrect':  !checkedQuestion.correct && (answer.id == checkedQuestion.user_answer_id)}
                    ]"
                       v-for="answer in checkedQuestion.answers">{{answer.title}}</p>
                </div>
            </form>
            <div class="comment">
                <img src="/img/attention.png" alt="">
                <h5>Комментарий</h5>
                <p>{{checkedQuestion.comment}}</p>
                <p v-if="!checkedQuestion.correct">Правильный ответ - {{checkedQuestion.correct_answer.title}}</p>
            </div>
            <div class="btn-wrapper">
                <a href="#" class="btn-grey" @click.prevent="prevQuestion">Назад</a>
                <a href="#" class="btn-grey" @click.prevent="nextQuestion">Далее</a>
            </div>
        </div>
        <div v-else>
            Вы не отвечали на вопросы
        </div>
    </div>

</template>

<script type="text/babel">
    export default {
        data () {
            return {
                checkedQuestion: this.questions[0],
                questionStart: 0
            }
        },
        props: ['questions', 'lesson', 'training'],
        methods: {
            setQuestion (i) {
                this.questionStart = i
                this.checkedQuestion = this.questions[i]
            },
            nextQuestion () {
                if (this.questionStart + 1 > this.questions.length - 1) return false
                this.checkedQuestion = this.questions[++this.questionStart]
            },
            prevQuestion () {
                if (this.questionStart) {
                    this.checkedQuestion = this.questions[--this.questionStart]
                } else if(!this.questionStart) {
                    this.checkedQuestion = this.questions[0]
                }
            },
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