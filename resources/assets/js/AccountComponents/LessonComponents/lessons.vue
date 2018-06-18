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
            <div class="line" v-for="lesson in paginate">
                <span class="number">{{lesson.lesson_num}}</span>
                <div class="info">
                    <a v-if="!lesson.locked" :href="'/account/lessons/' + lesson.id">{{lesson.title}}</a>
                    <a href="#" style="pointer-events: none; color: #ddd; border-bottom: 0;" v-else>{{lesson.title}}</a>
                    <span>{{lesson.description}}</span>
                </div>
                <div class="btn-wrapper">
                    <a :href="'/account/lessons/training/' + lesson.id"
                       :disabled="!lesson.videos[0].user_videos ? true : lesson.videos[0].user_videos.viewed ? false : true"
                       class="btn-grey">Тренировка</a>
                    <a :href="'/account/lessons/exam/' + lesson.id"
                       :disabled="!lesson.videos[0].user_videos ? true : lesson.videos[0].user_videos.viewed ? false : true"
                       class="btn-grey">Зачет</a>
                    <a :href="'/account/lessons/group-exam/' + lesson.id" class="btn-grey" v-if="lesson.isGroup && !lesson.locked">Групповой зачет</a>
                </div>
            </div>
        </div>
        <ul class="pagination" v-if="itemsPerPage < resultCount">
            <li class="page-item" v-for="pageNumber in totalPages">
                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber" @click="setPage(pageNumber)">{{pageNumber}}</a>
            </li>
        </ul>
    </div>
</template>

<script type="text/babel">
    export default {
        data() {
            return {
                currentPage: 1,
                itemsPerPage: 10,
                resultCount: 0,
                type: ''
            }
        },
        props: ['lessons'],
        computed: {
            totalPages: function () {
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },
            paginate: function () {
                if (!this.lessons || this.lessons.length != this.lessons.length) {
                    return
                }
                this.resultCount = this.lessons.length
                if (this.currentPage >= this.totalPages) {
                    this.currentPage = this.totalPages
                }
                let index = this.currentPage * this.itemsPerPage - this.itemsPerPage
                return this.lessons.slice(index, index + this.itemsPerPage)
            }
        },
        methods: {
            setPage(pageNumber) {
                this.currentPage = pageNumber
            }
        }
    }
</script>