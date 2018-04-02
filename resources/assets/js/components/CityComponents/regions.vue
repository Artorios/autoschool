<template>
    <div class="content-wrapper">
        <region-popup :region="checkedRegion" :edit="checkedRegion ? true : false" v-if="showEditPopup"></region-popup>
        <section class="content-header">
            <h1>
                Регионы
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
                            <h3 class="box-title">Список регионов</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right" v-model="q" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-success btn-lg" @click="showCreate"><i class="fa fa-plus" style="margin-right: 10px;"></i>Добавить регион</button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Город</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="region in dataRegions.data">
                                    <td>{{region.id}}</td>
                                    <td>{{region.name}}</td>
                                    <td>
                                        <button class="btn btn-success"
                                                title="Редактировать"
                                                @click="showEdit(region)"><i class="fa fa-edit"></i></button>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                        <!--<div class="input-group-btn">-->
                            <!--<button type="submit" class="btn btn-default" @click="showCreate">Добавить регион</button>-->
                        <!--</div>-->
                        <paginate
                                :page-count="dataRegions.last_page"
                                :page-range="3"
                                :margin-pages="2"
                                :initial-page="page"
                                :force-page = "page"
                                :click-handler="clickCallback"
                                :container-class="'pagination'"
                                :prev-text="'<<'"
                                :next-text="'>>'"
                                :prev-class="'prev-items'"
                                :next-class="'next-items'"
                                ref="paginate"
                                :page-class="'page-item'">
                        </paginate>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    </div>
</template>

<script type="text/babel">
    import RegionPopup from './popups/region-popup.vue'
    import {Events} from '../../app'
    import paginate from 'vuejs-paginate'
    export default {
        data () {
            return {
                checkedRegion: null,
                showEditPopup: false,
                page: 0,
                q: '',
                errorSearch: false,
                dataRegions: this.regions
            }
        },
        components: {
            RegionPopup,
            paginate
        },
        watch: {
            q: function (val) {
                if (val && val.length > 2) {
                    this.setFilter()
                } else if(!val) {
                    this.setFilter(1)
                }
            }
        },
        props: ['regions'],
        created () {
            Events.$on('toggle-popup-school', () => {
                this.closePopup()
            })
        },
        methods: {
            closePopup () {
                this.showEditPopup = false
                this.checkedRegion = null
            },
            showEdit (region) {
                this.showEditPopup = true
                this.checkedRegion = region
            },
            showCreate () {
                this.showEditPopup = true
                this.checkedRegion = null
            },
            clickCallback (page) {
                this.page = --page
                this.setFilter('clear', ++page)
            },
            setFilter (clear, page = 0) {
                let data = clear ? {} : {q: this.q}
                if (page) {
                    data.page = page
                }
                this.$http.post('/admin/regions', data).then(res => {
                    if (res.status === 200) {
                        this.dataRegions = res.data.regions
                    }
                }, err => {
                    this.errorSearch = true
                })
            }
        }
    }
</script>