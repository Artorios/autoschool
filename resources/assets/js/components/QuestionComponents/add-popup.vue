<template>
    <div>
        <div class="modal-backdrop in "></div>
        <div class="modal fade in" id="modal-default" style="display: block; padding-top: 0px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="cancelChange">×</span></button>
                    <h4 class="modal-title">Добавить вопрос</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Вопрос</label>
                                <textarea class="form-control" v-model="data.description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Комментарий</label>
                                <textarea class="form-control" v-model="data.comment"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Номер билета</label>
                                <input type="number" class="form-control" v-model="data.ticket_num">
                            </div>
                            <div class="form-group">
                                <label>Номер вопроса</label>
                                <input type="number" class="form-control" v-model="data.question_num">
                            </div>
                            <div class="form-group">
                                <label>Изображение</label>
                                <input type="file" @change="loadImage">
                                <div class="image" v-if="data.image">
                                    <img :src="data.image.path" alt="" style="max-width: 100%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="body-box custom-height">
                                <div class="row" v-for="(answer, i) in data.answers">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Ответ <small @click="spliceAnswer(i)" style="cursor: pointer; color: blue; text-decoration: underline;">удалить</small></label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <input type="radio" name="correct" @change="setAnswer(answer)">
                                                </span>
                                                <input type="text" class="form-control" v-model="answer.title">
                                            </div>
                                            <!--<input type="text" class="form-control" v-model="answer.title">-->
                                            <!--<div class="form-group"><input type="radio" name="correct" v-model="answer.correct"></div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-box">
                                <button class="btn btn-default" @click="addAnswer">Добавить ответ</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal" @click="cancelChange">Отмена</button>
                    <button type="button" class="btn btn-primary" @click="create">Добавить вопрос</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    </div>
</template>

<style lang="scss">
    .custom-height{
        height: 250px;
        overflow-y: scroll;
        overflow-x: hidden;
        padding: 0 5px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
</style>

<script>
    import {Events} from "../../app"
    export default {
        data () {
            return {
                data: {
                    description: '',
                    comment: '',
                    ticket_num: '',
                    question_num: '',
                    answers: [
                        {
                            title: '',
                            correct: 0
                        }
                    ]
                },
                errorEdit: false
            }
        },
        components: {
        },
        watch: {
            'answer.correct': function (val) {
                console.log(val)
            }
        },
        mounted () {
            $('body').addClass('modal-open')
        },
        methods: {
            cancelChange () {
                Events.$emit('toggle-popup')
            },
            create () {
                this.$http.post('/admin/questions/create', this.data).then(res => {
                    if (res.status === 201) {
                        location.href = '/admin/questions'
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            },
            addAnswer () {
                this.data.answers.push({
                    title: '',
                    correct: 0
                })
            },
            spliceAnswer (i) {
                this.data.answers.splice(i, 1)
            },
            loadImage (e) {
                let data = new FormData()
                data.append('image', e.target.files[0])
                this.$http.post('/admin/questions/load-image', data).then(res => {
                    if (res.status === 201) {
                        this.data.image = {}
                        this.$set(this.data.image, 'path', res.data.image)
                        this.$set(this.data.image, 'name', res.data.name)
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            },
            setAnswer (answer) {
                this.data.answers.forEach(item => {
                    item.correct = 0
                })
                answer.correct = 1;
            }
        }
    }
</script>