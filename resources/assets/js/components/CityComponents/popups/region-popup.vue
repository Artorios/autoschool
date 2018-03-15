<template>
    <div class="modal fade in" id="modal-default" style="display: block; padding-top: 50px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="cancelChange">×</span></button>
                    <h4 class="modal-title">Добавить регион</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Название региона</label>
                                <input type="text" class="form-control" v-model="data.name">
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal" @click="cancelChange">Отмена</button>
                    <button type="button" class="btn btn-primary" v-if="edit" @click="editCity">Сохранить изменения</button>
                    <button type="button" class="btn btn-primary" @click="createCity" v-else>Добавить регион</button>
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
                data: this.edit ? Object.assign({}, this.region) : {
                    name: '',
                },
                errors: {
                    name: false,
                    price: false
                },
                errorEdit: false
            }
        },
        props: ['region', 'edit'],
        mounted () {
        },
        methods: {
            cancelChange () {
                Events.$emit('toggle-popup-school')
            },
            editCity () {
                this.$http.put('/admin/regions/update/' + this.data.id, this.data).then(res => {
                    if (res.status === 202) {
                        location.href = '/admin/regions'
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            },
            createCity () {

                this.$http.post('/admin/regions/create', this.data).then(res => {
                    if (res.status === 201) {
                        location.href = '/admin/regions'
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            },
            validate () {
                for (let key in this.data) {
                    switch (key) {
                        case 'name':
                            if (!this.data[key]) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'price':
                            if (!this.data[key]) {
                                this.errors[key] = true
                                this.data[key] = +this.data[key]
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'show_city':
                            this.data[key] = +this.data[key]
                            break
                    }
                }
                let hasError = false
                for (let key in this.errors) {
                    if (this.errors[key]) {
                        hasError = true
                    }
                }
                return hasError
            }
        }
    }
</script>