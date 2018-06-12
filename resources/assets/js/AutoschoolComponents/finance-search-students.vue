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
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <select class="select user">
                            <option selected disabled>ФИО ученика</option>
                            <option value="acs">От А-Я</option>
                            <option value="desc">От Я-А</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <select class="select">
                            <option selected disabled>По дате</option>
                            <option value="data-acs">От начала</option>
                            <option value="data-desc">От конца</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <div class="data">
                            <input type="text" v-model="searchByData" placeholder="Дата">
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
            <tr data-id="1" class="visible-md visible-lg" v-for="(student, index) in pagination()">
                <td>
                    <div class="checked-line">
                        <input type="checkbox" v-bind:value="`${student.userId}`"  v-model="gridSelected">
                        <label for="checked-line"></label>
                    </div>
                </td>
                <td>{{++index}}</td>
                <td>
                    <span class="student-name" v-text="fullName(student)"></span>
                </td>
                <td><span class="group-number">Группа
                    <a :href="`filials/groups/${student.auto_school_group_id}`" v-text="student.autoSchoolGroupName"></a></span></td>
                <td v-text="student.payment_option"></td>
                <td v-text="getDate(student)"></td>
                <td>
                    <a class="bold big" href="#" v-text="student.amount"></a></td>
            </tr>
            </tbody>
            <tfoot class="finance-line-height">
            <tr>
                <td colspan="9">
                    <div class="row nero">
                        <div class="col-md-2 margin-12">
                            <input type="checkbox" v-model="gridSelectedAll"> Для всех
                        </div>
                        <div class="col-md-2 margin-12">
                            Отмечено {{totalSelectedStudents}}
                        </div>
                        <div class="col-xs-12 col-md-2"><a type="text" class="btn-grey" @click="delateData()">Удалить</a></div>

                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
        <h2 v-if="this.errorDelete">Выберете учеников</h2>
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
    import FinanceSelectStudents from './finance-select-students';
    export default {
        components: {
            FinanceSelectStudents,
        },
        data() {
            return {
                searchText: '',
                searchByData: '',
                currentPage: 1,
                itemsPerPage: 10,
                resultCount: 0,
                gridSelected: [],
                gridSelectedAll: '',
                errorDelete: false,
                selected: ''
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
                if(this.searchText !== "") {
                    return this.filterStudentName()
                }
                else if (this.searchByData !== "") {
                    return this.filterStudentDate()
                }
                else if(this.selected === "desc"){
                    return this.filterStudentByDesk('studentName')
                }
                else if(this.selected === "acs"){
                    return this.filterStudentByASC('studentName')
                }
                else if(this.selected === "data-desc"){
                    return this.filterStudentByDesk('created_at')
                }
                else if(this.selected === "data-acs"){
                    return this.filterStudentByASC('created_at')
                }
                else {
                    return this.filterStudentName()
                }
            },

            totalSelectedStudents() {
                return this.gridSelectedAll ?  this.pagination().length : this.gridSelected.length
            }

            },
        watch: {
            gridSelectedAll() {
                if(this.gridSelectedAll){
                    if(this.gridSelected.length > 0) {
                        this.gridSelected = []
                    }
                    for (let index in this.pagination()) {
                        this.gridSelected.push(this.pagination()[index].userId)
                    }
                }else {
                    this.gridSelected = []
                }
            }
        },
        methods: {
            paginate(data) {
                if (!data || data.length != data.length) {
                    return
                }
                this.resultCount = data.length
                if (this.currentPage >= this.totalPages) {
                    this.currentPage = this.totalPages
                }else {
                    this.currentPage = 1;
                }
                let index = this.currentPage * this.itemsPerPage - this.itemsPerPage
                return data.slice(index, index + this.itemsPerPage)
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

            delateData() {
                if (this.gridSelected.length < 1) {
                    this.errorDelete = true
                } else {

                    let data = {
                        'id': this.gridSelected
                    }
                    this.$http.post('delete-users', data).then(res => {
                        (res.status == 201) ? location.href = '/autoschool/finances' : this.serverError
                    });
                }
            },

            filterStudentName() {
                return this.students.filter((student) => {
                    return student.studentName.toLowerCase().includes(this.searchText
                        .toLowerCase());
                });
            },

            filterStudentDate(){
                return this.students.filter((student) => {
                    return student.created_at.split(" ", 1)[0].toLowerCase().includes(this.searchByData.toLowerCase());
                });
            },

            filterStudentByDesk(type_select){
                return this.students.sort((a, b) => a[type_select].localeCompare(b[type_select])).reverse();
            },

            filterStudentByASC(type_select){
                return this.students.sort((a, b) => a[type_select].localeCompare(b[type_select]))
            },

            pagination() {
                return this.paginate(this.filterStudents);
            },

            serverError(){
                this.errorDelete = true
            },
        },
        mounted () {
            let vm = this
            $('.select ').selectric({
                onChange: function (element) {
                    vm.selected = $(element).val()
                },
            })
        },
        created(){
            this.pagination()
        },
        updated(){
            this.pagination()
        },
    }
</script>

<style scoped>
</style>