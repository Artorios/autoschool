<template>
    <div class="content error statistics">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a></li>
                <li>Статистика (Успеваемость)</li>
            </ul>
        </div>

        <div class="table-wrapper">
            <div class="title-line">
                <span class="number">№</span>
                <span class="name">Название</span>
                <span class="lesson">Урок</span>
                <span class="train">Тренировка</span>
                <span class="exam">Зачет</span>
                <span class="group-exam">Групповой зачет</span>
            </div>
            <div v-for="(lesson, i) in  paginate">
                <div class="line">
                    <div class="number">
                        <span>{{lesson.lesson_num}}</span>
                    </div>
                    <div class="name">
                        <a :href="'/account/lessons/' + lesson.id">{{lesson.title}}</a>
                    </div>
                    <div class="lesson">
                        <span class="mobile-title">Урок</span>
                        <span :class="{'ready': lesson.viewed}">{{lesson.viewed ? 'Пройден' : 'Не пройден'}}</span>
                        <span class="date">{{editDate(lesson.updated_at)}}</span>
                    </div>
                    <div class="train">
                        <div v-if="lesson.right_quest_train">
                            <span class="mobile-title">Тренировка</span>
                            <span>{{lesson.right_quest_train}} из {{lesson.all_quest_train}}</span>
                            <a :href="'/account/lessons/training/' + lesson.id"><span class="refresh"></span></a>
                            <span>{{editDate(lesson.last_training_date)}}</span>
                        </div>
                    </div>
                    <div class="exam">
                        <div v-if="lesson.right_quest_exam">
                            <span class="mobile-title">Зачет</span>
                            <span>{{lesson.right_quest_exam}} из {{lesson.all_quest_exam}}</span>
                            <a :href="'/account/lessons/exam/' + lesson.id"><span class="refresh"></span></a>
                            <span>{{editDate(lesson.last_exam_date)}}</span>
                        </div>
                    </div>
                    <div class="group-exam">
                        <div v-if="lesson.isGroup">
                            <span class="mobile-title">Груп. зачет</span>
                            <span v-if="!lesson.right_quest_group">-</span>
                            <!--<span v-if="lesson.isGroup" class="refresh"></span>-->
                            <!--<span v-if="lesson.isGroup">28.11.2017</span>-->
                        </div>
                    </div>
                    <div class="toggle">
                        <span class="btn-grey" data-toggle="collapse" :data-target="'#theme' + i">Статистика попыток</span>
                    </div>
                </div>
                <div class="hidden-statistics collapse" :id="'theme' + i">
                    <span class="close" data-toggle="collapse" :data-target="'#theme'+i"></span>
                    <div class="try-wrapper">
                        <!--<div class="try">
                            <div class="number">
                                <span>Попытка 1</span>
                            </div>
                            <div class="train-wrapper">
                                <div class="train">
                                    <span>Ошибок <span>5</span></span>
                                    <span>27.11.2017</span>
                                    <a href="#">Разбор ошибок</a>
                                </div>
                                <div class="train">
                                    <span>Ошибок <span>5</span></span>
                                    <span>27.11.2017</span>
                                    <a href="#">Разбор ошибок</a>
                                </div>
                                <div class="train">
                                    <span>Ошибок <span>5</span></span>
                                    <span>27.11.2017</span>
                                    <a href="#">Разбор ошибок</a>
                                </div>
                            </div>
                            <div class="exam-wrapper">
                                <div class="exam">
                                    <span>Ошибок <span>18</span></span>
                                    <span>28.11.2017</span>
                                    <a href="#">Разбор ошибок</a>
                                </div>
                            </div>
                        </div>
                        <div class="try">
                            <div class="number">
                                <span>Попытка 2</span>
                            </div>
                            <div class="train-wrapper">
                                <div class="train">
                                    <span>Ошибок <span class="without">0</span></span>
                                    <span>27.11.2017</span>
                                    <a href="#">Разбор ошибок</a>
                                </div>
                            </div>
                            <div class="exam-wrapper">
                                <div class="exam">
                                    <span>Ошибок <span>15</span></span>
                                    <span>28.11.2017</span>
                                    <a href="#">Разбор ошибок</a>
                                </div>
                            </div>
                        </div>-->
                        <div class="try"  v-for="(train,key) in alldata[lesson.lesson_num].idLessonTrain">
                            <div class="number">
                                <span>Попытка {{key+1}}</span>
                            </div>
                            <div class="train-wrapper" >
                                <div class="train" >
                                    <div class="train" v-if="train.type === 'training'">
                                        <span>Ошибок <span>{{alldata[lesson.lesson_num].questions_uncorrect[train.id]}}</span></span>
                                        <span v-if="train.updated_at == null">неизвестно</span>
                                        <span v-else>{{editDate(train.updated_at) }}</span>
                                        <a :href="'/account/lessons/analysis/'+train.id">Разбор ошибок</a>
                                    </div>

                                </div>
                            </div>
                            <div class="exam-wrapper" >
                                <div class="exam">
                                    <div class="exam" v-if="train.type === 'exam'">
                                        <span>Ошибок <span>{{alldata[lesson.lesson_num].questions_uncorrect[train.id]}}</span></span>
                                        <span v-if="train.updated_at == null">неизвестно</span>
                                        <span v-else>{{editDate(train.updated_at) }}</span>
                                        <a :href="'/account/lessons/analysis/'+train.id">Разбор ошибок</a>
                                    </div>
                                </div>
                            </div>
                            <div class="exam-wrapper" >
                                <div class="exam">
                                    <div class="exam" v-if="train.type === 'group'">
                                        <span>Ошибок <span>{{alldata[lesson.lesson_num].questions_uncorrect[train.id]}}</span></span>
                                        <span v-if="train.updated_at == null">неизвестно</span>
                                        <span v-else>{{editDate(train.updated_at) }}</span>
                                        <a :href="'/account/lessons/analysis/'+train.id">Разбор ошибок</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<nav aria-label="Page navigation example">-->
            <ul class="pagination" v-if="itemsPerPage < resultCount">
                <li class="page-item" v-for="pageNumber in totalPages">
                    <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber" @click="setPage(pageNumber)">{{pageNumber}}</a>

                </li>
            </ul>
        <!--</nav>-->
    </div>
</template>

<script type="text/babel">
    export default {
        data () {
            return {
                currentPage: 1,
                itemsPerPage: 3,
                resultCount: 0,
                number: '1',
            }
        },
        props: ['statistics','alldata'],
        computed: {
            totalPages: function(){
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },
            paginate: function(){
                if (!this.statistics || this.statistics.length != this.statistics.length){
                    return
                }
                this.resultCount = this.statistics.length
                if(this.currentPage >= this.totalPages){
                    this.currentPage = this.totalPages
                }
                let index = this.currentPage * this.itemsPerPage - this.itemsPerPage
                return this.statistics.slice(index, index + this.itemsPerPage)
            }
        },
        methods: {
            editDate(date){
                console.log(date)
                var dateT = date.split(' ')['0']
                var dateTemp = dateT.split('-')
                date = dateTemp['2'] + '.' + dateTemp['1'] + '.' + dateTemp['0']
                return date
            },
            editTime(time){
                var timeTemp = time.split(':')
                time = timeTemp['0'] + ':' + timeTemp['1']
                return time
            },
            setPage(pageNumber){
                this.currentPage = pageNumber
            }
        }
    }
</script>