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
                    <div class="name"><a :href="'/autoschool/filials/groups/'+group.id">{{group.name}}</a></div>
                    <div class="data-and-time">
                        <i class="fa fa-clock-o fa-lg" aria-hidden="true"></i>
                        {{editDate(group.exam_date)}} ({{dayOfweek(group.exam_date)}}) {{editTime(group.exam_time)}}
                    </div>
                    <div class="count">
                        <span class="visible-xs hidden-sm">Количество учеников  {{group.count_student}}</span>
                        <span class="visible-sm hidden-xs visible-lg visible-md">{{group.count_student}}</span>
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
        <div v-if="filial">
            <button-add-group></button-add-group>
            <create-group v-if="visible" :filial="filial"></create-group>
        </div>
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
        data: function () {
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
            },
            editDate(date){
                if(date){
                    var dateTemp = date.split('-')
                    date = dateTemp['2'] + '.' + dateTemp['1'] + '.' + dateTemp['0']
                    return date
                }
                return false

            },
            dayOfweek(date){
                if(date){
                    var dateTemp = date.split('-')
                    date = new Date(dateTemp['0'],dateTemp['1']-1,dateTemp['2']);
                    var day = date.getDay()
                    return ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'][day]
                }
                return false
            },
            editTime(time){
                if(time){
                    var timeTemp = time.split(':')
                    time = timeTemp['0'] + ':' + timeTemp['1']
                    return time
                }
                return false
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