<template>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Ученики
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
                            <h3 class="box-title">Список учеников</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right" v-model="searchText" placeholder="Выберете пользователя">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
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
                                    <th>ФИО</th>
                                    <th>Город</th>
                                    <th>Автошкола</th>
                                    <th>Група</th>
                                    <th>Email</th>
                                    <th>Статус</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(user, index) in pagination()">
                                    <td v-text="getCurectIndex(index)"></td>
                                    <td v-text="getFullName(user)"></td>
                                    <td v-text="user.cityName"></td>
                                    <td v-text="user.AutoschoolName"></td>
                                    <td v-text="user.AutoschoolGroupName"></td>
                                    <td v-text="user.UserEmail"></td>
                                    <td v-text="getStatusCupon(user)"></td>
                                </tr>
                                </tbody>
                            </table>
                            <ul class="pagination" v-if="itemsPerPage < resultCount">
                                <li class="page-item" v-for="pageNumber in totalPages">
                                    <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber" @click="setPage(pageNumber)">{{pageNumber}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                currentPage: 1,
                itemsPerPage: 10,
                searchText: '',
                resultCount: 0,
                errors: {
                    error_search: '',
                },
                list: [],
            }
        },

        computed: {

            totalPages: function () {
                return Math.ceil(this.resultCount / this.itemsPerPage)
                },

            filterStudents() {
                return this.filterStudentName()
            },
        },

        methods: {
            filterStudentName() {
                return this.list.filter((student) => {
                    return student.studentName.toLowerCase().includes(this.searchText
                        .toLowerCase());
                });
            },

            paginate(data) {
                if (!data || data.length != data.length) {
                    return
                }
                this.resultCount = data.length
                if (this.currentPage >= this.totalPages) {
                    this.currentPage = this.totalPages
                }
                else if (this.currentPage <= 0) {
                    this.currentPage = 1
                }
                let index = this.currentPage * this.itemsPerPage - this.itemsPerPage
                return data.slice(index, index + this.itemsPerPage)
            },

            getFullName(item) {
                return item.studentName + " " + item.studentSecondName + " " + item.studentLastName
            },

            getDataFromServer() {
                this.$http.post('/admin/students/get-list-students', this.data).then(res => {
                    if (res.status === 201) {
                        this.list = res.data.data
                    }
                }, err => {
                    if (+err.status === 400) {
                        this.serverError = true
                    }
                })
            },

            getStatusCupon(item) {
                return item == 5 ? 'оплаченый' : 'неоплаченный'
            },

            pagination() {
                return this.paginate(this.filterStudents);
            },

            filterStudentName() {
                return this.list.filter((student) => {
                    return student.studentName.toLowerCase().includes(this.searchText
                        .toLowerCase());
                });
            },

            setPage(pageNumber) {
                this.currentPage = pageNumber
            },

            getCurectIndex(item) {
                return (this.currentPage <= 1) ? ++item : ++item + ((this.currentPage - 1) * 10)
            }
        },

        created() {
            this.pagination()
        },

        mounted() {
            this.getDataFromServer()
        },

        updated() {
            this.pagination()
        }
    }
</script>

<style scoped>

</style>