<template>
    <div class="blockgroupe">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <select name="" id="type_filter" class="select">
                        <option value="all">Все(25)</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group">
                    <button class="btn-grey w-100 no-margin">Генерация купонов</button>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group">
                    <button class="btn-grey w-100 no-margin">Статистика купонов</button>
                </div>
            </div>
        </div>

        <div class="search-form blockforms finance">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="search">
                            <input type="text" placeholder="Введите что искать">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="select">
                            <option selected disabled>ФИО ученика</option>
                            <option>Петров В.В.</option>
                            <option>Сидоров Г.А.</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="select">
                            <option selected disabled>По дате</option>
                            <option>21.01.15</option>
                            <option>22.01.15</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="data">
                            <input type="text" placeholder="Дата">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table manage-grid">
            <thead>
            <tr class="visible-md visible-lg">
                <th>№</th>
                <th>Автошкола/ID</th>
                <th>ФИО ученика/Группа</th>
                <th>Тип оплаты</th>
                <th>Дата оплаты</th>
                <th>Сумма</th>
                <th>Комиссия</th>
                <th>Статус</th>
            </tr>
            </thead>
            <tbody class="main">
            <tr data-id="1" class="visible-md visible-lg status-active" v-for="item in list">
                <td>{{ item.id }}</td>
                <td><a class="school-name">{{ item.autoschool.name }}</a><span class="school-id">{{ item.autoschool.id }}</span></td>
                <td><span class="student-name">{{ item.user.name }}</span><span class="group-number">Группа <a
                        href="javascript:">{{ item.autoschool.group }}</a></span></td>
                <td>{{ item.order.payment_option }}</td>
                <td>{{ item.order.updated_at}}</td>
                <td><span class="bold big">{{ item.order.amount }}</span></td>
                <td><a class="bold big" href="javascript:">?</a></td>
                <td><a href="javascript:" class="status">?</a></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                list: []
            }
        },
        mounted() {
            window.axios.get('/investor/finance/list')
                .then((response) => {
                    this.list = response.data.data[0]
                })
        }
    }
</script>