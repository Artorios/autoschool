<template>
    <div class="blockgroupe">

        <div class="row" :class="totalPages > 0 ? '' : 'hidden'">
            <h2>Список автошкол:</h2>
            <table class="table manage-grid">
                <thead>
                <tr class="visible-md visible-lg">
                    <th>№</th>
                    <th>Автошкола/ID</th>
                    <th>Филиал</th>
                    <th>Город</th>
                    <th>Купоны активные/неактивные/всего</th>
                    <th>Комиссия</th>
                    <th>К оплате</th>
                </tr>
                </thead>
                <tbody class="main">
                <tr :data-id="number + index" class="visible-md visible-lg" v-for="(school, index) in paginate">
                    <td>{{ number + index }}</td>
                    <td><a :href="/profile-edit/" class="school-name">{{ school.title }}</a><span class="school-id">ID {{ school.id }}</span></td>
                    <td>-</td>
                    <td>{{ school.city.name }}</td>
                    <td><a class="coupon coupon-active" href="javascript:">{{ school.active ? school.active : 0 }}</a> / <a class="coupon coupon-active" href="javascript:">{{ school.inActive ? school.inActive : 0 }}</a> / <a class="coupon coupon-active" href="javascript:">{{ school.count ? school.count : 0 }}</a></td>
                    <td><span class="bold big">-</span></td>
                    <td><a class="bold big" href="javascript:"></a></td>
                </tr>
                <tr :data-id="number" class="payment-form" style="display: none">
                    <td colspan="7">
                        <form action="">
                            <div class="close hidden-md hidden-lg"></div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text">
                                    </div>
                                </div>95
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
                </tbody>
            </table>
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