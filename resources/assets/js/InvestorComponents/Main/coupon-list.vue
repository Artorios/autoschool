<template>
    <div>
        <div class="blockgroupe" v-if="list.length">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="" id="" class="select">
                            <option value="all">Все(25)</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <a class="btn-grey w-100 no-margin" href="/investor/coupons/create">Генерация купонов</a>
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
                                <input type="text"
                                        placeholder="Введите что искать"
                                        v-model="searchTitle"
                                        v-on:keyup="filterByTitle">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <select class="select">
                                <option selected disabled>ФИО ученика</option>
                                <option>Петров В.В.</option>
                                <option>Сидоров Г.А.</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <select v-model="searchDate"
                                    @change="filterByDate"
                                    id="date" class="select">
                                <option selected disabled>дата</option>
                                <option v-for="item in list">{{ item.updated_at }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <div class="data">
                                <v-date-picker
                                        :min-date='new Date()'
                                        v-model='selectedDate'>
                                </v-date-picker>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="coupon-table">
                <div class="table-wrapper">
                    <div class="title-line line">
                        <span class="line-item coupons-checkbox"></span>
                        <span class="line-item number">№</span>
                        <span class="line-item coupon">Купон</span>
                        <span class="line-item autoschool">Автошкола /ID</span>
                        <span class="line-item city">Филиал /Город</span>
                        <span class="line-item name-student">ФИО ученика /група</span>
                        <span class="line-item generate-date">Дата генерации</span>
                        <span class="line-item activate-date">Дата активации</span>
                        <span class="line-item price">Сумма оплаты</span>
                        <span class="line-item status">Комиссия /статус</span>
                    </div>

                    <div v-for="item in filteredList"
                            :class="[{active: item.status === 3,
                                   sale: item.status === 2,
                                   free: item.status === 1},
                                   'line']">
                        <div class="line-item coupons-checkbox">
                            <label class="label-checkbox">
                                <input type="checkbox"
                                        :value="item.id"
                                        v-model="checkedCoupons"
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
                            <div class="hidden-head-text">ФИО ученика /група</div>
                            <div class="line-item-content">
                                {{ item.student_name }}
                                Група №
                                <a href="">
                                    {{ item.group_id }}
                                </a>
                            </div>
                        </div>
                        <div class="line-item generate-date">
                            <div class="hidden-head-text">Дата генерации</div>
                            <div class="line-item-content">
                                <a href="">
                                    {{ item.date.generation }}
                                </a>
                            </div>
                        </div>
                        <div class="line-item activate-date">
                            <div class="hidden-head-text">Дата активации</div>
                            <div class="line-item-content">
                                <a href="">
                                    {{ item.date.activation }}
                                </a>
                            </div>
                        </div>
                        <div class="line-item price">
                            <div class="hidden-head-text">Сумма оплаты</div>
                            <div class="line-item-content">
                                {{ item.amount.payment }}
                            </div>
                        </div>
                        <div class="line-item status">
                            <div class="hidden-head-text">Комиссия /статус</div>
                            <div class="line-item-content">
                                <div class="status-fee">
                                    {{ item.amount.commission }}
                                </div>
                                <div class="status-active"
                                        v-if="item.status === 3">
                                    <a href="#"
                                            @click.prevent="onPopup(item.id,item.status)">
                                        Активирован
                                    </a>
                                </div>
                                <div class="status-free"
                                        v-if="item.status === 1">
                                    <a href="#"
                                            @click.prevent="onPopup(item.id,item.status)">
                                        Свободный
                                    </a>
                                </div>
                                <div class="status-paid"
                                        v-if="item.status === 2">
                                    <a href="#"
                                            @click.prevent="onPopup(item.id,item.status)">
                                        Выплачен
                                    </a>
                                    <i class="fa fa-info-circle icon-info-status" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>

                        <div class="blockform active hidden-popup"
                                :id="'sale'+item.id"
                                v-if="item.status == 1">
                            <span v-if="createErrors.coupon == true" class="coupon-error">
                                Не выбрано свободного купона<br>
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

                        <div class="blockform paid hidden-popup"
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
                                            Выплата коммисии по счету 4353463467347
                                        </div>
                                    </div>
                                    <div class="comment-item"
                                            v-if="item.comment.director">
                                        <div class="comment-info comment-autor">
                                            director
                                        </div>
                                        <div class="comment-text">
                                            {{item.comment.director}}
                                        </div>
                                    </div>
                                    <div class="comment-item"
                                            v-if="item.comment.investor">
                                        <div class="comment-info comment-autor">
                                            investor
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
                        </div>

                        <div class="blockform active hidden-popup"
                                :id="'active'+item.id"
                                v-if="item.status == 3">
                            <span class="coupon-error"
                                    v-if="createErrors.coupon == true">
                                  Не выбрано свободного купона<br>
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
                                <div class="comment-block">
                                    <div v-if="item.comment.coupon"
                                            class="comment-item">
                                        <div class="comment-info comment-date">
                                            {{item.comment.coupon}}
                                        </div>
                                        <div class="comment-text">
                                            Выплата коммисии по счету 4353463467347
                                        </div>
                                    </div>
                                </div>
                                <a class="close"
                                        @click="closePopup('active'+item.id)">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="blockform blockform-bottom active">
                        <div class="form-inline">
                            <div class="info">
                                <label class="label-checkbox">
                                    <input type="checkbox"
                                            true-value="false"
                                            false-value="true"
                                            v-model="checkedAll"
                                            @click="checkedCouponsAll(checkedAll)"
                                            class="hidden-checkbox">
                                    <span class="label-check"></span>
                                </label>
                                <div class="check-info-block">
                                    <span class="check-text">Для всех</span>
                                    <span class="check-info">
                                        Отмечено
                                        <span class="text-bold">{{ checkedCoupons.length }}</span>
                                        из
                                        <span class="text-bold">{{list.length}}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="btn-block">
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
                </div>
            </div>
        </div>
        <div v-else>
            Недостаточно данных
        </div>
    </div>
