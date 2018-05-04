<template>
    <div class="blockgroupe">
<!--
        <div class="search-form blockforms finance">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="search">
                            <input type="text" placeholder="Введите что искать">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="select">
                            <option selected disabled>ФИО ученика</option>
                            <option>Петров В.В.</option>
                            <option>Сидоров Г.А.</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="select">
                            <option selected disabled>По дате</option>
                            <option>21.01.15</option>
                            <option>22.01.15</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="data">
                            <input type="text" placeholder="Дата">
                        </div>
                    </div>
                </div>
            </div>
        </div>
-->


    <div class="coupon-table">
        <div class="table-wrapper autoschool-student profile" >
            <div class="title-line">
                <span class="number">№</span>
                <span class="coupon">Купон</span>
                <span class="name-student">ФИО ученика</span>
                <span class="city">Филиал /Город</span>
                <span class="price">Група</span>
                <span class="generate-date">Дата генерации</span>
                <span class="activate-date">Дата активации</span>
                <span class="status">Комиссия /статус</span>
            </div>
            <div v-for="coupon in paginate" >
                <div class="line" :class="{active: coupon.status == 3, free: coupon.status == 1, paid: coupon.status == 2}" >
                    <div class="coupons-cheskbox">
                        <input type="checkbox" :value="coupon.id"  v-model="checkedCoupons"></div>
                    <div class="number" v-if="coupon.id<10">0{{coupon.id}}</div>
                    <div class="number" v-else>{{coupon.id}}</div>
                    <div @click="onPopup(coupon.id,coupon.status)">
                        <div class="coupon"><a href="#">{{coupon.name}}</a></div>

                        <div class="name-student" v-if="coupon.status === 2">
                            {{coupon.user.last_name}} {{coupon.user.name.toString()[0].toUpperCase()}}. <div v-if="coupon.user.second_name">{{coupon.user.second_name.toString()[0].toUpperCase()}}.</div>

                        </div>
                        <div class="name-student" v-else-if="coupon.status === 3">
                            {{coupon.user.last_name}} {{coupon.user.name.toString()[0].toUpperCase()}}.
                            <div v-if="coupon.user.second_name">{{coupon.user.second_name.toString()[0].toUpperCase()}}.</div>
                        </div>
                        <div class="name-student" v-else>
                        </div>

                        <div class="city" v-if="!coupon.school.filial_name">Центральный {{coupon.school.city_name}}</div>
                        <div class="city" v-else>{{coupon.school.filial_name}} {{coupon.school.city_name}}</div>


                        <div class="price" ><div v-if="coupon.group">{{coupon.group.name}}</div>
                        <div class="price" v-else></div></div>

                        <div class="generate-date">
                            <a href="#">{{editDate(coupon.generation_date)}}</a>
                        </div>
                        <div class="activate-date" >
                            <a href="#" v-if="coupon.status == 3">{{editDate(coupon.activated_at)}}</a>
                        </div>
                        <div class="status">
                            <div class="status-fee">{{coupon.commision_amount}}</div>
                            <div class="status-free"   v-if="coupon.status == 1"><a href="#">Свободный</a></div>
                            <div class="status-paid"   v-else-if="coupon.status == 2"><a href="#">Выплачен</a>
                                <img src="/img/attention.png"  alt="">
                            </div>
                            <div class="status-active" v-else-if="coupon.status == 3"><a href="#">Активирован</a></div>
                        </div>
                    </div>

                </div>
                <div class="block-media-768" :class="{active: coupon.status == 3, free: coupon.status == 1, paid: coupon.status == 2}" >
                    <div>
                        <div class="coupons-checkbox">
                            <input type="checkbox" :value="coupon.id"  v-model="checkedCoupons"></div>
                    </div>
                    <div>
                        <div class="number" v-if="coupon.id<10">0{{coupon.id}}</div>
                        <div class="number" v-else>{{coupon.id}}</div>
                    </div>
                    <div @click="onPopup(coupon.id,coupon.status)">
                        <div class="coupon"><a href="#">Купон {{coupon.name}}</a></div>
                        <div class="name-student" v-if="coupon.status === 2">
                            {{coupon.user.last_name}} {{coupon.user.name.toString()[0].toUpperCase()}}. <span v-if="coupon.user.second_name" >{{coupon.user.second_name.toString()[0].toUpperCase()}}.</span>
                            </a>
                        </div>
                        <div class="name-student" v-else-if="coupon.status === 3">
                            {{coupon.user.last_name}} {{coupon.user.name.toString()[0].toUpperCase()}}. <span v-if="coupon.user.second_name">{{coupon.user.second_name.toString()[0].toUpperCase()}}.</span>
                        </div>
                        <div class="name-student" v-else></div>

                        <div class="city" v-if="!coupon.school.filial_name">Филиал Центральный {{coupon.school.city_name}}</div>
                        <div class="city" v-else>Филиал {{coupon.school.filial_name}} {{coupon.school.city_name}}</div>

                        <div class="city" ><div v-if="coupon.group">Група {{coupon.group.name}}</div></div>

                        <div class="generate-date">
                            <a href="#">Дата генерации {{editDate(coupon.generation_date)}}</a>
                        </div>
                        <div class="activate-date" >
                            <a href="#" v-if=" coupon.status == 3">Дата активации {{editDate(coupon.activated_at)}}</a>
                        </div>
                        <div class="status-fee"><span>Комиссия </span> <span style="font-weight: bold">{{coupon.commision_amount}}</span></div>
                        <div class="status">
                            <span>Статус</span>
                            <div class="status-free"   v-if="coupon.status == 1"><a href="#">Свободный</a></div>
                            <div class="status-paid"   v-else-if="coupon.status == 2"><a href="#">Выплачен</a>
                                <img src="/img/attention.png" alt="">
                            </div>
                            <div class="status-active" v-else-if="coupon.status == 3"><a href="#">Активирован</a></div>

                        </div>
                    </div>
                </div>
                <div class="blockform paid hidden-comment"  :id="'comment'+coupon.id"  v-if="coupon.status == 2">
                    <div class="form-inline">
                        <div class="date" v-if="coupon.sale_date">
                            {{editDate(coupon.sale_date)}}
                        </div>
                        <div>
                            Выплата комисии
                        </div>
                        <div class="info" v-if="coupon.comment_director"> {{coupon.comment_director}}</div>

                        <a  class="close" @click="this.document.getElementById('comment'+coupon.id).classList.add('hidden-comment')"></a>
                    </div>
                </div>
                <div class="blockform active hidden-sale"  :id="'sale'+coupon.id" v-if="coupon.status == 1">
                    <div class="form-inline">
                        <input type="text" :id="'sale-form'+coupon.id" placeholder="Комментарий">
                        <a  class="btn-grey" @click="sellOne(coupon.id)">Выплатить</a>
                        <a  class="close" @click="this.document.getElementById('sale'+coupon.id).classList.add('hidden-sale')"></a>
                    </div>
                </div>
                <div class="blockform active hidden-active"  :id="'active'+coupon.id" v-if="coupon.status == 3">
                    <div class="form-inline">
                        <input type="text"  placeholder="Комментарий">
                        <a  class="btn-grey">Сохранить</a>
                        <a  class="close" @click="this.document.getElementById('active'+coupon.id).classList.add('hidden-active')"></a>
                    </div>
                </div>
            </div>



        </div>
        <ul class="pagination" v-if="itemsPerPage < resultCount">
            <li class="page-item" v-for="pageNumber in totalPages">
                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber" @click="setPage(pageNumber)">{{pageNumber}}</a>
            </li>
        </ul>
        <br>
        <div class="blockform paid active">
            <div class="form-inline">
                    <input type="checkbox" style="width: 12px"  true-value="false" false-value="true"  v-model="checkedAll" @click="checkedCouponsAll(checkedAll)">
            <div class="info">Отмечено {{ checkedCoupons.length }} из {{coupons.length}}</div>
                <a  class="btn-grey" @click="">Анулировать</a>
                <a  class="btn-grey" @click="sellPopup">Продать</a>
            </div>
        </div>

        <div class="hidden-sale" id="sale">
            <span v-if="this.createErrors.coupon == true" class="coupon-error">Не выбрано свободного купона<br></span>

            <span v-if="this.createErrors.comment_director" class="coupon-error">{{this.createErrors.comment_director[0]}} <br></span>

            <span v-if="this.createErrors.id" class="coupon-error">{{this.createErrors.id[0]}}<br></span>
            <div class="blockform active "   >

                <div class="form-inline">
                    <input type="text" v-model="data.comment_director"  placeholder="Комментарий">
                    <a  class="btn-grey" @click="sell(checkedCoupons)">Выплатить</a>
                    <a  class="close" @click="this.document.getElementById('sale').classList.add('hidden-sale')"></a>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script type="text/babel">
    export default {
        data () {
            return {
                checkedCoupons: [],
                currentPage: 1,
                itemsPerPage: 10,
                resultCount: 0,
                checkedAll: 'true',
                data: {
                    comment_director: ''
                },
                createErrors: {
                    comment_director: '',
                    id: '',
                    coupon: false
                },
                sellArray: {
                    comment_director: '',
                    id: []
                },
                comment: {}
            }
        },
        props: ['coupons'],
        computed: {

            paginate: function(){
                if (!this.coupons || this.coupons.length != this.coupons.length){
                    return
                }
                this.resultCount = this.coupons.length
                if(this.currentPage >= this.totalPages){
                    this.currentPage = this.totalPages
                }

                let index = this.currentPage * this.itemsPerPage - this.itemsPerPage

                return this.coupons.slice(index, index + this.itemsPerPage)
            },
            totalPages: function(){
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },
        },
        methods: {
            setPage(pageNumber){
                this.currentPage = pageNumber
            },
            editDate(date){
                if(date){
                    var dateTemp = date.split('-')
                    date = dateTemp['2'] + '.' + dateTemp['1'] + '.' + dateTemp['0']
                    return date
                }
                return false

            },
            checkedCouponsAll(status){
                let checked = this.coupons.map(function (coupon) {
                    return coupon.id
                })
                if(status == 'true'){
                    this.checkedCoupons = checked
                }
                else {
                    this.checkedCoupons = []
                }


            },
            onPopup(id,status){
                switch (status){

                    case 1:
                        document.getElementById('sale'+id).classList.remove('hidden-sale')
                        break;
                    case 2:
                        document.getElementById('comment'+id).classList.remove('hidden-comment')
                        break;
                    case 3:
                        document.getElementById('active'+id).classList.remove('hidden-active')
                        break;
                }
            },

            sellPopup(){
                document.getElementById('sale').classList.remove('hidden-sale')

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
            sellOne(coupon){
                this.sellArray.comment_director = document.getElementById('sale-form'+coupon).value
                this.sellArray.id.push(coupon)
                console.log(this.sellArray)
            }


        }
    }
</script>
<style>
    .hidden-sale{
        display: none;
    }
    .hidden-active
    {
        display: none;
    }
    .hidden-comment {
        display: none;
    }
    .coupon-error{
        color:red;
    }
    .form-error{
        border-color: red;
    }
</style>
