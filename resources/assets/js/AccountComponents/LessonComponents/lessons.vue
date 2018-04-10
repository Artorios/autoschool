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
            <div class="line" v-for="lesson in lessons">
                <span class="number">{{lesson.lesson_num}}</span>
                <div class="info">
                    <a v-if="!lesson.locked" :href="'/account/lessons/' + lesson.id">{{lesson.title}}</a>
                    <a href="#" style="pointer-events: none; color: #ddd; border-bottom: 0;" v-else>{{lesson.title}}</a>
                    <span>{{lesson.description}}</span>
                </div>
                <div class="btn-wrapper">
                    <a :href="'/account/lessons/training/' + lesson.id" class="btn-grey">Тренировка</a>
                    <a :href="'/account/lessons/exam/' + lesson.id" class="btn-grey">Зачет</a>
                </div>

            </div>
            <div class="group-test">
                <a href="" class="btn-grey">Груповой зачет</a>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
            </ul>
        </nav>
    </div>
</template>

<script type="text/babel">
    export default {
        data () {
            return {}
        },
        props: ['lessons'],
        created () {
            console.log('aaa')
        }
    }
</script>