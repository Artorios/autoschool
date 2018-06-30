<template>
    <div class="blockgroupe">

        <div :class="totalPages > 0 ? '' : 'hidden'">
            <h2>Список автошкол:</h2>
            <div class="table-block table-schools-list">
                <div class="table-head">
                    <div class="table-head-item number-item">№</div>
                    <div class="table-head-item id-item">Автошкола/ID</div>
                    <div class="table-head-item filial-item">Филиал</div>
                    <div class="table-head-item city-item">Город</div>
                    <div class="table-head-item coupon-item">Купоны активные/неактивные/всего</div>
                    <div class="table-head-item commission-item">Комиссия</div>
                    <div class="table-head-item sum-item">К оплате</div>
                </div>
                <div class="table-item-row"
                     v-for="(school, index) in paginate"
                     :data-id="number + index">
                    <div class="table-item number-item">
                        <div class="table-head-item hidden-head-text">№</div>
                        <div class="table-item-content">
                            {{ number + index }}
                        </div>

                    </div>
                    <div class="table-item id-item">
                        <div class="table-head-item hidden-head-text">Автошкола/ID</div>
                        <div class="table-item-content">
                            <a :href="'/investor/school/' + school.id"
                               class="school-name table-item-link text-underline">{{ school.title }}</a>
                            <span class="school-id table-item-text">/ ID {{ school.id }}</span>
                        </div>

                    </div>
                    <div class="table-item filial-item">
                        <div class="table-head-item hidden-head-text">Филиал</div>
                        <div class="table-item-content">
                            -
                        </div>

                    </div>
                    <div class="table-item city-item">
                        <div class="table-head-item hidden-head-text">Город</div>
                        <div class="table-item-content">
                            {{ school.city.name }}
                        </div>

                    </div>
                    <div class="table-item coupon-item">
                        <div class="table-head-item hidden-head-text">Купоны активные/неактивные/всего</div>
                        <div class="table-item-content">
                            <a class="coupon coupon-active table-item-link" href="javascript:">{{school.coupons_active}}</a>
                            /
                            <a class="coupon coupon-active table-item-link" href="javascript:">{{school.coupons_passive}}</a>
                            /
                            <a class="coupon coupon-active table-item-link" href="javascript:">{{school.coupons_active + school.coupons_passive}}</a>
                        </div>

                    </div>
                    <div class="table-item commission-item">
                        <div class="table-head-item hidden-head-text">Комиссия</div>
                        <div class="table-item-content">
                            <span class="text-bold">{{school.fee_all}}</span>
                        </div>

                    </div>
                    <div class="table-item sum-item">
                        <div class="table-head-item hidden-head-text">К оплате</div>
                        <div class="table-item-content">
                            <a class="table-item-link text-bold" @click="pay_show(school.id)">{{school.fee_pay}}</a>
                        </div>

                    </div>
                    <div :id="school.id" style="display: none;" class="blockform blockform-error hidden-popup">
                        <span class="coupon-error" v-if="createErrors.auto_school_id">
                            {{createErrors.auto_school_id[0]}}
                            <br>
                        </span>

                        <div class="form-inline">
                            <span class="coupon-error" v-if="createErrors.comment">
                                {{createErrors.comment[0]}}
                                <br>
                            </span>
                            <input type="text"
                                   v-model="comment"
                                   placeholder="Комментарий">
                            <span class="coupon-error" v-if="createErrors.summ">
                                {{createErrors.summ[0]}}
                                <br>
                            </span>
                            <input type="text"
                                   v-model="summ"
                                   placeholder="Сумма">
                            <a class="btn-grey"
                               @click="pay(school.id)">
                                Выплатить
                            </a>
                            <a class="close" @click="closePopup(school.id)"></a>
                        </div>
                    </div>
                </div>

            </div>

            <ul class="pagination" v-if="itemsPerPage < resultCount">
                <li class="page-item" v-for="pageNumber in totalPages">
                    <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber"
                       @click="setPage(pageNumber)">{{pageNumber}}</a>
                </li>
            </ul>
        </div>

        <div class="row" :class="totalPages === 0 ? '' : 'hidden'">
            <h3 class="text-center">У вас нет ни одной автошколы на данный момент.</h3>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                currentPage: 1,
                itemsPerPage: 10,
                resultCount: 0,
                number: 1,
                comment: '',
                summ: 0,
                createErrors: '',
                post: {
                    auto_school_id: '',
                    comment: '',
                    summ: '',

                },
            }
        },
        props: ['schools'],
        computed: {
            totalPages: function () {
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },
            paginate: function () {
                this.number = 1;
                if (this.schools) {
                    this.resultCount = this.schools.length;
                    if (this.currentPage >= this.totalPages) {
                        this.currentPage = this.totalPages
                    }
                    let index = this.currentPage * this.itemsPerPage - this.itemsPerPage;
                    this.number += index;
                    return this.schools.slice(index, index + this.itemsPerPage)
                }
            }
        },
        methods: {
            setPage(pageNumber) {
                this.currentPage = pageNumber
            },
            pay_show(id) {
                $('#' + id).show();
            },
            closePopup(id) {
                $('#' + id).hide();
            },
            pay(id) {
                this.post.auto_school_id = id
                this.post.comment = this.comment
                this.post.summ = this.summ

                this.$http.post('/investor/fee-pay', this.post).then(res => {
                    if (res.status === 201) {
                        window.location.reload(true)
                    }
                }, err => {
                    if (+err.status === 422) {
                        this.createErrors = err.data['errors']
                    }
                })
            },

        }
    }
</script>
