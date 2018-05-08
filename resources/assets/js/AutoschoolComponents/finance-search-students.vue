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
                            <option value="data-desc">От начала</option>
                            <option value="data-acs">От конца</option>
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
            <tr data-id="1" class="visible-md visible-lg" v-for="(student, index) in filterStudents">
                <td>
                    <div class="checked-line">
                        <input type="checkbox" v-bind:value="`${student.userId}`"  v-model="gridSelected">
                        <label for="checked-line"></label>
                    </div>
                </td>
                <td>{{++index}}</td>
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
                    return this.students.filter((student) => {
                        return student.studentName.toLowerCase().includes(this.searchText
                            .toLowerCase());
                    });
                }
                else if (this.searchByData !== "") {
                    return this.students.filter((student) => {
                         return student.updated_at.toLowerCase().includes(this.searchByData.toLowerCase());
                     });
                }
                else if(this.selected === "desc"){
                    return this.students.reverse(function(a,b){return b - a});
                }

                else if(this.selected === "acs"){
                    return this.students.sort(function(a,b){return a.studentName < b.studentName ? -1 : 1}
                    );
                }
                else if(this.selected === "data-desc"){
                    return this.students.reverse(function(a,b){return b - a});
                }
                else if(this.selected === "data-acs"){
                    return this.students.sort(function(a,b){return a.created_at < b.created_at ? -1 : 1});
                }
                else {
                    return this.students.filter((student) => {
                        return student.studentName.toLowerCase().includes(this.searchText
                            .toLowerCase());
                    });
                }
            },

            totalSelectedStudents() {
                if(this.gridSelectedAll){
                    if(this.resultCount < this.itemsPerPage){
                        return this.resultCount
                    }
                    return this.itemsPerPage
                }else {
                    return this.gridSelected.length
                }
            },


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
            },
            delateData(){
                if(this.gridSelected.length < 1){
                   this.errorDelete = true
                }else {
                    this.errorDelete = false
                        let data = {
                            'id': this.gridSelected
                        }
                            this.$http.post('delete-users', data).then(res => {
                                (res.status == 201) ? location.href = '/autoschool/finances' : this.serverError
                            });

                }
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
                    vm.selectByName(vm.selected)
                },
            })
        },
        created:function(){this.paginate()},
        beforeUpdate:function(){this.paginate()},
    }
</script>

<style scoped>
</style>