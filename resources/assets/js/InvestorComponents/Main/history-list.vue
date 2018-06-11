<template>
    <div class="blockgroupe">
        <div class="search-form blockforms finance">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="search">
                            <input type="text" placeholder="Введите что искать" v-model="searchComment" v-on:keyup="filterByComment">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <select id="autoschool-name" class="select"
                                v-model="searchSchoolName"
                                @change="filterByName">
                            <option selected disabled>автошкола</option>
                            <option v-for="item in list">{{ item.auto_school.title }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <select id="date" class="select"
                                v-model="searchDate"
                                @change="filterByDate">
                            <option selected disabled>дата</option>
                            <option v-for="item in list">{{ item.updated_at }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <div class="data">
                            <input type="text" placeholder="Дата" v-on:keyup="filterByDate" v-model="searchDate">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2>История</h2>
        <div class="table-block table-block-history">
            <div class="table-head">
                <div class="table-head-item number-item">№</div>
                <div class="table-head-item table-item-date">Дата</div>
                <div class="table-head-item table-item-operation">Вид операции</div>
                <div class="table-head-item city-item">Комментарий</div>
            </div>
            <div class="table-item-row"
                        data-id="1"
                        v-for="item in filteredList">
                    <div class="table-item number-item">
                        <div class="table-head-item table-head-number hidden-head-text">№</div>
                        <div class="table-item-content">
                            {{ item.id }}
                        </div>
                    </div>
                    <div class="table-item table-item-date">
                        <div class="table-head-item table-head-date hidden-head-text">Дата</div>
                        <div class="table-item-content">
                            {{ item.updated_at }}
                        </div>
                    </div>
                    <div class="table-item table-item-operation">
                        <div class="table-head-item hidden-head-text">Вид операции</div>
                        <div class="table-item-content">
                            {{ item.operation }}
                        </div>
                    </div>
                    <div class="table-item table-item-comment">
                        <div class="table-head-item hidden-head-text">Комментарий</div>
                        <div class="table-item-content">
                            {{ item.comment }}
                        </div>
                    </div>
                </div>
        </div>
        <div class="check-all-block">
            <div class="check-all-input-block">
                <label class="label-checkbox-with-text">
                    <input type="checkbox"
                            class="hidden-checkbox">
                    <span class="label-check-text">Для всех</span>
                </label>
            </div>
            <div class="check-all-text">
                Отмечено <span class="text-bold">1000</span> из <span class="text-bold">1000</span>
            </div>
            <div class="button-block button-block-with-select">
                <a type="text" class="btn-grey">Анулировать</a>
                <a type="text" class="btn-grey">Удалить</a>
                <div class="select-block">
                    <select class="select">
                        <option selected disabled>Виберите действие</option>
                        <option>1</option>
                        <option>2</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                searchComment: '',
                searchSchoolName: '',
                searchDate: '',
                list: [],
                filteredList: []
            }
        },
        methods: {
            filterByName: function () {
                this.filteredList = this.list.filter(item => {
                    return item.auto_school.title.toLowerCase() === this.searchSchoolName.toLowerCase()
                })
                if (this.searchSchoolName.length <= 0)  this.filteredList = this.list;
            },
            filterByComment: function () {
                this.filteredList = this.list.filter(item => {
                    return item.comment.toLowerCase().includes(this.searchComment.toLowerCase())
                })
                if (this.searchComment.length <= 0)  this.filteredList = this.list;
            },
            filterByDate: function () {
                this.filteredList = this.list.filter(item => {
                    return item.updated_at.toLowerCase().includes(this.searchDate.toLowerCase())
                })
                if (this.searchDate.length <= 0)  this.filteredList = this.list;
            }
        },
        mounted() {
            window.axios.get('/investor/history/list')
                .then((response) => {
                    this.list = response.data.data;
                    this.filteredList = response.data.data
                })
        }
    }
</script>
<style scoped>
    .table-block-history{
        margin: 0 0 25px 0;
    }
    .number-item{
        flex: 0 0 6%;
        max-width: 6%;
    }
    .table-item-date{
        flex: 0 0 25%;
        max-width: 25%;
    }
    .table-item-operation{
        flex: 0 0 34%;
        max-width: 34%;
    }
    .table-item-comment{
        flex: 0 0 35%;
        max-width: 35%;
    }
    @media only screen and (max-width: 991px){
        .number-item{
            flex: 0 0 7%;
            max-width: 7%;
        }
        .table-item-date{
            flex: 0 0 25%;
            max-width: 25%;
        }
        .table-item-operation{
            flex: 0 0 32%;
            max-width: 32%;
        }
        .table-item-comment{
            flex: 0 0 37%;
            max-width: 37%;
        }
    }
    @media only screen and (max-width: 767px){
        .table-item{
            background-color: transparent;
        }
        .number-item{
            flex: 0 0 35%;
            max-width: 35%;
            background-color: #fafafa;
        }
        .table-item-date{
            flex: 0 0 65%;
            max-width: 65%;
            background-color: #fafafa;
        }
        .table-item-operation{
            flex: 0 0 100%;
            max-width: 100%;
        }
        .table-item-comment{
            flex: 0 0 100%;
            max-width: 100%;
        }
        .table-head-item.table-head-date{
            flex: 0 0 25%;
            max-width: 25%;
        }
        .table-head-item.table-head-number{
            flex: 0 0 15%;
            max-width: 15%;
        }
    }
    @media only screen and (max-width: 575px){
        .table-head-item.table-head-number {
            flex: 0 0 35%;
            max-width: 35%;
            padding: 0 10px 0 0;
        }
        .number-item{
            flex: 0 0 100%;
            max-width: 100%;
        }
        .table-item-date{
            flex: 0 0 100%;
            max-width: 100%;
            background-color: transparent;
        }
        .table-item:nth-child(odd){
            background-color: #fafafa;
        }
        .table-head-item.table-head-date{
            flex: 0 0 35%;
            max-width: 35%;
        }
    }
</style>