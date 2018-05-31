<template>
    <div class="content error training">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/account">Главная</a></li>
                <li><a href="/account/tickets">Билеты</a></li>
                <li><a :href="'/account/tickets/'+ticket.ticket_num">Пройти билет</a></li>
                <li>Разбор ошибок</li>
            </ul>
        </div>
        <h4>Разбор ошибок по билету №{{ticket.ticket_num}}:</h4>
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
                        <a href="#" @click.prevent="setQuestion(i)">{{i + 1}}</a>
                    </div>
                </div>
            </div>
            <div class="info-block">
                <span>Вопрос<span>{{questionStart + 1}}</span>из {{questions.length}}</span>
                <!--<timer-vue :time="time"></timer-vue>-->
            </div>
            <div class="img">
                <img v-if="checkedQuestion.image" :src="checkedQuestion.image" alt="">
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
                <i class="fa fa-info-circle icon-info-comment" aria-hidden="true"></i>
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
        props: ['questions', 'ticket'],
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
                } else if (!this.questionStart) {
                    this.checkedQuestion = this.questions[0]
                }
            },
        }
    }
</script>

<style lang="scss">
    .slide.correct a {
        color: green !important;
        border-color: green !important;
        opacity: 1 !important;
    }

    .slide.wrong a {
        color: red !important;
        border-color: red !important;
        opacity: 1 !important;
    }

    .custom-wrap {
        .correct, .incorrect, p {
            font-weight: 600;
            font-size: 17px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            &:before {
                position: absolute;
                left: 0;
                top: 50%;
                transform: translateY(-50%);
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
        p {
            position: relative;
            padding-left: 20px;
        }
    }
</style>