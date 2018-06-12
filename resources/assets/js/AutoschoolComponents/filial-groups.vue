<template>
    <div>
        <div class="blockgroupe">
            <h2>Группы:</h2>
            <div class="table-block">
                <div class="table-head">
                    <span class="table-head-item number-item">№</span>
                    <span class="table-head-item name-item">Название группы</span>
                    <span class="table-head-item data-and-time-item">Дата и время экзамена</span>
                    <span class="table-head-item count-item">Кол-во учеников</span>
                </div>
                <div class="table-item-row">
                    <div class="table-item number-item">
                        <div class="table-head-item hidden-head-text">№</div>
                        <div class="table-item-content">
                            0
                        </div>
                    </div>
                    <div class="table-item name-item">
                        <div class="table-head-item hidden-head-text">Название группы</div>
                        <div class="table-item-content">
                            <a class="table-item-link text-underline" :href="'/autoschool/filials/new-select'">Выбрали
                                автошколу(неоплачено)</a>
                        </div>
                    </div>
                    <div class="table-item data-and-time-item">
                        <div class="table-head-item hidden-head-text">Дата и время экзамена</div>
                        <div class="table-item-content">
                            <!--<i class="fa fa-clock-o fa-lg icon-in-table" aria-hidden="true"></i>-->
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div class="table-item count-item">
                        <div class="table-head-item hidden-head-text">Кол-во учеников</div>
                        <div class="table-item-content">

                        </div>
                    </div>
                </div>
                <div class="table-item-row">
                    <div class="table-item number-item">
                        <div class="table-head-item hidden-head-text">№</div>
                        <div class="table-item-content">
                            0
                        </div>
                    </div>
                    <div class="table-item name-item">
                        <div class="table-head-item hidden-head-text">Название группы</div>
                        <div class="table-item-content">
                            <a class="table-item-link text-underline"
                               :href="'/autoschool/filials/new'">Нераспределённые</a>
                        </div>
                    </div>
                    <div class="table-item data-and-time-item">
                        <div class="table-head-item hidden-head-text">Дата и время экзамена</div>
                        <div class="table-item-content">
                            <!--<i class="fa fa-clock-o fa-lg icon-in-table" aria-hidden="true"></i>-->
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div class="table-item count-item">
                        <div class="table-head-item hidden-head-text">Кол-во учеников</div>
                        <div class="table-item-content">

                        </div>
                    </div>
                </div>
                <div class="table-item-row" v-for="group in paginate">
                    <div class="table-item number-item">
                        <div class="table-head-item hidden-head-text">№</div>
                        <div class="table-item-content">
                            {{group.id}}
                        </div>
                    </div>
                    <div class="table-item name-item">
                        <div class="table-head-item hidden-head-text">Название группы</div>
                        <div class="table-item-content">
                            <a class="table-item-link text-underline"
                               :href="'/autoschool/filials/groups/'+group.id">
                                {{group.name}}
                            </a>
                        </div>
                    </div>
                    <div class="table-item data-and-time-item">
                        <div class="table-head-item hidden-head-text">Дата и время экзамена</div>
                        <div class="table-item-content">
                            <i class="fa fa-clock-o fa-lg icon-in-table" aria-hidden="true"></i>
                            <span>{{editDate(group.exam_date)}}</span>
                            <span>({{dayOfweek(group.exam_date)}})</span>
                            <span>{{editTime(group.exam_time)}}</span>
                        </div>
                    </div>
                    <div class="table-item count-item">
                        <div class="table-head-item hidden-head-text">Кол-во учеников</div>
                        <div class="table-item-content">
                            {{group.count_student}}
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
            editDate(date) {
                if (date) {
                    var dateTemp = date.split('-')
                    date = dateTemp['2'] + '.' + dateTemp['1'] + '.' + dateTemp['0']
                    return date
                }
                return false

            },
            dayOfweek(date) {
                if (date) {
                    var dateTemp = date.split('-')
                    date = new Date(dateTemp['0'], dateTemp['1'] - 1, dateTemp['2']);
                    var day = date.getDay()
                    return ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'][day]
                }
                return false
            },
            editTime(time) {
                if (time) {
                    var timeTemp = time.split(':')
                    time = timeTemp['0'] + ':' + timeTemp['1']
                    return time
                }
                return false
            }
        },
        created() {
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
    .table-item-row {
        padding: 30px 10px;
    }

    .number-item {
        flex: 0 0 6%;
        max-width: 6%;
    }

    .name-item {
        flex: 0 0 37%;
        max-width: 37%;
    }

    .data-and-time-item {
        flex: 0 0 35%;
        max-width: 35%;
    }

    .count-item {
        flex: 0 0 22%;
        max-width: 22%;
    }

    @media only screen and (max-width: 1199px) {
        .data-and-time-item {
            flex: 0 0 37%;
            max-width: 37%;
        }

        .count-item {
            flex: 0 0 20%;
            max-width: 20%;
        }
    }

    @media only screen and (max-width: 991px) {
        .number-item {
            flex: 0 0 7%;
            max-width: 7%;
        }

        .name-item {
            flex: 0 0 35%;
            max-width: 35%;
        }

        .data-and-time-item {
            flex: 0 0 41%;
            max-width: 41%;
        }

        .count-item {
            flex: 0 0 17%;
            max-width: 17%;
        }
    }

    @media only screen and (max-width: 767px) {
        .number-item {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .name-item {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .data-and-time-item {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .count-item {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>