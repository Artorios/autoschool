<template>
    <div class="content error tickets">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a></li>
                <li>Билеты</li>
            </ul>
        </div>
        <input type="checkbox" v-model="withComments" @change="setShowComment" id="withCom">
        <label for="withCom">Решать с комментариями</label>
        <div class="tickets-wrapper">
            <div :class="['ticket', {'actives': (index === selectedElement)}]" :id="index"
                 v-for="(ticket, index, key) in paginate"
                 :key="ticket.ticket_id">
                <div class="ticket-inner" :class="[{'black': !ticket.status, 'green': ticket.status, 'red': ticket.status === 'failed'}]">
                    <div class="info">
                        <a :href="'/account/tickets/' + ticket.ticket_id" class="number ">
                            {{ticket.ticket_id}}
                        </a>
                        <span class="status status-green" v-if="ticket.status === 'passed'">Пройден</span>
                        <span class="status status-green"
                              v-if="ticket.status === 'failed'">{{ticket.right_answers_count}} из {{ticket.all_count}}
                            <span class="refresh"></span>
                        </span>
                        <span class="status" v-if="!ticket.status">Этот билет еще не решался</span>
                        <span v-if="ticket.date_try">{{ticket.date_try}}</span>
                    </div>
                    <!--<span class="btn-grey ticket-toggle" @click.prevent>Статистика попыток</span>-->
                    <span class="btn-grey ticket-toggle"
                          v-if="ticket.history"
                          @click="changeHistory(index)">
                        Статистика попыток
                    </span>
                    <a :href="'/account/tickets/' + ticket.ticket_id">
                        <span class="btn-grey" v-if="!ticket.history">
                            Решить
                        </span>
                    </a>
                </div>
                <div class="hidden-part"  v-if="ticket.history && (index === selectedElement)">
                    <div class="hidden-content">
                        <h5>Статистика попыток Билет № {{ticket.ticket_id}} Предупреждающие знаки :</h5>
                        <div class="line" v-for="(history, i) in ticket.history">
                            <span class="name">Попытка {{i + 1}}</span>
                            <span class="mistakes">Ошибок<span
                                    class="red">{{history.incorrect_answers_count}}</span></span>
                            <span class="date">{{setDate(history.updated_at)}}</span>
                            <a :href="'/account/tickets/analysis/'+history.id">Разбор ошибок</a>
                        </div>
                        <span class="close" @click="changeHistory(index)"></span>
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
</template>

<script type="text/babel">
    import moment from 'moment'
    export default {
        data () {
            return {
                withComments: +this.showComments,
                currentPage: 1,
                itemsPerPage: 10,
                resultCount: 0,
                selectedElement: false
            }
        },
        props: ['tickets', 'showComments'],
        computed: {
            totalPages: function(){
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },
            paginate: function(){
                if (!this.tickets || this.tickets.length != this.tickets.length){
                    return
                }
                this.resultCount = this.tickets.length
                if(this.currentPage >= this.totalPages){
                    this.currentPage = this.totalPages
                }
                let index = this.currentPage * this.itemsPerPage - this.itemsPerPage
                return this.tickets.slice(index, index + this.itemsPerPage)
            }
        },
        methods: {
            changeHistory(index){
                if(this.selectedElement === index) {
                    return this.selectedElement = false
                }
                this.selectedElement = index
            },
            setShowComment () {
                let data = {
                    value: this.withComments ? 1 : 0
                }

                this.$http.post('/account/tickets/set-show-comments', data).catch(e => {
                    this.withComments = !this.withComments
                })
            },
            setDate (date) {
                return date.split(' ')[0]
            },
            setPage(pageNumber){
                this.currentPage = pageNumber
            }
        }
    }
</script>

<style lang="scss" scoped>
    .inner-main-content .container .tickets .tickets-wrapper .ticket .ticket-inner {
        /*cursor: pointer;*/
        &.black {
            border-color: #999;
        }
        &.green {
            border-color: #cbe5c2;
        }
        &.red {
            border-color: #ffcccb;
        }
    }

    .inner-main-content .container .tickets .tickets-wrapper .ticket .ticket-inner .info .number {
        color: #333;
    }
    .inner-main-content .container .tickets .tickets-wrapper .ticket.active{
        margin-bottom: 0px;
    }
    .inner-main-content .container .tickets .tickets-wrapper .ticket.actives{
        margin-bottom: 210px;
    }
    .inner-main-content .container .tickets .tickets-wrapper .ticket .hidden-part{
        background-color: #ccc;
        height: 0;
        width: calc(100% - 30px);
    }
    .inner-main-content .container .tickets .tickets-wrapper .ticket.actives .hidden-part {
            min-height: 180px;

    }

    .hidden-part {
        animation: opentitleanimate 0.3s linear;
    }

    @keyframes opentitleanimate {
        0% {
            min-height: 0;
            opacity: 0;
        }
        100% {
            min-height: 180px;
            opacity: 1;
        }
    }
</style>