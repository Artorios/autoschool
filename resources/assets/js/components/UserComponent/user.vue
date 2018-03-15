<template>
    <div class="content-wrapper">
        <edit-popup :user="this.checkedUser" :edit="this.checkedUser ? true : false" v-if="showEditPopup"></edit-popup>
        <section class="content-header">
            <h1>
                Пользователи
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
                            <h3 class="box-title">Список пользователей</h3>

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
                            <button type="submit" class="btn btn-success btn-lg" @click="showCreate"><i class="fa fa-plus" style="margin-right: 10px;"></i>Добавить пользователя</button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Логин</th>
                                    <th>Email</th>
                                    <th>Роль</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="user in users.data">
                                    <td>{{user.id}}</td>
                                    <td>{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td><span class="label label-success">{{user.role}}</span></td>
                                    <td>
                                        <button class="btn btn-success"
                                                title="Редактировать"
                                                @click="showEdit(user)"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-warning" title="Забанить"><i class="fa fa-ban"></i></button>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                        <!--<div class="input-group-btn">-->
                            <!--<button type="submit" class="btn btn-default" @click="showCreate">Добавить пользователя</button>-->
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
    import EditPopup from './add-popup.vue'
    export default {
        data () {
            return {
                checkedUser: null,
                showEditPopup: false
            }
        },
        props: ['users'],
        components: {
            EditPopup
        },
        created () {
            console.log(this.users)
            Events.$on('toggle-popup', () => {
                this.togglePopup()
            })
        },
        methods: {
            togglePopup () {
                this.showEditPopup = !this.showEditPopup
                this.checkedUser = null
            },
            showEdit (user) {
                this.checkedUser = user
                this.showEditPopup = true
            },
            showCreate () {
                this.checkedUser = null
                this.showEditPopup = true
            }
        }
    }

</script>