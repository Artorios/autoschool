<template>
    <div class="content-wrapper">
        <edit-popup :user="this.checkedUser" :edit="this.checkedUser ? true : false" v-if="showEditPopup"></edit-popup>
        <pay-popup :user="this.checkedUser" v-if="showPayPopup"></pay-popup>
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
                                    <input type="text" name="table_search" class="form-control pull-right"
                                           v-model="query" :placeholder="searchplaceholder">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default" @click="search"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-success btn-lg" @click="showCreate"><i
                                    class="fa fa-plus" style="margin-right: 10px;"></i>Добавить пользователя
                            </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>ФИО</th>
                                    <th>Город</th>
                                    <th>Автошкола</th>
                                    <th>Група</th>
                                    <th>Email</th>
                                    <th>Роль</th>
                                    <th v-if="role == 'user' || role == 'all'">Статус</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <p class="error" v-if="error_search">{{error_search}}</p>

                                <tr v-for="user in pagination()">

                                    <td>{{user.id}}</td>
                                    <td>{{user.last_name}} {{user.name}} {{user.second_name}}</td>
                                    <td v-if="user.city">{{user.city.name}}</td>
                                    <td v-else></td>
                                    <td v-if="user.school">{{user.school.title}}</td>
                                    <td v-else></td>
                                    <td v-if="user.autoschoolgroup">{{user.autoschoolgroup.name}}</td>
                                    <td v-else></td>
                                    <td>{{user.email}}</td>
                                    <td><span class="label label-success">{{user.role}}</span></td>

                                    <td v-if="role == 'user' || role == 'all'">
                                    <div v-if="sale_status(user) == 'paid'">оплаченый</div>
                                    <div v-else>неоплаченный</div>
                                    </td>
                                    <td>
                                        <button class="btn btn-success"
                                                title="Редактировать"
                                                @click="showEdit(user)"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-success"
                                                title="Редактировать"
                                                v-if="sale_status(user) == 'not_paid'"
                                                @click="showPay(user)">$</button>
                                        <button class="btn btn-warning" title="Забанить"><i class="fa fa-ban"></i></button>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                            <ul class="pagination" v-if="itemsPerPage < resultCount">
                                <li class="page-item" v-for="pageNumber in totalPages">
                                    <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#"
                                       v-bind:key="pageNumber" @click="setPage(pageNumber)">{{pageNumber}}</a>
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
    import PayPopup from './pay-popup.vue'

    export default {
        data() {
            return {
                currentPage: 1,
                itemsPerPage: 10,
                checkedUser: null,
                showEditPopup: false,
                showPayPopup: false,
                query: '',
                error_search: '',
                lists: {},
            }
        },
        props: ['users', 'searchplaceholder', 'role'],
        components: {
            EditPopup,
            PayPopup,
        },
        computed: {


            totalPages: function () {
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },
        },
        created() {
            this.lists = this.users
            Events.$on('toggle-popup', () => {
                this.togglePopup()
            })
            Events.$on('toggle-popup-pay', () => {
                this.togglePopupPay()
            })
            this.pagination()
        },
        methods: {
            paginate(items) {
                if (!items || items.length != items.length) {
                    return
                }
                this.resultCount = items.length
                if (this.currentPage >= this.totalPages) {
                    this.currentPage = this.totalPages
                }

                let index = this.currentPage * this.itemsPerPage - this.itemsPerPage

                return items.slice(index, index + this.itemsPerPage)
            },
            setPage(pageNumber) {
                this.currentPage = pageNumber
            },
            togglePopup() {
                this.showEditPopup = !this.showEditPopup
                this.checkedUser = null
            },
            togglePopupPay () {
                this.showPayPopup = !this.showPayPopup
                this.checkedUser = null
            },
            showEdit(user) {
                this.checkedUser = user
                this.showEditPopup = true
            },
            showPay (user) {
                this.checkedUser = user
                this.showPayPopup = true
            },
            showCreate () {
                this.checkedUser = null
                this.showEditPopup = true
            },
            search() {
                if (this.query) {

                    this.$http.get('/api/admin/' + this.role + '/search-user?q=' + this.query).then(res => {
                        if (res.data) {
                            if (!res.data.error) {
                                this.lists = res.data
                                this.currentPage = '1'
                                this.error_search = ''

                            }
                            else {
                                this.lists = []
                                this.error_search = res.data.error
                            }
                        }
                    });
                }
                else {
                    this.lists = this.users
                }
            },
            pagination() {
                return this.paginate(this.lists);
            },
            sale_status(user) {
                if (user.orders.length > 0) {
                    return 'paid'
                }
                else {
                    if (user.coupons.length > 0) {
                        var st = 0
                        for (var i = 0; i < user.coupons.length; i++) {
                            if (user.coupons[i].status == 3) {
                                st = 1
                                return 'paid'
                            }

                        }
                        if (st == 0) {
                            return 'not_paid'
                        }

                    }
                    else {
                        return 'not_paid'
                    }
                }

            }
        },
        updated() {
            this.pagination()
        },
    }

</script>