<template>
    <div class="slick-wrapper">
        <!--<h4 v-if="!lessons">Уроки отсутствуют</h4>-->
        <div class="slick-lessons">
            <div class="slide" v-for="lesson in lessons" :class="{'disabled': lesson.locked}">
                <a :href="'/account/lessons/' + lesson.id" class="img-wrapper" v-if="!lesson.locked">
                    <img src="img/lesson-video.png" alt="">
                </a>
                <a href="#" class="img-wrapper" v-if="lesson.locked">
                    <img src="img/lesson-video.png" alt="">
                </a>
                <h4>{{lesson.title}}</h4>
                <div class="btn-wrapper" v-if="!lesson.locked">
                    <a href="#" class="btn-grey" data-toggle="modal" data-target="#errorModal" v-if="!lesson.training">Тренировка</a>
                    <a :href="'/account/lessons/training/' + lesson.id" class="btn-grey" v-if="lesson.training">Тренировка</a>
                    <a href="#" class="btn-grey" data-toggle="modal" data-target="#errorModalExam" v-if="!lesson.exam">Зачет</a>
                    <a :href="'/account/lessons/exam/' + lesson.id" class="btn-grey" v-if="lesson.exam">Зачет</a>
                    <a :href="'/account/lessons/group-exam/' + lesson.id" class="btn-grey" v-if="lesson.isGroup">Групповой зачет</a>
                </div>
            </div>
            <!--<div class="slide">-->
                <!--<a href="#" class="img-wrapper">-->
                    <!--<img src="img/lesson-video.png" alt="">-->
                <!--</a>-->
                <!--<h4>Приоритет маршрутных транспортных средств</h4>-->
                <!--<div class="btn-wrapper disabled">-->
                    <!--<a href="#" class="btn-grey">Тренировка</a>-->
                    <!--<a href="#" class="btn-grey">Зачет</a>-->
                <!--</div>-->
                <!--<a href="#" class="btn-grey">Групповой зачет</a>-->
            <!--</div>-->
            <!--<div class="slide disabled">-->
                <!--<a href="#" class="img-wrapper">-->
                    <!--<img src="img/lesson-video.png" alt="">-->
                <!--</a>-->
                <!--<h4>Предписывающие знаки</h4>-->
            <!--</div>-->
            <!--<div class="slide disabled">-->
                <!--<a href="#" class="img-wrapper">-->
                    <!--<img src="img/lesson-video.png" alt="">-->
                <!--</a>-->
                <!--<h4>Предписывающие знаки</h4>-->
            <!--</div>-->
            <!--<div class="slide">-->
                <!--<a href="#" class="img-wrapper">-->
                    <!--<img src="img/lesson-video.png" alt="">-->
                <!--</a>-->
                <!--<h4>Приоритет МТС</h4>-->
                <!--<div class="btn-wrapper">-->
                    <!--<a href="#" class="btn-grey">Тренировка</a>-->
                    <!--<a href="#" class="btn-grey">Зачет</a>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="slide">-->
                <!--<a href="#" class="img-wrapper">-->
                    <!--<img src="img/lesson-video.png" alt="">-->
                <!--</a>-->
                <!--<h4>Приоритет МТС</h4>-->
                <!--<div class="btn-wrapper">-->
                    <!--<a href="#" class="btn-grey">Тренировка</a>-->
                    <!--<a href="#" class="btn-grey">Зачет</a>-->
                <!--</div>-->
            <!--</div>-->
        </div>
    </div>
</template>

<script type="text/babel">
    export default {
        data () {
            return {
                lessons: null
            }
        },
        watch: {
            lessons: function (val) {
                if (val) {
                    setTimeout(() => {
                        this.setSlick()
                    }, 500)
                }
            }
        },
        created () {
            this.getData()
        },
        methods: {
            getData () {
                this.$http.get('/account/get-lessons').then(res => {
                    this.lessons = res.data.lessons
                })

            },
            setSlick () {
                $(".slick-lessons").slick({
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 1199,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                infinite: true,
                            }
                        },
                        {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                })
                console.log($(".slick-lessons"))
            }
        }
    }
</script>