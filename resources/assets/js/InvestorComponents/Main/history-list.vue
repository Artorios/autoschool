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
                <div class="col-md-4">
                    <div class="form-group">
                        <!--<select class="select">-->
                        <!--<option value="" v-for="item in list">{{ item.auto_school.title }}</option>-->
                        <!--</select>-->
                        <label for="autoschool-name">автошкола</label>
                        <select v-model="searchSchoolName" @change="filterByName" id="autoschool-name">
                            <option selected ></option>
                            <option v-for="item in list">{{ item.auto_school.title }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date">дата</label>
                        <select v-model="searchDate" @change="filterByDate" id="date">
                            <option selected></option>
                            <option v-for="item in list">{{ item.updated_at }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="data">
                            <input type="text" placeholder="Дата" v-on:keyup="filterByDate" v-model="searchDate">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table manage-grid">
            <thead>
            <tr class="visible-md visible-lg">
                <th>№</th>
                <th>Дата</th>
                <th>Вид операции</th>
                <th>Комментарий</th>
            </tr>
            </thead>
            <tbody class="main">
            <tr data-id="1" class="visible-md visible-lg" v-for="item in filteredList">
                <td>{{ item.id }}</td>
                <td>{{ item.updated_at }}</td>
                <td>{{ item.operation }}</td>
                <td>{{ item.comment }}</td>
            </tr>
            </tbody>
            <tfoot class="finance-line-height">
            <tr>
                <td colspan="9">
                    <div class="row nero">
                        <div class="col-md-2 margin-12">
                            <input type="checkbox"> Для всех
                        </div>
                        <div class="col-md-2 margin-12 margin-y-10">
                            Отмечено 1 из 12
                        </div>

                        <div class="col-xs-12 col-md-2 margin-y-10"><a type="text" class="btn-grey">Анулировать</a>
                        </div>
                        <div class="col-xs-12 col-md-2 margin-y-10"><a type="text" class="btn-grey">Удалить</a></div>
                        <div class="col-xs-12 col-md-4 margin-y-10">
                            <select class="select">
                                <option selected disabled>Виберите действие</option>
                                <option>1</option>
                                <option>2</option>
                            </select>
                        </div>
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
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