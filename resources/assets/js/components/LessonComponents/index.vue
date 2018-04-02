<template>
    <div class="content-wrapper">
        <del-popup :lesson="checkedLesson" v-if="showDelPopup"></del-popup>
        <edit-popup :user="checkedLesson" :edit="checkedLesson ? true : false" v-if="showEditPopup"></edit-popup>
        <section class="content-header">
            <h1>
                Уроки
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
                            <h3 class="box-title">Раздел управления видеоуроками и вопросы к ним</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-success btn-lg" @click="showCreate"><i class="fa fa-plus" style="margin-right: 10px;"></i>Добавить урок</button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Номер урока</th>
                                    <th>Название</th>
                                    <th>Описание</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="lesson in lessons.data">
                                    <td>{{lesson.id}}</td>
                                    <td>{{lesson.lesson_num}}</td>
                                    <td><a :href="'/admin/lessons/' + lesson.id">{{lesson.title}}</a></td>
                                    <td>{{lesson.description}}</td>
                                    <td>
                                        <!--<button class="btn btn-success"-->
                                                <!--title="Редактировать"-->
                                                <!--@click="showEdit(lesson)"><i class="fa fa-edit"></i></button>-->
                                        <button class="btn btn-warning" title="Удалить" @click="deleteLesson(lesson)"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                        <!--<div class="input-group-btn">-->
                            <!--<button type="submit" class="btn btn-default" @click="showCreate">Добавить урок</button>-->
                        <!--</div>-->
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import {Events} from '../../app'
    import DelPopup from './delete-lesson.vue'
    import EditPopup from './add-popup.vue'
    export default {
        data () {
            return {
                checkedLesson: null,
                showEditPopup: false,
                showDelPopup: false
            }
        },
        props: ['lessons'],
        components: {
            DelPopup,
            EditPopup
        },
        created () {
            Events.$on('toggle-popup', () => {
                this.togglePopup()
            })
        },
        methods: {
            togglePopup () {
                this.showEditPopup = false
                this.checkedLesson = null
                this.showDelPopup = false
            },
            showCreate () {
                this.checkedLesson = null
                this.showEditPopup = true
            },
            deleteLesson (lesson) {
                this.checkedLesson = lesson
                this.showDelPopup = true
            }
        }
    }

</script>