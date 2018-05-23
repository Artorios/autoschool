<template>
    <div class="content error lessons">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a></li>
                <li>Уроки</li>
            </ul>
        </div>
        <div class="lessons-wrapper">
            <div class="title">
                <span class="number">№</span>
                <span>Название</span>
            </div>
            <div class="line">
                <span class="number">{{lesson.lesson_num}}</span>
                <div class="info">
                    <a :href="'/account/lessons/demo/' + lesson.id">{{lesson.title}}</a>
                    <span>{{lesson.description}}</span>
                </div>
                <div class="btn-wrapper">
                    <a :href="'/account/lessons/demo/training/' + lesson.id" class="btn-grey">Тренировка</a>
                    <a :href="'/account/lessons/demo/exam/' + lesson.id" class="btn-grey">Зачет</a>
                    <a :href="'/account/lessons/group-exam/' + lesson.id" class="btn-grey" v-if="lesson.isGroup && !lesson.locked">Групповой зачет</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {
        data () {
            return {

            }
        },
        props: ['lesson'],
    }
</script>