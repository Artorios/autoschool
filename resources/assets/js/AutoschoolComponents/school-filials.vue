<template>
    <div>
        <div class="blockgroupe">
            <h2>Филиалы:</h2>

            <div class="table-wrapper">
                <div class="title-line">
                    <span class="number">№</span>
                    <span class="name">Название филиала</span>
                    <span class="data-and-time">Адрес филиала</span>
                    <span class="count">Кол-во учеников</span>
                    <span class="kupons">Купоны активные/неактивные/всего</span>
                </div>

                <div class="line" v-for="filial in paginate">
                    <div class="number">{{filial.id}}</div>
                    <div class="name"><a :href="'/autoschool/filials/' + filial.id">{{filial.name}}</a></div>
                    <div class="data-and-time">
                        <span>{{filial.address}}</span>
                    </div>

                    <div class="count">
                        <span class="visible-xs hidden-sm">Количество учеников  8</span>
                        <span class="visible-sm hidden-xs visible-lg visible-md">8</span>
                    </div>
                    <div class="kupons">
                        <span>24/ 34 / 50</span>
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