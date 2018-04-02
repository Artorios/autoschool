<template>
    <div class="content-wrapper">
        <delete-question :question="checkedQuestion" v-if="showDelPopup"></delete-question>
        <add-popup v-if="showEditPopup"></add-popup>
        <section class="content-header">
            <h1>
                Вопросы
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
                            <h3 class="box-title">Список билетов</h3>
                        </div>
                        <div class="input-group-btn">
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-success btn-lg" @click="showCreate"><i class="fa fa-plus" style="margin-right: 10px;"></i>Добавить вопрос</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Номер билета</th>
                                    <th>Кол-во вопросов</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="question in dataQuestions.data">
                                    <td>{{question.id}}</td>
                                    <td><a :href="'/admin/questions/ticket/' + question.ticket_num">Билет №{{question.ticket_num}}</a></td>
                                    <td>{{question.count_questions}}</td>
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
                showDelPopup: false
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
                data.group_ticket = 1
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