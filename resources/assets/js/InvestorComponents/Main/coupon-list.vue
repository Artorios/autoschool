<template>
    <div class="blockgroupe" v-if="list.length">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <select name="" id="" class="select">
                        <option value="all">Все(25)</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group">
                    <a class="btn-grey w-100 no-margin" href="/investor/coupons/create">Генерация
                        купонов</a>
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
                            <input type="text" placeholder="Введите что искать" v-model="searchTitle" v-on:keyup="filterByTitle">
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
                            <v-date-picker
                                    :min-date='new Date()'
                                    v-model='selectedDate'></v-date-picker>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="coupon-table">
            <div class="table-wrapper">
                <div class="title-line">
                    <span class="number">№</span>
                    <span class="coupon">Купон</span>
                    <span class="autoschool">Автошкола /ID</span>
                    <span class="city">Филиал /Город</span>
                    <span class="name-student">ФИО ученика /група</span>
                    <span class="generate-date">Дата генерации</span>
                    <span class="activate-date">Дата активации</span>
                    <span class="price">Сумма оплаты</span>
                    <span class="status">Комиссия /статус</span>
                </div>

                <div v-for="item in filteredList" :class="{
                    'line active': item.status === 3,
                    'line sale': item.status === 2,
                    'line free': item.status === 1,
                    }">
                    <div class="coupons-cheskbox">
                        <label class="label-checkbox">
                            <input type="checkbox" class="hidden-checkbox">
                            <span class="label-check"></span>
                        </label>
                    </div>
                    <div class="number">{{ item.id }}</div>
                    <div class="coupon"><a href="#">{{ item.name }}</a></div>
                    <div class="autoschool"><a href="">{{ item.autoschool.title }}</a> ID {{ item.autoschool.id }}</div>
                    <div class="city">{{ item.autoschool.city.name }} / {{ item.autoschool.city.ru_path }}</div>
                    <div class="name-student">
                        {{ item.student_name }}
                        Група №<a href="">{{ item.group_id }}</a>
                    </div>
                    <div class="generate-date">
                        <a href="">{{ item.date.generation }}</a>
                    </div>
                    <div class="activate-date">
                        <a href="">{{ item.date.activation }}</a>
                    </div>
                    <div class="price">{{ item.amount.payment }}</div>
                    <div class="status">
                        <div class="status-fee">{{ item.amount.commission }}</div>
                        <div class="status-active" v-if="item.status === 3"><a href="">Активирован</a></div>
                        <div class="status-free" v-if="item.status === 1"><a href="">Свободный</a></div>
                        <div class="status-paid" v-if="item.status === 2"><a href="">Выплачен</a>
                            <i class="fa fa-info-circle icon-info-status" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <!--<div class="blockform active">-->
                <!--<div class="form-inline">-->
                <!--<input type="text" placeholder="Комментарий">-->
                <!--<a href="" class="btn-grey">Выплатить</a>-->
                <!--<a href="" class="close"></a>-->
                <!--</div>-->
                <!--</div>-->
                <!--<div class="line free">-->
                <!--<div class="coupons-cheskbox"><input type="checkbox"></div>-->
                <!--<div class="number">01</div>-->
                <!--<div class="coupon"><a href="#">ИД-21</a></div>-->
                <!--<div class="autoschool">Автошкола <a href=""> АБВ </a> ID 6701</div>-->
                <!--<div class="city">Центральный Киров</div>-->
                <!--<div class="name-student">-->

                <!--</div>-->
                <!--<div class="generate-date">-->
                <!--<a href="">01.01.0000</a>-->
                <!--</div>-->
                <!--<div class="activate-date">-->
                <!--<a href=""></a>-->
                <!--</div>-->
                <!--<div class="price">15 000</div>-->
                <!--<div class="status">-->
                <!--<div class="status-fee">6000</div>-->
                <!--<div class="status-active"><a href="">Активирован</a></div>-->
                <!--<div class="status-free"><a href="">Свободный</a></div>-->
                <!--<div class="status-paid"><a href="">Выплачен</a> <img src="/img/attention.png" alt=""></div>-->
                <!--</div>-->
                <!--<div></div>-->
                <!--</div>-->

                <!--<div class="line paid">-->
                <!--<div class="coupons-cheskbox"><input type="checkbox"></div>-->
                <!--<div class="number">01</div>-->
                <!--<div class="coupon"><a href="#">ИД-21</a></div>-->
                <!--<div class="autoschool">Автошкола <a href=""> АБВ </a> ID 6701</div>-->
                <!--<div class="city">Центральный Киров</div>-->
                <!--<div class="name-student">-->
                <!--Длинно-фамилиевський И. В.-->
                <!--Група №<a href="">123</a>-->
                <!--</div>-->
                <!--<div class="generate-date">-->
                <!--<a href="">01.01.0000</a>-->
                <!--</div>-->
                <!--<div class="activate-date">-->
                <!--<a href="">01.01.2222</a>-->
                <!--</div>-->
                <!--<div class="price">15 000</div>-->
                <!--<div class="status">-->
                <!--<div class="status-fee">6000</div>-->
                <!--<div class="status-active"><a href="">Активирован</a></div>-->
                <!--<div class="status-free"><a href="">Свободный</a></div>-->
                <!--<div class="status-paid"><a href="">Выплачен</a> <img src="/img/attention.png" alt=""></div>-->
                <!--</div>-->
                <!--<div></div>-->
                <!--</div>-->

                <div class="blockform paid">
                    <div class="form-inline">

                        <div class="date">
                            25.10.1225
                        </div>
                        <div>
                            Выплата комисии
                        </div>
                        <div class="info"> По щету № <a href="">207</a> от 01.01.0147</div>

                        <a href="" class="close"></a>
                    </div>
                </div>
                <div class="blockform bottom-form">
                    <div class="row nero">
                        <div class="col-md-4 text-info">
                            <input type="checkbox">
                            <span class="all">Для всех</span>
                            <span>Отмечено 1 из 12</span>
                        </div>
                        <div class="col-md-2">
                            <a href="" class="btn-grey">Анулировать</a>
                        </div>
                        <div class="col-md-2">
                            <a href="" class="btn-grey" id="delete">Удалить</a>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="" id="type_filter" class="select">
                                    <option value="all">Выберите действие</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        Недостаточно данных
    </div>
</template>

<script>
    export default {
        data() {
            return {
                searchTitle: '',
                searchDate: '',
                list: [],
                filteredList: []
            }
        },
        methods: {
            filterByTitle: function () {
                this.filteredList = this.list.filter(item => {
                    return item.autoschool.title.toLowerCase().includes(this.searchTitle.toLowerCase())
                });
                if (this.searchTitle.length <= 0)  this.filteredList = this.list;
            },
            filterByDate: function () {
                this.filteredList = this.list.filter(item => {
                    return item.updated_at.toLowerCase().includes(this.searchDate.toLowerCase())
                });
                if (this.searchDate.length <= 0)  this.filteredList = this.list;
            }
        },
        mounted() {
            window.axios.get('/investor/coupons/list')
                .then((response) => {
                    this.list = response.data.data;
                    this.filteredList = response.data.data;
                })
        }
    }
</script>