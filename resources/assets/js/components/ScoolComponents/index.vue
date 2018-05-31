<template>
    <div class="content-wrapper">
        <add-school :school="this.checkedSchool" :edit="this.checkedSchool ? true : false" v-if="showEditPopup"></add-school>
        <section class="content-header">
            <h1>
                Автошколы
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
                            <h3 class="box-title">Список автошкол</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right" :placeholder="searchplaceholder">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-success btn-lg" @click="showCreate"><i class="fa fa-plus" style="margin-right: 10px;"></i>Добавить автошколу</button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Название</th>
                                    <th>Описание</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="school in schools.data">
                                    <td>{{school.id}}</td>
                                    <td>{{school.title}}</td>
                                    <td>{{school.description}}</td>
                                    <td>
                                        <button class="btn btn-success"
                                                title="Редактировать"
                                                @click="showEdit(school)"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-warning" title="Забанить"><i class="fa fa-ban"></i></button>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                        <!--<div class="input-group-btn">-->
                            <!--<button type="submit" class="btn btn-default" @click="showCreate">Добавить автошколу</button>-->
                        <!--</div>-->
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    </div>
</template>

<script type="text/babel">
    import AddSchool from './add-popup.vue'
    import {Events} from '../../app'
    export default {
        data () {
            return {
                checkedSchool: null,
                showEditPopup: false
            }
        },
        components: {
            AddSchool
        },
        props: ['schools', 'searchplaceholder'],
        created () {
            Events.$on('toggle-popup-school', () => {
                this.closePopup()
            })
        },
        methods: {
            closePopup () {
                this.showEditPopup = false
                this.checkedSchool = null
            },
            showEdit (school) {
                this.showEditPopup = true
                this.checkedSchool = school
            },
            showCreate () {
                this.showEditPopup = true
                this.checkedSchool = null
            }
        }
    }
</script>