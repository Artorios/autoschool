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
                                    <p class="error" v-if="error_search">{{error_search}}</p>
                                    <input type="text" name="table_search" class="form-control pull-right" v-model="query" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default" @click="search"><i class="fa fa-search"></i></button>
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
                                    <th>Автошкола</th>
                                    <th>Роль</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="user in pagination()">
                                    <td>{{user.id}}</td>
                                    <td>{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td>{{user}}</td>
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
                            <ul class="pagination" v-if="itemsPerPage < resultCount">
                                <li class="page-item" v-for="pageNumber in totalPages">
                                    <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber" @click="setPage(pageNumber)">{{pageNumber}}</a>
                                </li>
                            </ul>
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
                currentPage: 1,
                itemsPerPage: 10,
                checkedUser: null,
                showEditPopup: false,
                query: '',
                error_search: '',
                lists: {}
            }
        },
        props: ['users'],
        components: {
            EditPopup
        },
        computed: {


            totalPages: function(){
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },
        },
        created () {
            this.lists = this.users
            Events.$on('toggle-popup', () => {
                this.togglePopup()
            })
            this.pagination()
        },
        methods: {
            paginate(items){
                if (!items || items.length != items.length){
                    return
                }
                this.resultCount = items.length
                if(this.currentPage >= this.totalPages){
                    this.currentPage = this.totalPages
                }

                let index = this.currentPage * this.itemsPerPage - this.itemsPerPage

                return items.slice(index, index + this.itemsPerPage)
            },
            setPage(pageNumber){
                this.currentPage = pageNumber
            },
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
            },
            search(){
                if (this.query) {
                    this.$http.get('/api/admin/search-user?q=' + this.query).then(res => {
                        if(res.data){
                            if(!res.data.error){
                                this.lists = res.data
                                this.currentPage = '1'
                            }
                            else {
                                this.error_search = res.data.error
                            }
                        }
                        console.log(res.data.error)
                    });
                }
                else {
                    this.lists = this.users
                }
            },
            pagination() {
                return this.paginate(this.lists);
            },
        },
        updated(){
            this.pagination()
        },
    }

</script>