<template>
    <div>
        <div class="blockgroupe">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select id="page" v-model="itemsPerPage" class="select">
                            <option>10</option>
                            <option>20</option>
                            <option>50</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <a class="btn-grey w-100 no-margin" href="/investor/coupons/create">Генерация купонов</a>
                    </div>
                </div>
            </div>

            <div class="search-form blockforms finance">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="search">
                                <input type="text"
                                       placeholder="Введите что искать"
                                       v-model="searchTitle"
                                       v-on:keyup="filterByTitle">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <select id="sortName" class="select" v-model="sortNameType">
                                <option selected disabled>ФИО ученика</option>
                                <option value="a">От А-Я.</option>
                                <option value="z">От Я-А</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <select id="sortDate" class="select" v-model="sortDateType">
                                <option selected disabled>Дата</option>
                                <option value="asc">От начала</option>
                                <option value="desc">От конца</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <div class="data">
                                <datepicker
                                        v-model="selectedDate"
                                        :language="lang"
                                        format="yyyy-MM-dd"
                                        name="uniquename"
                                        @selected="filterByDate">
                                </datepicker>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="coupon-table" v-if="list.length">
                <div class="table-coupon table-investor">
                    <div class="title-line line">
                        <span class="line-item coupons-checkbox"></span>
                        <span class="line-item number">№</span>
                        <span class="line-item coupon">Купон</span>
                        <span class="line-item autoschool">Автошкола /ID</span>
                        <span class="line-item city">Филиал /Город</span>
                        <span class="line-item name-student">ФИО ученика /группа</span>
                        <span class="line-item generate-date">Дата генерации</span>
                        <span class="line-item activate-date">Дата активации</span>
                        <span class="line-item price">Сумма оплаты</span>
                        <span class="line-item status">Комиссия /статус</span>
                    </div>

                    <div v-for="item in pagination()"
                         :class="[{active: item.status === 3,
                        sale: item.status === 2,
                        free: item.status === 1},
                        'line']">
                        <div class="line-item coupons-checkbox">
                            <label class="label-checkbox">
                                <input type="checkbox"
                                       v-model="checkedCoupons"
                                       :value="item.id"
                                       class="hidden-checkbox">
                                <span class="label-check"></span>
                            </label>
                        </div>
                        <div class="line-item number">
                            <div class="hidden-head-text">№</div>
                            <div class="line-item-content">
                                {{ item.id }}
                            </div>
                        </div>
                        <div class="line-item coupon">
                            <div class="hidden-head-text">Купон</div>
                            <div class="line-item-content">
                                <a href="#">
                                    {{ item.name }}
                                </a>
                            </div>
                        </div>
                        <div class="line-item autoschool">
                            <div class="hidden-head-text">Автошкола /ID</div>
                            <div class="line-item-content">
                                <a href="">{{ item.autoschool.title }}</a>
                                ID {{ item.autoschool.id }}
                            </div>
                        </div>
                        <div class="line-item city">
                            <div class="hidden-head-text">Филиал /Город</div>
                            <div class="line-item-content">
                                {{ item.autoschool.city.name }} / {{ item.autoschool.city.ru_path }}
                            </div>
                        </div>
                        <div class="line-item name-student">
                            <div class="hidden-head-text">ФИО ученика /группа</div>
                            <div class="line-item-content">
                                {{ item.student_surname+ ' ' +item.student_name }}
                                <a href="#" v-if="item.group_id">
                                    / №{{ item.group_id }}
                                </a>
                            </div>
                        </div>
                        <div class="line-item generate-date">
                            <div class="hidden-head-text">Дата генерации</div>
                            <div class="line-item-content">
                                {{ item.date.generation }}
                            </div>
                        </div>
                        <div class="line-item activate-date">
                            <div class="hidden-head-text">Дата активации</div>
                            <div class="line-item-content">
                                {{ item.date.activation }}
                            </div>
                        </div>
                        <div class="line-item price">
                            <div class="hidden-head-text">Сумма оплаты</div>
                            <div class="line-item-content">
                                <span class="text-bold text-big">{{ item.amount.payment }}</span>
                            </div>
                        </div>
                        <div class="line-item status">
                            <div class="hidden-head-text">Комиссия /статус</div>
                            <div class="line-item-content">
                                <div class="status-fee">
                                    {{ item.amount.commission }}
                                </div>
                                <div class="status-active"
                                     v-if="item.status === 5">
                                    <a @click="onPopup(item.id, 1 )">
                                        Выплачен
                                        <i class="fa fa-info-circle icon-info-status" aria-hidden="true"></i>

                                    </a>
                                </div>
                                <div class="status-active"
                                     v-if="item.status === 3">
                                    <a @click.prevent="onPopup(item.id,1)">

                                        Активирован
                                    </a>
                                </div>
                                <div class="status-free"
                                     v-if="item.status === 1">
                                    <a>
                                        <!--@click.prevent="onPopup(item.id,item.status)">-->
                                        Свободный
                                    </a>
                                </div>
                                <div class="status-paid"
                                     v-if="item.status === 2">
                                    <a @click.prevent="onPopup(item.id,1)">
                                        Продан
                                    </a>
                                    <i class="fa fa-info-circle icon-info-status" aria-hidden="true"></i>
                                </div>

                            </div>
                        </div>

                        <div class="blockform active hidden-popup"
                             :id="'sale'+item.id"
                             v-if="item.status == 2 || item.status == 3 || item.status == 5">
                            <div v-if="item.comment.investor">
                                <div class="form-inline">
                                    <div class="comment-block">
                                        <div class="comment-item comment-pay-info">
                                            <div class="comment-text">
                                                {{item.comment.investor}}
                                            </div>
                                        </div>
                                    </div>
                                    <a class="close"
                                       @click="closePopup('sale'+item.id)">
                                    </a>
                                </div>
                            </div>
                            <div v-else>
                                    <span v-if="createErrors.coupon == true" class="coupon-error">
                                    Не выбрано свободного купона или выбрано уже выплаченный. Посмотрите статус купонa.<br>
                                </span>
                                <span v-if="createErrors.comment_investor"
                                      class="coupon-error">
                                    {{createErrors.comment_investor[0]}}<br>
                                </span>
                                <span v-if="createErrors.id"
                                      class="coupon-error">
                                      {{createErrors.id[0]}}<br>
                                </span>
                                <div class="form-inline">
                                    <input type="text"
                                           v-model="data.comment_investor"
                                           :id="'sale-form'+item.id"
                                           placeholder="Комментарий">
                                    <a class="btn-grey"
                                       @click="sellOne(item.id)">
                                        Выплатить
                                    </a>
                                    <a class="close"
                                       @click="closePopup('sale'+item.id)">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!--<div class="blockform paid hidden-popup"
                             :id="'comment'+item.id"
                             v-if="item.status == 2">
                            <div class="form-inline">
                                <div class="comment-block">
                                    <div class="comment-item comment-pay-info"
                                         v-if="item.date.sale">
                                        <div class="comment-info comment-date">
                                            {{editDate(item.date.sale)}}
                                        </div>
                                        <div class="comment-text">
                                            {{item.comment.investor}}
                                        </div>
                                    </div>
                                </div>
                                <a class="close"
                                   @click="closePopup('comment'+item.id)">
                                </a>
                            </div>
                        </div>-->

                        <div class="blockform active hidden-popup"
                             :id="'active'+item.id"
                             v-if="item.status == 3">
                            <span class="coupon-error"
                                  v-if="createErrors.coupon == true">
                                  Не выбрано свободного купона или выбрано уже выплаченный. Посмотрите статус купонa.<br>
                            </span>
                            <span v-if="createErrors.comment_investor"
                                  class="coupon-error">
                                {{createErrors.comment_investor[0]}}<br>
                            </span>
                            <span v-if="createErrors.id"
                                  class="coupon-error">
                                  {{createErrors.id[0]}}<br>
                            </span>
                            <div class="form-inline">
                                <input type="text"
                                       v-model="data.comment_investor"
                                       :id="'comment-form'+item.id"
                                       placeholder="Комментарий">
                                <a class="btn-grey"
                                   @click="commentSave(item.id)">
                                    Выплатить
                                </a>
                                <a class="close"
                                   @click="closePopup('active'+item.id)">
                                </a>
                            </div>
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
                            <span class="text-bold">{{ checkedCoupons.length }}</span>
                            из
                            <span class="text-bold">{{filteredList.length}}</span>
                        </div>
                        <div class="button-block">
                            <a class="btn-grey" @click="anull(checkedCoupons)">
                                Анулировать
                            </a>
                            <a class="btn-grey" @click="sellPopup">
                                Выплатить
                            </a>
                            <a class="btn-grey" @click="delCoupon(checkedCoupons)">
                                Удалить
                            </a>
                        </div>
                    </div>
                    <div id="sale" class="blockform blockform-error hidden-popup">
                        <span v-if="this.createErrors.coupon == true"
                              class="coupon-error">
                          Не выбрано свободного купона или выбрано уже выплаченный. Посмотрите статус купонов.<br>
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

                </div>
                <div class="invitegroupe">
                    <ul class="pagination" v-if="itemsPerPage < resultCount">
                        <li class="page-item" v-for="pageNumber in totalPages">
                            <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#"
                               v-bind:key="pageNumber"
                               @click.prevent="setPage(pageNumber)">{{pageNumber}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import {en, ru} from 'vuejs-datepicker/dist/locale'

    export default {
        components: {
            Datepicker
        },
        data() {
            return {
                searchTitle: '',
                searchDate: '',
                list: [],
                filteredList: [],
                selectedDate: null,
                lang: ru,
                checkedCoupons: [],
                currentPage: 1,
                itemsPerPage: 10,
                resultCount: 0,
                checkedAll: 'true',
                data: {
                    id: '',
                    comment_investor: ''
                },
                createErrors: {
                    comment_investor: '',
                    id: '',
                    coupon: false
                },
                createErrorsTop: {
                    coupon: false
                },
                serverError: false,
                sellArray: {
                    comment_investor: '',
                    id: []
                },
                comment: {},
                sortDateType: '',
                sortNameType: '',
            }
        },
        computed: {
            totalPages: function () {
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },
        },
        watch: {
            sortNameType: function () {
                if (this.sortNameType == 'a') {
                    this.list = this.list.sort((a, b) => a['student_surname'].localeCompare(b['student_surname']))
                }
                if (this.sortNameType == 'z') {
                    this.list = this.list.sort((a, b) => a['student_surname'].localeCompare(b['student_surname'])).reverse()
                }
            },
            sortDateType: function () {
                if (this.sortDateType == 'asc') {
                    this.list = this.list.sort((a, b) => a['generate'].localeCompare(b['generate']))
                }
                if (this.sortDateType == 'desc') {
                    this.list = this.list.sort((a, b) => a['generate'].localeCompare(b['generate'])).reverse()
                }
            },
        },
        methods: {
            filterByTitle: function () {
                this.filteredList = this.list.filter(item => {
                    return item.name.toLowerCase().includes(this.searchTitle.toLowerCase())
                })
                if (this.searchTitle.length <= 0) this.filteredList = this.list
            },
            filterByDate: function (val) {
                let day = val.getDate()
                if (day < 10) day = '0' + day
                let month = 1 + val.getMonth()
                if (month < 10) month = '0' + month
                this.searchDate = val.getFullYear() + '-' + month + '-' + day
                this.filteredList = this.list.filter(item => {
                    return item.date.generation.includes(this.searchDate)
                })
                if (this.searchDate.length <= 0) this.filteredList = this.list

            },
            sortName: function () {
                if (this.sortNameType == 'a') {
                    console.log(this.sortNameType)
                }
                if (this.sortNameType == 'z') {
                    console.log(this.sortNameType)
                }
            },
            sortDate: function () {

            },
            paginate(data) {
                if (!data || data.length != data.length) {
                    return
                }
                this.resultCount = data.length
                if (this.currentPage >= this.totalPages) {
                    this.currentPage = this.totalPages
                }
                if (this.currentPage <= 0) {
                    this.currentPage = 1
                }
                let index = this.currentPage * this.itemsPerPage - this.itemsPerPage
                return data.slice(index, index + this.itemsPerPage)
            },
            setPage(pageNumber) {
                this.currentPage = pageNumber
            },
            pagination() {
                return this.paginate(this.filteredList);
            },
            onPopup: function (id, status) {
                switch (status) {
                    case 1:
                        document.getElementById('sale' + id).classList.remove('hidden-popup')
                        break
                    case 2:
                        document.getElementById('comment' + id).classList.remove('hidden-popup')
                        break
                    case 3:
                        document.getElementById('active' + id).classList.remove('hidden-popup')
                        break
                }
            },
            closePopup: function (id) {
                window.document.getElementById(id).classList.add('hidden-popup')
            },
            editDate(date) {
                if (date) {
                    var dateTemp = date.split('-')
                    date = dateTemp['2'] + '.' + dateTemp['1'] + '.' + dateTemp['0']
                    return date
                }
                return false

            },
            commentSave(coupon) {
                this.comment.comment_investor = document.getElementById('comment-form' + coupon).value
                this.comment.id = []
                this.comment.id.push(coupon)
                this.$http.post('/investor/coupons/comment', this.comment).then(res => {
                    if (res.status === 201) {
                        window.location.reload(true)
                    }
                }, err => {
                    if (+err.status === 422) {
                        this.createErrors = err.data['errors']
                    }
                })
            },
            sellOne(coupon) {
                this.sellArray.comment_investor = document.getElementById('sale-form' + coupon).value
                this.sellArray.id = []
                this.sellArray.id.push(coupon)
                console.log(this.sellArray)
                this.$http.post('/investor/coupons/sell', this.sellArray).then(res => {
                    if (res.status === 201) {
                        if (res.data.count === 0) {
                            this.createErrors.coupon = true
                        }
                        else {
                            window.location.reload(true)
                        }
                    }
                }, err => {
                    if (+err.status === 422) {
                        console.log(err.data['errors'])
                        this.serverError = true
                        this.createErrors = err.data['errors']
                    }
                })
            },
            sellPopup() {
                document.getElementById('sale').classList.remove('hidden-popup')
            },
            checkedCouponsAll(status) {
                let checked = this.filteredList.map(function (item) {
                    return item.id
                })
                if (status == 'true') {
                    this.checkedCoupons = checked
                }
                else {
                    this.checkedCoupons = []
                }
            },
            anull(coupons) {
                this.data.id = coupons
                this.$http.post('/investor/coupons/canceled', this.data).then(res => {
                    if (res.status === 201) {
                        window.location.reload(true)
                    }
                }, err => {
                    if (+err.status === 422) {
                        this.createErrors = err.data['errors']
                    }
                })
            },
            sell(id) {
                this.createErrors.comment_investor = ''
                this.createErrors.id = ''
                this.data.id = id
                console.log(this.data, this.createErrors.comment_investor, this.createErrors.id)
                this.$http.post('/investor/coupons/sell', this.data).then(res => {
                    if (res.status === 201) {
                        if (res.data.count === 0) {
                            this.createErrors.coupon = true
                        }
                        else {
                            // console.log(res.data)
                            window.location.reload(true)
                        }
                    }
                }, err => {
                    if (+err.status === 422) {

                        this.serverError = true
                        this.createErrors = err.data['errors']
                    }
                })
            },
            delCoupon: function (coupons) {
                this.serverError = false
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
        created() {
            window.axios.get('/investor/coupons/list')
                .then((response) => {
                    this.list = response.data.data
                    this.filteredList = response.data.data
                })
        },
        mounted() {
            let vm = this
            $('#page ').selectric({
                onChange: function (element) {
                    vm.itemsPerPage = Number($(element).val())
                },
            })
            $('#sortName').selectric({
                onChange: function (element) {
                    vm.sortNameType = $(element).val()
                },
            })
            $('#sortDate').selectric({
                onChange: function (element) {
                    vm.sortDateType = $(element).val()
                },
            })
        },
    }
</script>
<style>
    .inner-main-content .container .autoschool-coupons .table-coupon .line div.hidden-popup {
        display: none;
    }

    .inner-main-content .container .autoschool-coupons .table-coupon .hidden-popup {
        display: none;
    }

    .coupon-error {
        color: red;
    }

    .form-error {
        border-color: red;
    }
</style>