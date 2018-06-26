<template>
    <div class="slick-wrapper">
        <div class="slick-training">
            <!--active wrong correct-->
            <div class="slide"
                 :class="[
                             {'correct': question.correct},
                             {'wrong': question.hasOwnProperty('correct') && !question.correct},
                             {'slick-current slick-slide active': question.id === checkedQuestion.id},
                             {'slick-slide slick-active': question.id !== checkedQuestion.id},
                             {'slick-current slick-slide active': !question.hasOwnProperty('has_answer')}
                         ]"
                 v-for="(question, i) in questions">
                <a href="#" @click.prevent="!question.hasOwnProperty('has_answer') ? setQuestion(i) : false">{{i+1}}</a>
            </div>
        </div>
    </div>
</template>

<script>
    import {Events} from '../../account'
    export default {
        props: ['questions', 'checkedQuestion', 'type'],
        created () {
            Events.$on('add-questions', () => {
                this.reInit()
            })

        },
        watch: {
            checkedQuestion: function (val) {
                this.questions.forEach((quest, i) => {
                    if (quest.id == val.id) {
                        $('.slick-training').slick('slickGoTo', i)
                        Events.$emit('set-checked-index', i)
                    }
                })
            }
        },
        methods: {
            setQuestion (i) {
                Events.$emit('set-question', i)
            },
            setCorrect () {

            },
            reInit () {
//                $('.slick-training').remove()

                $('.slick-wrapper').css({overflow: 'hidden'})
                $('.slick-training').slick('unslick')
                setTimeout(() => {
                    $('.slick-training').slick({
                        infinite: false,
                        slidesToShow: 12,
                        speed: 100,
                        slidesToScroll: 3,
                        responsive: [
                            {
                                breakpoint: 1199,
                                settings: {
                                    slidesToShow: 9,
                                    slidesToScroll: 1,
                                    infinite: true,
                                }
                            },
                            {
                                breakpoint: 991,
                                settings: {
                                    slidesToShow: 7,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 767,
                                settings: {
                                    slidesToShow: 4,
                                    slidesToScroll: 1
                                }
                            }
                        ]
                    });
                    $('.slick-wrapper').css({overflow: ''})
                }, 1)
            }
        }
    }
</script>