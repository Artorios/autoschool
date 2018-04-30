<template>
    <div class="modal fade in" id="modal-default" style="display: block; padding-top: 50px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="cancelChange">×</span></button>
                    <h4 class="modal-title">Добавить урок</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Навание*</label>
                                <input type="text" class="form-control" v-model="data.title">
                            </div>
                            <div class="form-group">
                                <label>Описание*</label>
                                <textarea class="form-control" v-model="data.description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Номер урока*</label>
                                <input type="text" class="form-control" v-model="data.lesson_num">
                            </div>
                            <!--<div class="form-group">
                                <label>Загрузить видео к уроку*</label>
                                <input type="file" @change="loadFile" class="form-control">
                            </div>-->
                            <div class="form-group">
                                <label>Видео YouTube</label>
                                <input type="text" class="form-control" v-model="data.youtube">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal" @click="cancelChange">Отмена</button>
                    <button type="button" class="btn btn-primary" v-if="edit" @click="createLesson">Сохранить изменения</button>
                    <button type="button" class="btn btn-primary" @click="createLesson" v-else>Добавить урок</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script type="text/babel">
    import {Events} from "../../app";
    export default {
        data () {
            return {
                data: this.edit ? Object.assign({}, this.lesson) : {
                    title: '',
                    description: '',
                    lesson_num: '',
                    youtube: '',
                    videos: []
                },
                errorEdit: false
            }
        },
        props: ['lesson', 'edit'],
        methods: {
            cancelChange () {
                Events.$emit('toggle-popup')
            },
            editLesson () {
                this.$http.put('/admin/user/edit-user/' + this.user.id, this.data).then(res => {
                    if (res.status === 202) {
                        location.href = '/admin/users'
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            },
            createLesson () {
                this.$http.post('/admin/lessons/create', this.data).then(res => {
                    if (res.status === 201) {
                        location.href = '/admin/lessons'

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

                this.$http.post('/admin/lessons/load-video', data).then(res => {
                    if (res.status === 201) {
                        this.data.videos.push(res.data)
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            }
        }
    }
</script>