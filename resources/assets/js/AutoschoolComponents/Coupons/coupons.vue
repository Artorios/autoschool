<template>
    <div class="coupon-table">
        <div class="table-wrapper">
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
            <div v-for="coupon in coupons" >
                <div class="line" :class="{active: coupon.status == 3, free: coupon.status == 1, paid: coupon.status == 2}" >
                    <div class="coupons-cheskbox">
                        <input type="checkbox" :value="coupon.id"  v-model="checkedCoupons"></div>
                    <div class="number" v-if="coupon.id<10">0{{coupon.id}}</div>
                    <div class="number" v-else>{{coupon.id}}</div>
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

                    <div class="city" v-if="!coupon.school.filial_name">Центральный {{coupon.school.city_id}}</div>
                    <div class="city" v-else>{{coupon.school.filial_name}} {{coupon.school.city_name}}</div>


                    <div class="city" ><div v-if="coupon.user">{{coupon.user.group_name}}</div></div>

                    <div class="generate-date">
                        <a href="#">{{editDate(coupon.generation_date)}}</a>
                    </div>
                    <div class="activate-date" >
                        <a href="#" v-if="coupon.activation_date">{{editDate(coupon.activation_date)}}</a>
                    </div>
                    <div class="status">
                        <div class="status-fee">{{coupon.commission}}</div>
                        <div class="status-free"   v-if="coupon.status == 1"><a href="#">Свободный</a></div>
                        <div class="status-paid"   v-else-if="coupon.status == 2"><a href="#">Выплачен</a>
                            <img src="/img/attention.png"  alt="">
                        </div>
                        <div class="status-active" v-else-if="coupon.status == 3"><a href="#">Активирован</a></div>
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
                    <div>
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
                        <div class="city" v-else>Филиал {{coupon.school.filial_name}} {{coupon.school.city_id}}</div>

                        <div class="city" ><div v-if="coupon.user">Група {{coupon.user.group_name}}</div></div>

                        <div class="generate-date">
                            <a href="#">Дата генерации {{editDate(coupon.generation_date)}}</a>
                        </div>
                        <div class="activate-date" >
                            <a href="#" v-if="coupon.activation_date">Дата активации {{editDate(coupon.activation_date)}}</a>
                        </div>
                        <div class="status-fee"><span>Комиссия </span> <span style="font-weight: bold">{{coupon.commission}}</span></div>
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
                <div class="blockform paid" :id="'block'+coupon.id"  v-if="coupon.status == 2">
                    <div class="form-inline">
                        <div class="date" v-if="coupon.sale_date">
                            {{editDate(coupon.sale_date)}}
                        </div>
                        <div>
                            Выплата комисии
                        </div>
                        <div class="info" v-if="coupon.comment_director"> {{coupon.comment_director}}</div>

                        <a data-toggle="collapse" :data-target="'#block'+coupon.id" class="close"></a>
                    </div>
                </div>
                <div class="blockform active" :id="'block'+coupon.id" v-if="coupon.status == 3">
                    <div class="form-inline">
                        <input type="text"  placeholder="Комментарий">
                        <a  class="btn-grey">Выплатить</a>
                        <a data-toggle="collapse" :data-target="'#block'+coupon.id" class="close"></a>
                    </div>
                </div>
            </div>

{{ checkedCoupons.length }}

        </div>
        <ul class="pagination" v-if="itemsPerPage < resultCount">
            <li class="page-item" v-for="pageNumber in totalPages">
                <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber" @click="setPage(pageNumber)">{{pageNumber}}</a>
            </li>
        </ul>
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
            }
        },
        props: ['coupons'],
        computed: {

            paginate: function(){
                if (!this.lessons || this.coupons.length != this.coupons.length){
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
        }
    }
</script>

