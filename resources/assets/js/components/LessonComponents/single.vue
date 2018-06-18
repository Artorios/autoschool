<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{lesson.title}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="/admin/lessons">Уроки</a></li>
                <li class="active">{{lesson.title}}</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-6">
                    <h2 class="page-header custom-wrap-btn">
                        <input type="text"
                               :readonly="!showTitle ? 'readonly' : false"
                               class="form-control"
                               @dblclick="showTitle = !showTitle"
                               v-model="lesson.title">
                        <button class="btn"
                                v-if="showTitle"
                                @click="saveTitle(lesson.title)"><i class="fa fa-edit"></i></button>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-md-6">
                    <h2 class="title">Видео</h2>
                    <video-player v-if="!video.youtube && video.name"  class="vjs-custom-skin"
                                  ref="videoPlayer"
                                  :options="videoOptions"
                                  :class="{'custom-video': !lesson.videos[0].viewed}"
                                  :playsinline="false">
                    </video-player>
                    <video v-if="video.youtube"   class=" video-js vjs-default-skin vjs-custom-skin"
                             ref="videoPlayer"
                             :class="{'custom-video': !lesson.videos[0].viewed}"
                             :data-setup="videoOptionsYT"
                             :playsinline="false"
                    >
                    </video>
                </div>
                <div class="col-md-6">
                    <div v-if="video.name">
                        <p>
                            <small>Чтобы заменить видео удалите это видео и загрузите новое</small>
                        </p>
                        <button class="btn del-video" @click="deleteVideo(lesson.videos[0])">Удалить видео</button>
                    </div>
                    <div v-if="!video.name">
                        <p>
                            <small>Выберите новое видео и загрузите его</small>
                        </p>
                        <input type="file" class="btn" @change="loadFile" value="Загрузить видео">
                    </div>
                    <div >
                        <p>
                            <small>Вставить видео из YouTube</small>
                        </p>
                        <input type="text"
                               class="form-control"
                               v-model="youtube.video">
                        <button class="btn" @click="addYoutube(video.id)">Додати</button>
                    </div>
                    <div >
                    </div>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-md-12">
                    <h2 class="title">Описание</h2>
                    <small>Для редактирования данных сделайте двойной клик по любому полю</small>
                    <div class="form-group custom-wrap-btn">
                        <textarea class="form-control"
                                  v-model="lesson.description"
                                  @dblclick="showDescription = !showDescription"
                                  :readonly="!showDescription ? 'readonly' : false"></textarea>
                        <button class="btn" v-if="showDescription" @click="saveDescription(lesson.description)"><i class="fa fa-edit"></i></button>
                    </div>
                    <h3 class="title">Категория</h3>
                    <div class="form-group custom-wrap-btn">
                        <select class="form-control select2"
                                style="width: 100%;"
                                  v-model="lesson.license"
                                  @click="showLicense = !showLicense"
                                  :readonly="!showLicense ? 'readonly' : false">
                            <option value="A" >A</option>
                            <option value="B" >B</option>
                            <option value="C" >C</option>

                        </select>
                        <button class="btn" v-if="showLicense" @click="saveLicense(lesson.license)"><i class="fa fa-edit"></i></button>
                    </div>

                </div>
                <div class="col-md-12">
                    <h2 class="title">Настройки для вопросов</h2>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group custom-wrap-btn">
                                <label>Кол-во не правильных ответов (Тренировка)</label>
                                <input type="number"
                                       class="form-control"
                                       @dblclick="showTrainNum = !showTrainNum"
                                       :readonly="!showTrainNum ? 'readonly' : false"
                                       v-model="lesson.training_errors_num">
                                <button class="btn"
                                        v-if="showTrainNum"
                                        style="top: auto;bottom: 0;"
                                        @click="saveTrainNum(lesson.training_errors_num)"><i class="fa fa-edit"></i></button>
                            </div>
                            <div class="form-group custom-wrap-btn">
                                <label>Кол-во не правильных ответов (Зачет)</label>
                                <input type="number"
                                       class="form-control"
                                       @dblclick="showExamNum = !showExamNum"
                                       :readonly="!showExamNum ? 'readonly' : false"
                                       v-model="lesson.exam_errors_num">
                                <button class="btn"
                                        v-if="showExamNum"
                                        style="top: auto;bottom: 0;"
                                        @click="saveExamNum(lesson.exam_errors_num)"><i class="fa fa-edit"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 40px;">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#questions" aria-controls="questions" role="tab" data-toggle="tab">Вопросы к уроку</a></li>
                    <li role="presentation"><a href="#tests" aria-controls="tests" role="tab" data-toggle="tab">Тесты</a></li>
                    <li role="presentation"><a href="#exams" aria-controls="exams" role="tab" data-toggle="tab">Зачеты</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="questions">
                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <h2 class="title">Вопросы</h2>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control"
                                                    v-model="checkedTicket"
                                                    @change="setTicket()">
                                                <option value="all">Все вопросы</option>
                                                <option :value="ticket" v-for="ticket in tickets">Билет {{ticket}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control"
                                                   placeholder="Введите текст билета"
                                                   v-model="q"
                                                   @keyup="findTicket">
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Добавлен к уроку</th>
                                        <th>Вопрос</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="question in dataQuestions.data">
                                        <td>
                                            <input type="checkbox" :checked="question.checked" @change="addQuestion($event, question)">
                                        </td>
                                        <td>{{question.description}}</td>
                                        <td>Билет №{{question.ticket_num}}</td>
                                        <td>Вопрос №{{question.question_num}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <paginate
                                    :page-count="dataQuestions.last_page"
                                    :page-range="3"
                                    :margin-pages="2"
                                    :initial-page="page"
                                    :force-page = "page"
                                    :click-handler="clickCallback"
                                    :container-class="'pagination'"
                                    :next-text="'>>'"
                                    :prev-text="'<<'"
                                    :prev-class="'prev-items'"
                                    :next-class="'next-items'"
                                    ref="paginate"
                                    :page-class="'page-item'">
                            </paginate>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tests">...</div>
                    <div role="tabpanel" class="tab-pane" id="exams">...</div>
                </div>

            </div>
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
</template>

<script type="text/babel">
    import paginate from 'vuejs-paginate'
    require('videojs-youtube/dist/Youtube.min')
    export default {
        data () {
            return {
                videoOptions: {
                    muted: false,
                    autoplay: false,
                    language: 'ru',
                    playbackRates: [0.7, 1.0, 1.5, 2.0],
                    controls: true,
                    currentTime: 100,
                    sources: [{
                        type: this.lesson.videos[0] ? this.lesson.videos[0].mime_type : '',
                        src: this.lesson.videos[0] ? this.lesson.videos[0].path : ''
                    }],
                    poster: "/static/images/author.jpg",

                },
                youtube: this.lesson.videos[0].youtube ? {video: this.lesson.videos[0].youtube} : {video: ''},
                videoOptionsYT: '{ "techOrder": ["youtube","html5"], "controls": "true", "playbackRates": ["0.7", "1.0", "1.5", "2.0"],   "language": "ru", "sources": [{ "type": "video/youtube", "src": "'+this.lesson.videos[0].youtube+'"}] }',
                page: 0,
                dataQuestions: this.questions,
                showDescription: false,
                showLicense: false,
                showTitle: false,
                showTrainNum: false,
                showExamNum: false,
                video: this.lesson.videos[0],
                checkedTicket: 'all',
                q: ''

            }
        },
        components: {
            paginate
        },
        props: ['lesson', 'questions', 'tickets'],
        watch: {
            q: function (val) {
                if (!val) {
                    this.setTicket('')
                }
            }
        },
        methods: {
            addQuestion (e, question) {
                let data = {}
                if (e.target.checked) {
                    data.checked = 1
                } else {
                    data.checked = 0
                }
                data.question_id = question.id

                this.$http.post('/admin/lessons/' + this.lesson.id + '/change-question', data)
            },
            clickCallback (page) {
                this.page = --page
                this.setTicket('', ++page)
            },
            setFilter (clear, page) {
                let data = clear || !this.q ? {} : {q: this.q}
                if (page) {
                    data.page = page
                }
                data.ticket = checkedTicket
                this.$http.post('/admin/questions', data).then(res => {
                    if (res.status === 200) {
                        this.dataQuestions = res.data.questions
                        if (!page) {
                            this.page = 0
                        }
                    }
                }, err => {
                    this.errorSearch = true
                })
            },
            edit (data) {
                this.$http.put('/admin/lessons/' + this.lesson.id, data).then(res => {
                    if (res.status === 202) {
                        this.showDescription = false
                        this.showTrainNum = false
                        this.showExamNum = false
                        this.showTitle = false
                        this.showLicense = false

                    }
                })
            },
            saveTitle(text)
            {
                let data = {
                    title: text
                }

                this.edit(data)

            },
            saveDescription(text)
            {
                let data = {
                    description: text
                }

                this.edit(data)

            },
            saveLicense(text)
            {
                let data = {
                    license: text
                }
                this.edit(data)

            },
            saveExamNum (num) {
                let data = {
                    exam_errors_num: num
                }

                this.edit(data)
            },
            saveTrainNum (num) {
                let data = {
                    training_errors_num: num
                }

                this.edit(data)
            },
            deleteVideo (video) {
                this.$http.delete('/admin/lessons/delete-video/' + video.id, {}).then(res => {
                    if (res.status === 202) {
                        this.video = null
                        location.reload()

                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            },
            addYoutube(id){
                let data = {}
                data.youtube = this.youtube.video
                this.$http.post('/admin/lessons/youtube-video/' + id, data).then(res => {
                    if (res.status === 202) {
                        console.log(res.data)
                        location.reload()
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            },
            loadFile (e) {
                let file = e.target.files[0]

                let data = new FormData()
                data.append('video', file)
                data.append('lesson_id', this.lesson.id)
                data.append('video_id', this.video.id)

                this.$http.post('/admin/lessons/load-video', data).then(res => {
                    if (res.status === 201) {
                        if(res.data.name && res.data.type) {
                            alert('Видео загружено!')
                        }
                        location.reload()
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    console.log(err.data)
                    this.errorEdit = true
                })
            },
            setTicket (q = '', page = 0) {
                let data = {
                    ticket: this.checkedTicket
                }
                if (q) {
                    data.q = q
                } else {
                    if (this.q.length > 3) {
                        data.q = this.q
                    }
                }
                if (page) {
                    data.page = page
                }
                this.$http.post('/admin/lessons/' + this.lesson.id + '/get-questions', data).then(res => {
                    if (res.status === 200) {
                        this.dataQuestions = res.data.questions
                        if (!page) {
                            this.page = 0
                        }
                    }
                }, err => {
                    this.errorEdit = true
                })
            },
            findTicket () {
                if (this.q.length < 3) return false
                this.setTicket(this.q)
            }
        }
    }
    $(document).ready(function(){
        $('.vjs-big-play-button').css({"top":"45%", "left": "45%"});
    });

</script>

<style lang="scss" scoped>
    .custom-wrap-btn {
        position: relative;
        .btn {
            position: absolute;
            top: 0;
            right: 0px;
        }

    }
    .video-js{
        width: 100% !important;
        height: 360px!important;
    }
</style>