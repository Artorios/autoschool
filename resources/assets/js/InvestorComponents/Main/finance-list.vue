<template>
<div>
    <div class="blockgroupe">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <select name="" id="type_filter" class="select">
                        <option value="all">Все(25)</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group">
                    <button class="btn-grey w-100 no-margin">Генерация купонов</button>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group">
                    <button class="btn-grey w-100 no-margin">Статистика купонов</button>
                </div>
            </div>
        </div>

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
                         <select class="select user">
                                <option selected disabled>ФИО ученика</option>
                                <option value="acs">От А-Я</option>
                                <option value="desc">От Я-А</option>
                         </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="select">
                            <option selected disabled>По дате</option>
                            <option value="data-acs">От начала</option>
                            <option value="data-desc">От конца</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
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
                <th>№</th>
                <th>Автошкола/ID</th>
                <th>ФИО ученика/Группа</th>
                <th>Тип оплаты</th>
                <th>Дата оплаты</th>
                <th>Сумма</th>
                <th>Комиссия</th>
                <th>Статус</th>
            </tr>
            </thead>
            <tbody class="main">
            <tr data-id="1" class="visible-md visible-lg status-active" v-for="(item, index) in pagination()">
                <td v-text="++index"></td>
                <td>
                    <a class="school-name">{{ item.title }}</a>
                    <span class="school-id">{{ item.AutoSchoolId }}</span>
                </td>
                <td>
                    <span class="student-name" v-text="getFullName(item)"></span>
                    <span class="group-number">Группа
                        <a href="javascript:">{{ item.GroupName }}</a>
                    </span>
                </td>
                <td v-text="item.payment_option"></td>
                <td v-text="getDate(item)"></td>
                <td><span class="bold big">{{ item.amount }}</span></td>
                <td><a class="bold big" href="javascript:">?</a></td>
                <td><a href="javascript:" class="status">Оплаченно</a></td>
            </tr>
            </tbody>
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
    export default {
        data() {
            return {
                list: [],
                searchText: '',
                searchByData: '',
                currentPage: 1,
                itemsPerPage: 10,
                resultCount: 0,
                errorDelete: false,
                selected: ''
                }
            },

        mounted() {
            window.axios.get('/investor/finance/list')
                .then((response) => {
                    this.list = response.data.data
            })

            let vm = this
            $('.select ').selectric({
                onChange: function (element) {
                    vm.selected = $(element).val()
                },
            })

        },

        computed: {
            totalPages: function () {
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },

            filterStudents() {
                if(this.searchText !== "") {
                    return this.filterStudentName()
                }

                if (this.searchByData !== "") {
                    return this.filterStudentDate()
                }

                switch(this.selected) {
                    case "desc":
                        return this.filterStudentByDesk('studentName')
                    case 'acs':
                        return this.filterStudentByASC('studentName')
                    case 'data-desc':
                        return this.filterStudentByDesk('created_at')
                    case 'data-acs':
                        return this.filterStudentByASC('created_at')
                    default:
                        return this.filterStudentName()
                }
            },

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

            getFullName(item) {
                return item.studentName + " " + item.studentSecondName + " " + item.studentLastName
            },

            getDate(item) {
                let arrayItems = item.DatePayment.split(" ", 1);
                let splitArray = arrayItems[0].split("-")
                return splitArray[2] + "-" + splitArray[1] + "-" + splitArray[0]
            },

            setPage(pageNumber) {
                this.currentPage = pageNumber
            },

            filterStudentName() {
                return this.list.filter((student) => {
                    return student.studentName.toLowerCase().includes(this.searchText
                        .toLowerCase());
                });
            },

            filterStudentDate(){
                return this.list.filter((student) => {
                    return student.created_at.split(" ", 1)[0].toLowerCase().includes(this.searchByData.toLowerCase());
                });
            },

            filterStudentByDesk(type_select){
                return this.list.sort((a, b) => a[type_select].localeCompare(b[type_select])).reverse();
            },

            filterStudentByASC(type_select){
                return this.list.sort((a, b) => a[type_select].localeCompare(b[type_select]))
            },

            pagination() {
                return this.paginate(this.filterStudents);
            },

            serverError(){
                this.errorDelete = true
            },

        },
        created(){
            this.pagination()
        },
        updated(){
            this.pagination()
        },
    }
</script>