<template>
    <div>
    <div class="blockgroupe">
        <div class="search-form blockforms finance">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="search">
                            <input type="text" v-model="searchText" placeholder="Введите что искать">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="select">
                            <option selected disabled>ФИО ученика</option>
                            <option v-for="(item, index) in students" v-text="fullName(item)"></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="select">
                            <option selected disabled>По дате</option>
                            <option v-for="(item, index) in students" v-text="getDate(item)"></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="data">
                            <input type="text" placeholder="Дата">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table manage-grid">
            <thead>
            <tr class="visible-md visible-lg">
                <th></th>
                <th>№</th>
                <th>ФИО ученика</th>
                <th>Группа</th>
                <th>Тип оплаты</th>
                <th>Дата оплаты</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody class="main">
            <tr data-id="1" class="visible-md visible-lg" v-for="student in filterStudents">
                <td>
                    <div class="checked-line">
                        <input type="checkbox" name="grid_selected[]" v-model="gridSelected">
                        <label for="checked-line"></label>
                    </div>
                </td>
                <td>1</td>
                <td><span class="student-name" v-text="fullName(student)"></span></td>
                <td><span class="group-number">Группа <a
                        href="javascript:" v-text="student.autoSchoolGroupName"></a></span></td>
                <td v-text="student.payment_option"></td>
                <td v-text="getDate(student)"></td>
                <td>
                    <a class="bold big" href="javascript:" v-text="student.amount"></a></td>
            </tr>
            </tbody>
            <tfoot class="finance-line-height">
            <tr>
                <td colspan="9">
                    <div class="row nero">
                        <div class="col-md-2 margin-12">
                            <input type="checkbox"> Для всех
                        </div>
                        <div class="col-md-2 margin-12">
                            Отмечено 1 из 12
                        </div>
                        <div class="col-xs-12 col-md-2"><a type="text" class="btn-grey">Анулировать</a></div>
                        <div class="col-xs-12 col-md-2"><a type="text" class="btn-grey">Удалить</a></div>
                        <div class="col-xs-12 col-md-4">
                            <select class="select">
                                <option selected disabled>Виберите действие</option>
                                <option>1</option>
                                <option>2</option>
                            </select>
                        </div>
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
        <div class="invitegroupe">
            <ul class="pagination" v-if="itemsPerPage < resultCount">
                <li class="page-item" v-for="pageNumber in totalPages">
                    <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber"
                       @click="setPage(pageNumber)">{{pageNumber}}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import FinanceSelectStudents from './finance-select-students'
    export default {
        components: {
            FinanceSelectStudents,
        },
        data() {
            return {
                searchText: '',
                currentPage: 1,
                itemsPerPage: 10,
                resultCount: 0,
                gridSelected: []
            }
        },
        props: {
            students: {},
        },
        computed: {
            totalPages: function () {
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },

            filterStudents() {
                return this.students.filter((student) => {
                    return student.studentName.toLowerCase().includes(this.searchText.toLowerCase());
                });
            }
        },
        methods: {
            paginate: function () {
                if (!this.students || this.students.length != this.students.length) {
                    return
                }
                this.resultCount = this.filterStudents.length
                if (this.currentPage >= this.totalPages) {
                    this.currentPage = this.totalPages
                }
                let index = this.currentPage * this.itemsPerPage - this.itemsPerPage
                return this.filterStudents.slice(index, index + this.itemsPerPage)
            },
            fullName(item) {
                return item.studentName + " " + item.studentSecondName + " " + item.studentLastName
            },
            getDate(item) {
                let arrayItems = item.created_at.split(" ", 1);
                let splitArray = arrayItems[0].split("-")
                return splitArray[2] + "-" + splitArray[1] + "-" + splitArray[0]
            },
            setPage(pageNumber) {
                this.currentPage = pageNumber
            },
            searchData(){
                let Date = this.students.filter((student) => {
                    return student.created_at.toLowerCase().includes(this.searchText.toLowerCase());
                });
                this.students = Date;
            }
        },
        created:function(){this.paginate()},
        beforeUpdate:function(){this.paginate()},
    }
</script>

<style scoped>
</style>