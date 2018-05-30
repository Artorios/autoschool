<template>
    <div class="content-wrapper">
        <price-popup :price="checkedPrice" :edit="checkedPrice ? true : false" v-if="showEditPopup"></price-popup>
        <delete-city :city="checkedCity" v-if="showDelPopup"></delete-city>
        <section class="content-header">
            <h1>
                Цены для городов
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Список городов</h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right" v-model="q" :placeholder="searchplaceholder">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group-btn">
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-success btn-lg" @click="showCreate"><i class="fa fa-plus" style="margin-right: 10px;"></i>Добавить город</button>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" v-model="checkedRegionId">
                                            <option value="" disabled selected>Выберите регион</option>
                                            <option :value="region.id" v-for="region in regions">{{region.name}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Город</th>
                                    <th>Регион</th>
                                    <th>Цена</th>
                                    <th>Показывать на сайте</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="city in dataPrice.data">
                                    <td>{{city.id}}</td>
                                    <td>{{city.name}}</td>
                                    <td>{{city.region.name + ', г. ' + city.name}}</td>
                                    <td>{{city.price}} руб</td>
                                    <td>{{city.show_city ? 'Да' : 'Нет'}}</td>
                                    <td>
                                        <button class="btn btn-success"
                                                title="Редактировать"
                                                @click="showEdit(city)"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-warning"
                                                title="Редактировать"
                                                @click="delPrice(city)"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>

                        <paginate
                                :page-count="dataPrice.last_page"
                                :page-range="3"
                                :margin-pages="2"
                                :initial-page="page"
                                :force-page = "page"
                                :click-handler="clickCallback"
                                :container-class="'pagination'"
                                :next-text="'>>'"
                                :prev-text="'<<'"
                                :prev-class="'prev-items'"
                                :next-class="'next-items'"
                                ref="paginate"
                                :page-class="'page-item'">
                        </paginate>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    </div>
</template>

<script type="text/babel">
    import PricePopup from './popups/price-popup.vue'
    import DeleteCity from './popups/delete-city.vue'
    import {Events} from '../../app'
    import paginate from 'vuejs-paginate'
    export default {
        data () {
            return {
                checkedPrice: null,
                showEditPopup: false,
                page: 0,
                q: '',
                errorSearch: false,
                dataPrice: this.prices,
                checkedCity: null,
                showDelPopup: false,
                checkedRegionId: this.region.id
            }
        },
        components: {
            PricePopup,
            paginate,
            DeleteCity
        },
        watch: {
            q: function (val) {
                if (val && val.length > 2) {
                    this.setFilter()
                } else if(!val) {
                    this.setFilter(1, 0)
                }
            },
            checkedRegionId: function (val) {
                this.q = ''
                this.setFilter(1,0)
            }
        },
        props: ['prices', 'region', 'regions', 'searchplaceholder'],
        created () {
            Events.$on('toggle-popup-school', () => {
                this.closePopup()
            })

            Events.$on('toggle-popup-delete', () => {
                this.closePopupDel()
            })
        },
        methods: {
            closePopup () {
                this.showEditPopup = false
                this.checkedPrice = null
            },
            closePopupDel () {
                this.checkedCity = false
                this.showDelPopup = null
            },
            showEdit (city) {
                this.showEditPopup = true
                this.checkedPrice = city
            },
            showCreate () {
                this.showEditPopup = true
                this.checkedPrice = null
            },
            clickCallback (page) {
                this.page = --page
                this.setFilter(0, ++page)
            },
            setFilter (clear, page) {
                let data = clear || !this.q ? {} : {q: this.q}
                data.region_id = this.checkedRegionId
                if (page) {
                    data.page = page
                }
                this.$http.post('/admin/cities', data).then(res => {
                    if (res.status === 200) {
                        this.dataPrice = res.data.cities
                        if (!page) {
                            this.page = 0
                        }
                    }
                }, err => {
                    this.errorSearch = true
                })
            },
            delPrice (city) {
                this.checkedCity = city
                this.showDelPopup = true
            }
        }
    }
</script>