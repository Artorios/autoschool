<template>
    <div class="content-wrapper">
        <vue-toast ref="toast"></vue-toast>
        <section class="content-header">
            <h1>
                Вопрос
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Редактирование вопроса</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="question-text">Текст вопроса</label>
                                    <textarea id="question-text" class="form-control"
                                              v-model="questionData.description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="question-comment">Комментарий</label>
                                    <textarea id="question-comment" class="form-control"
                                              v-model="questionData.comment"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Изображение</label>
                                    <div style="margin-bottom: 15px;">
                                        <img :src="questionData.image" alt="" style="max-width: 400px">
                                    </div>
                                    <div class="button-box">
                                        <input type="file" id="load-file" style="display: none;" @change="loadImage">
                                        <label class="btn btn-success" v-if="questionData.image" for="load-file">Заменить
                                            изображение</label>
                                        <label class="btn btn-success" v-if="!questionData.image" for="load-file">Добавить
                                            изображение</label>
                                        <button class="btn btn-warning" v-if="questionData.image" @click.prevent="delImage">Удалить изображение</button>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <label>Изменить номер билета</label>
                                    <select v-model="questionData.ticket_num" class="form-control">
                                        <option :value="ticket.ticket_num" v-for="ticket in tickets">
                                            {{ticket.ticket_num}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" @click.prevent="saveQuestion">Сохранить</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Ответы к вопросу</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ответ</th>
                                    <th>Правильный ответ</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(answer, i) in answerList">
                                    <td>
                                        {{answer.id}}
                                    </td>
                                    <td>
                                        <textarea v-model="answer.title" class="form-control"></textarea>
                                    </td>
                                    <td>
                                        <input type="radio" name="answer-name" :value="+answer.correct" @change="setCorrect(answer)" :checked="answer.correct == 1">
                                    </td>
                                    <td><button class="btn btn-warning" @click="delAnswer(i)"><i class="fa fa-trash"></i></button></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <button class="btn btn-success" @click="addAnswer">Добавить ответ</button>
                                            <button class="btn btn-success" @click="saveAnswer">Сохранить</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
</template>

<script type="text/babel">
    export default {
        data() {
            return {
                answerList: this.answers,
                questionData: this.question,
                image: '',
                maxToasts: 6,
                position: 'top right',
                timeLife: 3000,
                closeBtn: false
            }
        },
        components: {
        },
        watch: {},
        props: ['question', 'answers', 'tickets'],
        created() {
        },
        methods: {
            setCorrect (answer) {
                this.answerList.forEach(a => {
                    a.correct = 0
                })
                answer.correct = 1
            },
            addAnswer () {
                this.answerList.push({id: '-', title: '', correct: 0})
            },
            saveQuestion () {
                let data = {
                    description: this.questionData.description,
                    comment: this.questionData.comment,
                    ticket_num: this.questionData.ticket_num,
                    image: this.image ? this.image : this.questionData.image ? this.questionData.image : null
                }
                this.$http.patch('/admin/questions/question/' + this.question.id, data).then(res => {
                    if (res.status === 202) {
                        this.showToast('Сохранено', 'done_all')
                    }
                }, err => {
                    this.showToast('Произошла ошибка', 'error')
                })

            },
            delImage () {
                this.questionData.image = null
                this.image = ''
            },
            loadImage (e) {
                let data = new FormData()
                data.append('image', e.target.files[0])
                this.$http.post('/admin/questions/load-image', data).then(res => {
                    if (res.status === 201) {
                        this.$set(this.questionData, 'image', res.data.image)
                        this.image = res.data.name
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            },
            saveAnswer () {
                this.$http.patch('/admin/questions/answer/' + this.question.id, JSON.stringify({'answers': this.answerList})).then(res => {
                    if (res.status === 202) {
                        this.showToast('Сохранено', 'done_all')
                    }
                }, err => {
                    this.showToast('Произошла ошибка', 'error')
                })
            },
            delAnswer (i) {
                this.answerList.splice(i, 1)
            },
            showToast(text, type) {
                this.$toasted.show(text, {
                    theme: "primary",
                    position: "top-right",
                    duration : 5000,
                    icon: type
                })
            }
        }
    }
</script>