<template>
    <div>
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
                        <span class="date" v-if="lesson.viewed_date">{{editDate(lesson.viewed_date)}}</span>
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
                            <span v-if="lesson.right_quest_group">{{lesson.right_quest_group}} из {{lesson.all_quest_group}}</span>
                            <span v-if="lesson.isGroup" class="refresh"></span>
                            <span v-if="lesson.isGroup">{{lesson.last_group_date}}</span>
                        </div>
                    </div>
                    <div class="toggle">
                        <span class="btn-grey" data-toggle="collapse" :data-target="'#theme' + i">Статистика попыток</span>
                    </div>
                </div>
                <div class="hidden-statistics collapse" :id="'theme' + i">
                    <span class="close" data-toggle="collapse" :data-target="'#theme'+i"></span>
                    <div class="try-wrapper">
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
            <ul class="pagination" v-if="itemsPerPage < resultCount">
                <li class="page-item" v-for="pageNumber in totalPages">
                    <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber" @click="setPage(pageNumber)">{{pageNumber}}</a>
                </li>
            </ul>
    </div>
</template>

<script type="text/babel">
    export default {
        data () {
            return {
                currentPage: 1,
                itemsPerPage: 10,
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