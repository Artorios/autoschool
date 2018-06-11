<template>
    <div>
        <div class="blockgroupe">
            <h2>Филиалы:</h2>
            <div class="table-block table-filial">
                <div class="table-head">
                    <span class="table-head-item number-item">№</span>
                    <span class="table-head-item name-filial-item">Название филиала</span>
                    <span class="table-head-item address-filial-item">Адрес филиала</span>
                    <span class="table-head-item count-item">Кол-во учеников</span>
                    <span class="table-head-item kupons-item">Купоны активные/неактивные/всего</span>
                </div>
                <div class="table-content">
                    <div class="table-item-row">
                        <div class="table-item number-item">
                            <div class="table-head-item hidden-head-text">№</div>
                            <div class="table-item-content">
                                0
                            </div>
                        </div>
                        <div class="table-item name-filial-item">
                            <div class="table-head-item hidden-head-text">Название филиала</div>
                            <div class="table-item-content">
                                <a :href="'/autoschool/filials/new'">Нераспределённые</a>

                            </div>
                        </div>
                        <div class="table-item address-filial-item">
                            <div class="table-head-item hidden-head-text">Адрес филиала</div>
                            <div class="table-item-content">
                                <span></span>
                            </div>
                        </div>
                        <div class="table-item count-item">
                            <div class="table-head-item hidden-head-text">Кол-во учеников</div>
                            <div class="table-item-content">
                                <span></span>
                            </div>
                        </div>
                        <div class="table-item kupons-item">
                            <div class="table-head-item hidden-head-text">Купоны активные/неактивные/всего</div>
                            <div class="table-item-content">
                                <span></span>
                            </div>
                        </div>
                    </div>

                    <div class="table-item-row" v-for="filial in paginate">
                        <div class="table-item number-item">
                            <div class="table-head-item hidden-head-text">№</div>
                            <div class="table-item-content">
                                {{filial.id}}
                            </div>
                        </div>
                        <div class="table-item name-filial-item">
                            <div class="table-head-item hidden-head-text">Название филиала</div>
                            <div class="table-item-content">
                                <a :href="'/autoschool/filials/' + filial.id" class="table-item-link text-underline">
                                    {{filial.name}}
                                </a>
                            </div>
                        </div>
                        <div class="table-item address-filial-item">
                            <div class="table-head-item hidden-head-text">Адрес филиала</div>
                            <div class="table-item-content">
                                <span>{{filial.address}}</span>
                            </div>
                        </div>
                        <div class="table-item count-item">
                            <div class="table-head-item hidden-head-text">Кол-во учеников</div>
                            <div class="table-item-content">
                                <span>{{filial.student_count}}</span>
                            </div>
                        </div>
                        <div class="table-item kupons-item">
                            <div class="table-head-item hidden-head-text">Купоны активные/неактивные/всего</div>
                            <div class="table-item-content">
                                <span>24 / 34 / 50</span>
                            </div>
                        </div>
                    </div>
                </div>
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
        <button-add-filial></button-add-filial>
        <create-filial-form v-if="visible" :autoschool="autoschool"></create-filial-form>
    </div>
</template>

<script>
    import ButtonAddFilial from './button-add-filial';
    import CreateFilialForm from './create-filial-form'
    import {Events} from '../autoschool'
    export default {
        name: "school-filials",
        components: {
            ButtonAddFilial,
            CreateFilialForm
        },
        data() {
            return {
                currentPage: 1,
                itemsPerPage: 10,
                resultCount: 0,
                visible: false,
            }
        },
        props: ['filials', 'autoschool'],
        computed: {
            totalPages: function () {
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },
            paginate: function () {
                if (!this.filials || this.filials.length != this.filials.length) {
                    return
                }
                this.resultCount = this.filials.length
                if (this.currentPage >= this.totalPages) {
                    this.currentPage = this.totalPages
                }
                let index = this.currentPage * this.itemsPerPage - this.itemsPerPage
                return this.filials.slice(index, index + this.itemsPerPage)
            }
        },
        methods: {
            setPage(pageNumber) {
                this.currentPage = pageNumber
            }
        },
        created () {
            Events.$on('close-form', () => {
                this.visible = false
            })
            Events.$on('show-form', () => {
                this.visible = true
            })
        },
    }
</script>

<style scoped>

</style>