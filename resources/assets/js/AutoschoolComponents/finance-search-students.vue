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

        <div class="table-block table-autoschool-finance table-block-without-title">
            <div class="table-head">
                <span class="table-head-item checkbox-item"></span>
                <span class="table-head-item number-item">№</span>
                <span class="table-head-item name-item">ФИО ученика</span>
                <span class="table-head-item group-item">Группа</span>
                <span class="table-head-item pay-item">Тип оплаты</span>
                <span class="table-head-item date-item">Дата оплаты</span>
                <span class="table-head-item sum-item">Сумма</span>
            </div>
            <div class="table-item-row"
                 data-id="1"
                 v-for="(student, index) in pagination()">
                <div class="table-item checkbox-item">
                    <label class="label-checkbox">
                        <input type="checkbox"
                               v-bind:value="`${student.userId}`"
                               v-model="gridSelected"
                               class="hidden-checkbox">
                        <span class="label-check"></span>
                    </label>
                </div>
                <div class="table-item number-item">
                    <div class="table-head-item hidden-head-text">№</div>
                    <div class="table-item-content">
                        {{++index}}
                    </div>
                </div>
                <div class="table-item name-item">
                    <div class="table-head-item hidden-head-text">ФИО ученика</div>
                    <div class="table-item-content">
                        <span class="student-name" v-text="fullName(student)"></span>
                    </div>
                </div>
                <div class="table-item group-item">
                    <div class="table-head-item hidden-head-text">Группа</div>
                    <div class="table-item-content">
                        <span class="group-number">
                            <a :href="`filials/groups/${student.auto_school_group_id}`"
                               v-text="student.autoSchoolGroupName"
                               class="table-item-link text-underline">
                            </a>
                        </span>
                    </div>
                </div>
                <div class="table-item pay-item">
                    <div class="table-head-item hidden-head-text">Тип оплаты</div>
                    <div class="table-item-content">
                        <span v-text="student.payment_option"></span>
                    </div>
                </div>
                <div class="table-item date-item">
                    <div class="table-head-item hidden-head-text">Дата оплаты</div>
                    <div class="table-item-content">
                        <span v-text="getDate(student)"></span>
                    </div>
                </div>
                <div class="table-item sum-item">
                    <div class="table-head-item hidden-head-text">Сумма</div>
                    <div class="table-item-content">
                        <a class="table-item-link text-underline"
                           href="#"
                           v-text="student.amount">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="check-all-block">
            <div class="check-all-input-block">
                <label class="label-checkbox-with-text">
                    <input type="checkbox"
                           class="hidden-checkbox"
                           v-model="gridSelectedAll">
                    <span class="label-check-text">Для всех</span>
                </label>
            </div>
            <div class="check-all-text">
                Отмечено {{totalSelectedStudents}}
            </div>
            <div class="button-block">
                <a href="#" type="text" class="btn-grey" @click="delateData()">Удалить</a>
            </div>
        </div>

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