</template>

<script>
  export default {
    data () {
      return {
        searchTitle: '',
        searchDate: '',
        list: [],
        filteredList: [],
        selectedDate: '',

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
        comment: {}
      }
    },
    methods: {
      filterByTitle: function () {
        this.filteredList = this.list.filter(item => {
          return item.autoschool.title.toLowerCase().includes(this.searchTitle.toLowerCase())
        })
        if (this.searchTitle.length <= 0) this.filteredList = this.list
      },
      filterByDate: function () {
        this.filteredList = this.list.filter(item => {
          return item.updated_at.toLowerCase().includes(this.searchDate.toLowerCase())
        })
        if (this.searchDate.length <= 0) this.filteredList = this.list
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
      editDate (date) {
        if (date) {
          var dateTemp = date.split('-')
          date = dateTemp['2'] + '.' + dateTemp['1'] + '.' + dateTemp['0']
          return date
        }
        return false

      },
      commentSave (coupon) {
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
      sellOne (coupon) {
        this.sellArray.comment_investor = document.getElementById('sale-form' + coupon).value
        this.sellArray.id.push(coupon)
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
            this.serverError = true
            this.createErrors = err.data['errors']
          }
        })
      },
      sellPopup () {
        document.getElementById('sale').classList.remove('hidden-popup')
      },
      checkedCouponsAll (status) {
        let checked = this.list.map(function (item) {
          return item.id
        })
        if (status == 'true') {
          this.checkedCoupons = checked
        }
        else {
          this.checkedCoupons = []
        }
      },
      anull (coupons) {
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
      sell (id) {
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
      //todo
      delCoupon: function (id, status) {
        console.log(id, status)
      }
    },
    created () {
      window.axios.get('/investor/coupons/list')
        .then((response) => {
          this.list = response.data.data
          this.filteredList = response.data.data

        })
    },
    updated () {
      (function ($) {
        $('.select').selectric()
      })(jQuery)
    }
  }
</script>
<style>
    .inner-main-content .container .autoschool-coupons .table-wrapper .line div.hidden-popup {
        display: none;
    }

    .inner-main-content .container .autoschool-coupons .table-wrapper .hidden-popup {
        display: none;
    }

    .coupon-error {
        color: red;
    }

    .form-error {
        border-color: red;
    }
</style>