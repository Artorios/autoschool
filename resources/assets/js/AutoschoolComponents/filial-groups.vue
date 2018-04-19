<template>
    <div>
        <div class="blockgroupe">
            <h2>Группы:</h2>
            <div class="table-wrapper">
                <div class="title-line">
                    <span class="number">№</span>
                    <span class="name">Название группы</span>
                    <span class="data-and-time">Дата и время экзамена</span>
                    <span class="count">Кол-во учеников</span>
                </div>
                <div class="line" v-for="group in paginate">
                    <div class="number">{{group.id}}</div>
                    <div class="name"><a href="#">{{group.name}}</a></div>
                    <div class="data-and-time">
                        <img src="img/clock.png"> {{group.exam_date}} {{group.exam_time}}
                    </div>
                    <div class="count">
                        <span class="visible-xs hidden-sm">Количество учеников  {{group.student_counts}}</span>
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
        <button-add-group></button-add-group>
        <create-group v-if="visible" :filial="filial"></create-group>
    </div>
</template>

<script>
    import ButtonAddGroup from './button-add-group';
    import CreateGroup from './create-group'
    import {Events} from '../autoschool'

    export default {
        name: "filial-groups",
        components: {
            ButtonAddGroup,
            CreateGroup
        },
        data() {
            return {
                currentPage: 1,
                itemsPerPage: 10,
                resultCount: 0,
                visible: false,
            }
        },
        props: ['filial', 'groups'],
        computed: {
            totalPages: function () {
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },
            paginate: function () {
                if (!this.groups || this.groups.length != this.groups.length) {
                    return
                }
                this.resultCount = this.groups.length
                if (this.currentPage >= this.totalPages) {
                    this.currentPage = this.totalPages
                }
                let index = this.currentPage * this.itemsPerPage - this.itemsPerPage
                return this.groups.slice(index, index + this.itemsPerPage)
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