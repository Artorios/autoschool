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
                                <a :href="'/investor/school/' + school.id" class="school-name table-item-link text-underline">{{ school.title }}</a>
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
                                <a class="coupon coupon-active table-item-link" href="javascript:">{{ school.active ? school.active : 0 }}</a>
                                /
                                <a class="coupon coupon-active table-item-link" href="javascript:">{{ school.inActive ? school.inActive : 0 }}</a>
                                /
                                <a class="coupon coupon-active table-item-link" href="javascript:">{{ school.count ? school.count : 0 }}</a>
                            </div>

                        </div>
                        <div class="table-item commission-item">
                            <div class="table-head-item hidden-head-text">Комиссия</div>
                            <div class="table-item-content">
                                <span class="text-bold">-</span>
                            </div>

                        </div>
                        <div class="table-item sum-item">
                            <div class="table-head-item hidden-head-text">К оплате</div>
                            <div class="table-item-content">
                                <a class="table-item-link text-bold" href="javascript:">-</a>
                            </div>

                        </div>
                    </div>
            </div>

            <ul class="pagination" v-if="itemsPerPage < resultCount">
                <li class="page-item" v-for="pageNumber in totalPages">
                    <a :class="[{active: currentPage === pageNumber}, 'page-link']" href="#" v-bind:key="pageNumber" @click="setPage(pageNumber)">{{pageNumber}}</a>
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
                number: 1
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
            }
        }
    }
</script>
