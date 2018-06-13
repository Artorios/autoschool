<template>
<div>
    <div class="blockgroupe">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <select name="" id="type_filter" class="select">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="all" v-text="list.length"></option>
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
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="" class="select">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="all" v-text="list.length"></option>
                            </select>
                        </div>
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

        <div class="table-block table-filial-autoschool-finance table-block-without-title">
            <div class="table-head">
                <span class="table-head-item checkbox-item"></span>
                <span class="table-head-item number-item">№</span>
                <span class="table-head-item school-item">Автошкола/ID</span>
                <span class="table-head-item name-group-item">ФИО ученика/Группа</span>
                <span class="table-head-item pay-item">Тип оплаты</span>
                <span class="table-head-item date-item">Дата оплаты</span>
                <span class="table-head-item sum-item">Сумма</span>
                <span class="table-head-item commission-item">Комиссия</span>
                <span class="table-head-item status-item">Статус</span>
            </div>
            <div class="table-item-row status-active"
                        :data-id="index"
                        v-for="(item, index) in pagination()">
                    <div class="line-item coupons-checkbox">
                        <input type="checkbox" :value="item.CouponID"  v-model="checkedCoupons">
                    </div>
                    <div class="table-item number-item">
                        <div class="table-head-item hidden-head-text">№</div>
                        <div class="table-item-content">
                            <span v-text="++index"></span>
                        </div>
                    </div>
                    <div class="table-item school-item">
                        <div class="table-head-item hidden-head-text">Автошкола/ID</div>
                        <div class="table-item-content">
                            <a href="#" class="school-name table-item-link text-underline">{{ item.title }}</a>
                            <span class="school-id">{{ item.AutoSchoolId }}</span>
                        </div>
                    </div>
                    <div class="table-item name-group-item">
                        <div class="table-head-item hidden-head-text">ФИО ученика/Группа</div>
                        <div class="table-item-content">
                            <span class="student-name" v-text="getFullName(item)"></span>
                            <span class="group-number">Группа
                                <a class="table-item-link text-underline"
                                   href="javascript:">
                                    {{ item.GroupName }}
                                </a>
                            </span>
                        </div>
                    </div>
                    <div class="table-item pay-item">
                        <div class="table-head-item hidden-head-text">Тип оплаты</div>
                        <div class="table-item-content">
                            <span v-text="item.payment_option"></span>
                        </div>
                    </div>
                    <div class="table-item date-item">
                        <div class="table-head-item hidden-head-text">Дата оплаты</div>
                        <div class="table-item-content">
                            <span v-text="getDate(item)"></span>
                        </div>
                    </div>
                    <div class="table-item sum-item">
                        <div class="table-head-item hidden-head-text">Сумма</div>
                        <div class="table-item-content">
                            <span class="text-bold text-big">{{ item.amount }}</span>
                        </div>
                    </div>
                    <div class="table-item commission-item">
                        <div class="table-head-item hidden-head-text">Комиссия</div>
                        <div class="table-item-content">
                            <a class="table-item-link" href="javascript:">?</a>
                        </div>
                    </div>
                    <div class="table-item status-item">
                        <div class="table-head-item hidden-head-text">Статус</div>
                        <div class="table-item-content">
                            <a href="javascript:" class="table-item-link status" v-text="getstatus(item)">Оплаченно</a>
                        </div>
                    </div>

                    <div class="check-all-block">
                        <div class="check-all-input-block">
                        <label class="label-checkbox-with-text">
                            <input type="checkbox"
                                   true-value="false"
                                   false-value="true"
                                   v-model="checkedAll"
                                   @click="checkedCouponsAll(checkedAll)"
                                   class="hidden-checkbox">
                            <span class="label-check-text">Для всех</span>
                        </label>
                    </div>
                        <div class="check-all-text">
                        Отмечено
                        <!--<span class="text-bold">{{ checkedCoupons.length }}</span>-->
                        из
                        <!--<span class="text-bold">{{filteredList.length}}</span>-->
                    </div>
                        <div class="button-block">
                        <a class="btn-grey" @click="anull(checkedCoupons)">
                            Анулировать
                        </a>
                        <a class="btn-grey" @click="sellPopup">
                            Продать
                        </a>
                        <a class="btn-grey" @click="delCoupon">
                            Удалить
                        </a>
                    </div>
                    </div>
                    <div id="sale" class="blockform blockform-error hidden-popup">
                        <span v-if="this.createErrors.coupon == true"
                              class="coupon-error">
                          Не выбрано свободного купона<br>
                        </span>
                    <span v-if="this.createErrors.comment_investor"
                          class="coupon-error">
                          {{this.createErrors.comment_investor[0]}}<br>
                        </span>
                    <span v-if="this.createErrors.id"
                          class="coupon-error">
                          {{this.createErrors.id[0]}}<br>
                        </span>
                    <div class="form-inline">
                        <input type="text"
                               v-model="data.comment_investor"
                               placeholder="Комментарий">
                        <a class="btn-grey"
                           @click="sell(checkedCoupons)">
                            Выплатить
                        </a>
                        <a class="close" @click="closePopup('sale')"></a>
                    </div>
                </div>
                    <div class="blockform active " v-if="serverError">
                    <span v-if="this.createErrors.coupon == true" class="coupon-error">Выбирите купон<br></span>
                    <span v-if="this.createErrors.comment_investor" class="coupon-error">{{this.createErrors.comment_investor[0]}} <br></span>
                    <span v-if="this.createErrors.id" class="coupon-error">{{this.createErrors.id[0]}}<br></span>
                    <div class="form-inline">
                        <a class="close" @click="serverError=false"></a>
                    </div>
                </div>
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
    export default {
        data() {
            return {
                list: [],
                checkedCoupons: [],
                checkedAll: 'true',
                searchText: '',
                searchByData: '',
                currentPage: 1,
                itemsPerPage: 10,
                resultCount: 0,
                errorDelete: false,
                selected: '',
                data: {
                    comment_investor: ''
                },
                createErrors: {
                    comment_investor: '',
                    id: '',
                    coupon: false
                },
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
                    return this.filterSchoolName()
                }

                if (this.searchByData !== "") {
                    return this.filterOrderDate()
                }

                switch(this.selected) {
                    case "desc":
                        return this.filterStudentByDesk('title')
                    case 'acs':
                        return this.filterStudentByASC('title')
                    case 'data-desc':
                        return this.filterStudentByDesk('DatePayment')
                    case 'data-acs':
                        return this.filterStudentByASC('DatePayment')
                    default:
                        return this.filterSchoolName()
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
                } else {
                    this.currentPage = 1;
                }
                let index = this.currentPage * this.itemsPerPage - this.itemsPerPage
                return data.slice(index, index + this.itemsPerPage)
            },

            getFullName(item) {
                return item.studentName + " " + item.studentSecondName + " " + item.studentLastName
            },

            getDate(item) {
                if (item.DatePayment != null) {
                    let arrayItems = item.DatePayment.split(" ", 1);
                    let splitArray = arrayItems[0].split("-")
                    return splitArray[2] + "-" + splitArray[1] + "-" + splitArray[0]
                } else {
                    return ''
                }
            },

            setPage(pageNumber) {
                this.currentPage = pageNumber
            },


            filterSchoolName() {
                return this.list.filter((element) => {
                    return element.title.toLowerCase().includes(this.searchText
                        .toLowerCase());
                });
            },

            filterOrderDate() {
                return this.list.filter((student) => {
                    if(student.DatePayment != null) {
                        return student.DatePayment.split(" ", 1)[0].toLowerCase().includes(this.searchByData.toLowerCase());
                    }
                });
            },

            filterStudentByDesk(type_select) {
                if(type_select === 'DatePayment') {
                    return this.list.filter((element) => {
                            if(element.DatePayment != null) {
                                return element
                            }
                    }).sort((a, b) => a[type_select].localeCompare(b[type_select])).reverse();
                }
                if(type_select === 'title') {
                    return this.list.sort((a, b) => a[type_select].localeCompare(b[type_select])).reverse();
                }
            },

            filterStudentByASC(type_select) {
                if(type_select === 'DatePayment') {
                    return this.list.filter((element) => {
                        if(element.DatePayment != null) {
                            return element
                        }
                    }).sort((a, b) => a[type_select].localeCompare(b[type_select]))
                }
                if(type_select === 'title') {
                    return this.list.sort((a, b) => a[type_select].localeCompare(b[type_select]))
                }
            },

            pagination() {
                return this.paginate(this.filterStudents);
            },

            serverError() {
                this.errorDelete = true
            },

            checkedCouponsAll(status) {
                let checked = this.list.map(function (element) {
                    return element.CouponID
                })
                if(status == 'true'){
                    this.checkedCoupons = checked
                }
                else {
                    this.checkedCoupons = []
                }
            },

            sellOne(coupon){
                this.sellArray.comment_director = document.getElementById('sale-form'+coupon).value
                this.sellArray.id.push(coupon)
                this.$http.post('/autoschool/coupons/sell', this.sellArray).then(res => {
                    if (res.status === 201) {
                        console.log(res.data.count);
                        if(res.data.count === 0){
                            this.createErrors.coupon = true
                        }
                        else {
                            location.href = '/autoschool/coupons'
                        }
                    }
                }, err => {
                    if (+err.status === 422) {
                        console.log(err.data)
                        this.serverError = true
                        this.createErrorsTop = err.data['errors']
                    }
                })
            },

            commentSave(coupon){
                this.comment.comment_director = document.getElementById('comment-form' + coupon).value
                this.comment.id = []
                this.comment.id.push(coupon)
                this.$http.post('/autoschool/coupons/comment', this.comment).then(res => {
                    if (res.status === 201) {
                        console.log(res.data.count);
                        location.href = '/autoschool/coupons'

                    }
                }, err => {
                    if (+err.status === 422) {
                        console.log(err.data)
                        this.createErrorsTop = err.data['errors']
                    }
                })
                console.log(this.comment)

            },

            sellPopup(){
                document.getElementById('sale').classList.remove('hidden-sale')
            },

            anull(coupons){
                this.data.id = coupons
                this.$http.post('/autoschool/coupons/canceled', this.data).then(res => {
                    if (res.status === 201) {
                        console.log(res.data.count);

                        location.href = '/autoschool/coupons'

                    }
                }, err => {
                    if (+err.status === 422) {
                        console.log(err.data)
                        this.createErrorsTop = err.data['errors']
                    }
                })
            },

            sell(id){
                this.createErrors.comment_director = ''
                this.createErrors.id = ''
                this.data.id = id
                this.$http.post('/autoschool/coupons/sell', this.data).then(res => {
                    if (res.status === 201) {
                        console.log(res.data.count);
                        if(res.data.count === 0){
                            this.createErrors.coupon = true
                        }
                        else {
                            location.href = '/autoschool/coupons'
                        }
                    }
                }, err => {
                    if (+err.status === 422) {
                        console.log(err.data)
                        this.serverError = true
                        this.createErrors = err.data['errors']
                    }
                })
            },

            getstatus(item) {
                switch (item.status) {
                    case 1:
                        return 'Свободный'
                    case 2:
                        return 'Проданый'
                    case 3:
                        return 'Активированный'
                }
            },

            delCoupon(coupons) {
                this.serverError=false
                this.data.id = coupons
                this.$http.post('/investor/coupons/delete', this.data).then(res => {
                    if (res.status === 201) {
                        window.location.reload(true);
                    }
                }, err => {
                    if (+err.status === 422) {
                        this.createErrors = err.data['errors']
                        this.serverError = true
                    }
                })
            }

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
    .table-item-row {
        flex-wrap: nowrap;
    }
</style>