<template>
    <div class="modal fade in" id="modal-default" style="display: block; padding-top: 50px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="cancelChange">×</span></button>
                    <h4 class="modal-title" v-if="!edit">Добавить город</h4>
                    <h4 class="modal-title" v-if="edit">Редактировать город</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Выберите регион</label>
                                <autocomplete
                                    url="/api/address/get-regions-api"
                                    anchor="name"
                                    label="writer"
                                    v-if="!edit"
                                    :classes="{ wrapper: 'form-wrapper', input: 'form-control', list: 'data-list', item: 'data-list-item' }"
                                    placeholder="Введите название региона"
                                    :on-select="getData">
                                </autocomplete>
                                <input type="text" readonly="readonly" v-if="edit" class="form-control" v-model="checkedRegion.name">
                            </div>
                            <div class="form-group">
                                <label>Название города</label>
                                <input type="text" class="form-control" v-model="data.name">
                            </div>
                            <div class="form-group">
                                <label>Цена за курс</label>
                                <input type="text" class="form-control" v-model="data.price">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Дополнительное описание (р-н, область)</label>
                                <input type="text" class="form-control" v-model="data.ru_path">
                            </div>
                            <div class="form-group">
                                <label>Показывать на сайте?</label>
                                <div class="form-group">
                                    <label style="margin-right: 15px;">
                                        <input type="radio" name="r1" class="minimal" value="1" v-model="data.show_city">
                                        Да
                                    </label>
                                    <label>
                                        <input type="radio" name="r1" class="minimal" value="0" v-model="data.show_city">
                                        Нет
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal" @click="cancelChange">Отмена</button>
                    <button type="button" class="btn btn-primary" v-if="edit" @click="editCity">Сохранить изменения</button>
                    <button type="button" class="btn btn-primary" @click="createCity" v-else>Добавить город</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<style lang="scss">
    .custom-height{
        height: 200px;
        overflow-y: scroll;
        overflow-x: hidden;
        padding: 0 5px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
</style>

<script>
    import {Events} from "../../../app"
    require('vue2-autocomplete-js/dist/style/vue2-autocomplete.css')
    import Autocomplete from 'vue2-autocomplete-js'
    export default {
        data () {
            return {
                data: this.edit ? Object.assign({}, this.price) : {
                    name: '',
                    price: 1500,
                    show_city: 1,
                    regions_id: '',
                },
                errors: {
                    name: false,
                },
                errorEdit: false,
                cityList: null,
                regionList: null,
                checkedRegion: this.price ? this.price.region : null
            }
        },
        props: ['price', 'edit'],
        components: {
            Autocomplete
        },
        watch: {
            checkedRegion: function (val) {
                if (val) {
                    this.data.regions_id = val.id
                } else {
                    this.data.regions_id = null
                }
            }
        },
        created () {
        },
        methods: {
            cancelChange () {
                Events.$emit('toggle-popup-school')
            },
            getData (val) {
                this.checkedRegion = val
            },
            editCity () {
                this.$http.put('/admin/cities/update/' + this.data.id, this.data).then(res => {
                    if (res.status === 202) {
                        location.href = '/admin/cities'
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            },
            createCity () {
                this.$http.post('/admin/cities/create', this.data).then(res => {
                    if (res.status === 201) {
                        location.href = '/admin/cities'
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            }
        }
    }
</script>