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
                            <select class="select">
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



            <div class="table-block table-block-students table-block-without-title">
            <div class="table-head">
                <span class="table-head-item number-item">№</span>
                <span class="table-head-item name-item">ФИО ученика</span>
                <span class="table-head-item group-item">Группа</span>
                <span class="table-head-item lesson-item">Текущий урок</span>
                <span class="table-head-item progress-item">Успеваемость</span>
                <span class="table-head-item exam-item">Экзамен</span>
            </div>
            <div class="table-item-row"
                 data-id="1"
                 v-for="(student, index) in pagination()">
                <div class="table-item number-item">
                    <div class="table-head-item hidden-head-text">№</div>
                    <div class="table-item-content">
                        <span v-text="++index"></span>
                    </div>
                </div>
                <div class="table-item name-item">
                    <div class="table-head-item hidden-head-text">ФИО ученика</div>
                    <div class="table-item-content">
                        <a class="table-item-link text-underline"
                           v-bind:href="`${student.auto_school_group_id}/${student.id}`"
                           v-if="student.second_name">
                            {{student.last_name}} {{student.name.toString()[0].toUpperCase()}}. {{student.second_name.toString()[0].toUpperCase()}}.
                        </a>
                        <a class="table-item-link text-underline"
                           v-bind:href="`${student.auto_school_group_id}/${student.id}`"
                           v-else>
                            {{student.last_name}} {{student.name.toString()[0].toUpperCase()}}.
                        </a>
                    </div>
                </div>
                <div class="table-item group-item">
                    <div class="table-head-item hidden-head-text">Группа</div>
                    <div class="table-item-content">
                        <a v-bind:href="group.id" class="table-item-link text-underline">{{group.id_number}}</a>
                    </div>
                </div>
                <div class="table-item lesson-item">
                    <div class="table-head-item hidden-head-text">Текущий урок</div>
                    <div class="table-item-content">
                        {{student.lesson_now.lesson_num}} {{student.lesson_now.title}}
                    </div>
                </div>
                <div class="table-item progress-item">
                    <div class="table-head-item hidden-head-text">Успеваемость</div>
                    <div class="table-item-content">
                        <span>{{student.progress}}%</span>
                    </div>
                </div>
                <div class="table-item exam-item">
                    <div class="table-head-item hidden-head-text">Экзамен</div>
                    <div v-if="student.last_exam" class="table-item-content">
                        <span v-if="student.last_exam.type == 'test'">
                            Тестовый экзамен
                        </span>
                        <a href="#" class="table-item-link text-underline">
                            {{student.last_exam.right_answer_count}} из {{student.last_exam.all_answer_count}}
                        </a>
                    </div>
                    <div v-if="!student.last_exam" class="table-item-content">
                        --
                    </div>
                </div>
            </div>
        </div>

            <div data-id="1" class="payment-form" style="display: none">
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
        </div>

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