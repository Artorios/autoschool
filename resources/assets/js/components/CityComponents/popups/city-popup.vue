<template>
    <div class="modal fade in" id="modal-default" style="display: block; padding-top: 50px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="cancelChange">×</span></button>
                    <h4 class="modal-title">Добавить город</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Выберите регион</label>
                                <select name="regions" class="form-control" v-model="data.regions_id">
                                    <option value="0">Выберите регион</option>
                                    <option :value="region.id" v-for="region in regionList">{{region.name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Название города</label>
                                <input type="text" class="form-control" v-model="data.name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Дополнительное описание (р-н, область)</label>
                                <input type="text" class="form-control" v-model="data.ru_path">
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
    import {Events} from "../../../app";
    export default {
        data () {
            return {
                data: this.edit ? Object.assign({}, this.city) : {
                    name: '',
                    regions_id: '',
                    ru_path: ''
                },
                errors: {
                    name: false,
                },
                errorEdit: false,
                regionList: null
            }
        },
        props: ['city', 'edit'],
        created () {
            this.getRegions()
        },
        methods: {
            cancelChange () {
                Events.$emit('toggle-popup-school')
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
            },
            getRegions () {
                this.$http.post('/api/address/get-regions', {}).then(res => {
                    if (res.status === 200) {
                        this.regionList = res.data.regions
                    }
                }, err => {
                })
            }
        }
    }
</script>