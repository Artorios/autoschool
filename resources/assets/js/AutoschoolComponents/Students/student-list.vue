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
        </div>
    <table class="table manage-grid">
        <thead>
        <tr class="visible-md visible-lg">
            <th>№</th>
            <th>ФИО ученика</th>
            <th>Группа</th>
            <th>Текущий урок</th>
            <th>Успеваемость</th>
            <th>Экзамен</th>
        </tr>
        </thead>
        <tbody class="main">
            <tr data-id="1" class="visible-md visible-lg" v-for="(student, index) in pagination()">
                <td v-text="++index"></td>
                <td>
                    <a v-bind:href="`${student.auto_school_group_id}/${student.id}`" v-if="student.second_name">{{student.last_name}} {{student.name.toString()[0].toUpperCase()}}. {{student.second_name.toString()[0].toUpperCase()}}.</a>
                    <a v-bind:href="`${student.auto_school_group_id}/${student.id}`" v-else>{{student.last_name}} {{student.name.toString()[0].toUpperCase()}}.</a>
                </td>
                <td>
                    <a v-bind:href="group.id">{{group.name}}</a>
                </td>
                <td>Дорожные знаки. Предупреждающие знаки.</td>
                <td>80%</td>
                <td><span>Экзамен в ГБДД</span><a href="#">6 из 28</a></td>
            </tr>
        <div>
            <tr data-id="1" class="hidden-md hidden-lg" v-for="(student, index) in filterStudents">
                <td>
                    <table>
                        <tbody>
                        <tr>
                            <td>
                                <span class="big bold" v-text="++index"></span>
                            </td>
                            <td colspan="2">
                                <!--<a href="#" v-if="student.second_name">{{student.last_name}} {{student.name.toString()[0].toUpperCase()}}. {{student.second_name.toString()[0].toUpperCase()}}.</a>-->
                                <!--<a href="#" v-else>{{student.last_name}} {{student.name.toString()[0].toUpperCase()}}.</a>-->
                                <a href="#" v-if="student.second_name">{{student.last_name}} {{student.name}}. {{student.second_name}}.</a>
                                <a href="#" v-else>{{student.last_name}} {{student.name}}.</a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <th>Группа</th>
                            <td>
                                <a v-bind:href="group.id">{{group.name}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <th>Текущий урок</th>
                            <td>Дорожные знаки. Предупреждающие знаки.</td>
                        </tr>
                        <tr>
                            <td></td>
                            <th>Успеваемость</th>
                            <td>80%</td>
                        </tr>
                        <tr>
                            <td></td>
                            <th>Экзамен</th>
                            <td><span>Экзамен в ГБДД</span><a href="#">6 из 28</a></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>


            <tr data-id="1" class="payment-form" style="display: none">
                <td colspan="6">
                    <form action="">
                        <div class="close hidden-md hidden-lg"></div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <button class="btn-grey">Сохранить</button>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="close visible-md visible-lg"></div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        </div>

        </tbody>
    </table>

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
<script type="text/babel">
    export default {
        data() {
            return {
                searchText: '',
                searchByData: '',
                currentPage: 1,
                itemsPerPage: 10,
                resultCount: 0,
                errorDelete: false,
                selected: '',
            }
        },
        props: ['students', 'group'],
        computed: {
            totalPages: function () {
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },

            filterStudents: function () {
                if(this.searchText !== "") {
                    return this.filterStudentName()
                }
                else if (this.searchByData !== "") {
                    return this.filterStudentDate()
                }
                else if(this.selected === "desc"){
                    return this.filterStudentByDesk('name')
                }
                else if(this.selected === "acs"){
                    return this.filterStudentByASC('name')
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

            setPage(pageNumber) {
                this.currentPage = pageNumber
            },

            filterStudentName() {
                return this.students.filter((student) => {
                    return student.last_name.toLowerCase().includes(this.searchText
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
            }

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