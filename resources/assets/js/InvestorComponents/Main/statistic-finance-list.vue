<template>
    <div>
        <div class="blockgroupe">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select v-model="itemsPerPage" class="select">
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
                            <select class="select sort">
                                <option selected disabled>Названия Автошколы</option>
                                <option value="acs">От А-Я</option>
                                <option value="desc">От Я-А</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <select class="select sort">
                                <option selected disabled>По дате</option>
                                <option value="data-acs">От начала</option>
                                <option value="data-desc">От конца</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <div class="data">
                                <v-date-picker
                                        v-model='selectedDate'>
                                </v-date-picker>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="coupon-table" v-if="list.length">
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
                     v-for="(item, index) in pagination()"
                    :class="[{active: item.status === 3,
                        sale: item.status === 2,
                        free: item.status === 1},
                        'line']">
                    <div class="table-item checkbox-item">
                        <label class="label-checkbox">
                            <input type="checkbox"
                                   :value="item.CouponID"
                                   v-model="checkedCoupons"
                                   class="hidden-checkbox">
                            <span class="label-check"></span>
                        </label>
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
                            <a href="#" class="school-name table-item-link text-underline">{{ item.AutoSchoolTitle }}</a>
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
                            <span class="text-bold">{{ item.amount }}</span>
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
                            <a href="javascript:"
                               class="table-item-link status"
                               @click.prevent="onPopup(item.CouponID,item.status)"
                               v-text="getstatus(item)">

                            </a>
                        </div>
                    </div>

                    <div class="blockform active hidden-popup"
                                :id="'sale'+ item.CouponID"
                                v-if="item.status == 1">
                            <span v-if="createErrors.coupon == true" class="coupon-error">
                                Не выбрано свободного купона<br>
                            </span>
                            <span v-if="createErrors.comment_investor"
                                    class="coupon-error">
                                {{createErrors.comment_investor[0]}}<br>
                            </span>
                            <span v-if="createErrors.CouponID"
                                    class="coupon-error">
                                  {{createErrors.id[0]}}<br>
                            </span>
                            <div class="form-inline">
                                <input type="text"
                                        v-model="data.comment_investor"
                                        :id="'sale-form'+item.CouponID"
                                        placeholder="Комментарий">
                                <a class="btn-grey"
                                        @click="sellOne(item.CouponID)">
                                    Выплатить
                                </a>
                                <a class="close"
                                        @click="closePopup('sale'+item.CouponID)">
                                </a>
                            </div>
                        </div>

                    <div class="blockform paid hidden-popup"
                                :id="'comment'+ item.CouponID"
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
                                        @click="closePopup('comment'+item.CouponID)">
                                </a>
                            </div>
                        </div>

                    <div class="blockform active hidden-popup"
                                :id="'active'+item.CouponID"
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
                                        :id="'comment-form'+item.CouponID"
                                        placeholder="Комментарий">
                                <a class="btn-grey"
                                        @click="commentSave(item.CouponID)">
                                    Выплатить
                                </a>
                                <a class="close"
                                        @click="closePopup('active'+item.CouponID)">
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
                <div class="invitegroupe">
                    <ul class="pagination" v-if="itemsPerPage < resultCount">
                        <li class="page-item" v-for="pageNumber in totalPages">
                            <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber"
                               @click.prevent="setPage(pageNumber)">{{pageNumber}}</a>
                        </li>
                    </ul>
                </div>
            </div>

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
        selectedDate: Date(),

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
        selected: ''
      }
    },
    computed: {
      totalPages: function () {
          return Math.ceil(this.resultCount / this.itemsPerPage)
      },

      filterStudents() {
            if(this.searchTitle !== "") {
                return this.filterByTitle()
            }

            // if (this.selectedDate !== "") {
            //     return this.filterByDate()
            // }

            switch(this.selected) {
                case "desc":
                    return this.filterStudentByDesk('AutoSchoolTitle')
                case 'acs':
                    return this.filterStudentByASC('AutoSchoolTitle')
                case 'data-desc':
                    return this.filterStudentByDesk('DatePayment')
                case 'data-acs':
                    return this.filterStudentByASC('DatePayment')
                default:
                    return this.filterByTitle()
            }
        },

    },
    methods: {
      filterByTitle: function () {
          return this.list.filter((element) => {
              return element.AutoSchoolTitle.toLowerCase().includes(this.searchTitle
                  .toLowerCase());
          });
      },
      filterByDate: function () {
          return this.list.filter((student) => {
              if(student.DatePayment != null) {
                  return student.DatePayment.split(" ", 1)[0].toLowerCase().includes(this.selectedDate.toLowerCase());
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
            if(type_select === 'AutoSchoolTitle') {
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
            if(type_select === 'AutoSchoolTitle') {
                return this.list.sort((a, b) => a[type_select].localeCompare(b[type_select]))
            }
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
        return this.paginate(this.filterStudents);
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
        let checked = this.filteredList.map(function (item) {
          return item.CouponID
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
      delCoupon: function (coupons) {
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
    },
    created () {
      window.axios.get('/investor/finance/list')
        .then((response) => {
          this.list = response.data.data
          this.filteredList = response.data.data
        })
    },
    mounted () {
      let vm = this
      $('.select ').selectric({
          onChange: function (element) {
              vm.itemsPerPage = Number($(element).val())
          },
      });

      $('.sort').selectric({
          onChange: function (element) {
              vm.selected = $(element).val()
          },
      });
    },
  }
</script>
<style scoped>
    .hidden-popup {
        display: none;
    }

    .coupon-error {
        color: red;
    }

    .form-error {
        border-color: red;
    }
</style>