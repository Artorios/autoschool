<template>
    <div class="content-wrapper">
        <delete-question :question="checkedQuestion" v-if="showDelPopup"></delete-question>
        <section class="content-header">
            <h1>
                Вопросы вопросы к билету №{{ticketNum}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Список вопросов</h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right" v-model="q" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Вопрос</th>
                                    <th>Комментарий</th>
                                    <th>Номер вопроса</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="question in dataQuestions.data">
                                    <td>{{question.id}}</td>
                                    <td><a :href="'/admin/questions/question/' + question.id">{{question.description}}</a></td>
                                    <td>{{question.comment}}</td>
                                    <td>{{question.question_num}}</td>
                                    <td>
                                        <button class="btn btn-warning" title="Удалить" @click="delQuestion(question)"><i class="fa fa-trash"></i></button>
                                    </td>
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
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    </div>
</template>

<script type="text/babel">
    import AddPopup from './add-popup.vue'
    import DeleteQuestion from './delete-question.vue'
    import {Events} from '../../app'
    import paginate from 'vuejs-paginate'
    export default {
        data () {
            return {
                checkedQuestion: null,
                showEditPopup: false,
                page: 0,
                q: '',
                errorSearch: false,
                dataQuestions: this.questions,
                showDelPopup: false,
                ticketNum: this.questions.data[0].ticket_num
            }
        },
        components: {
            DeleteQuestion,
            paginate,
            AddPopup
        },
        watch: {
            q: function (val) {
                if (val && val.length > 2) {
                    this.setFilter()
                } else if(!val) {
                    this.setFilter(1, 0)
                }
            },
        },
        props: ['questions'],
        created () {
            Events.$on('toggle-popup', () => {
                this.closePopup()
            })
        },
        methods: {
            closePopup () {
                $('body').removeClass('modal-open')
                this.showEditPopup = false
                this.showDelPopup = false
                this.checkedQuestion = null
            },
            showEdit (question) {
                this.showEditPopup = true
                this.checkedQuestion = question
            },
            showCreate () {
                this.showEditPopup = true
                this.checkedQuestion = null
            },
            clickCallback (page) {
                this.page = --page
                this.setFilter(0, ++page)
            },
            setFilter (clear, page) {
                let data = clear || !this.q ? {} : {q: this.q}
                if (page) {
                    data.page = page
                }
                data.ticket_num = this.ticketNum
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
            delQuestion (question) {
                this.checkedQuestion = question
                this.showDelPopup = true
            }
        }
    }
</script>