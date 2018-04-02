<template>
    <div class="modal fade in" id="modal-default" style="display: block; padding-top: 50px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="cancelChange">×</span></button>
                    <h4 class="modal-title">Добавить автошколу</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Название города</label>
                                <input type="text" class="form-control" v-model="data.name">
                            </div>
                            <div class="form-group">
                                <label>Цена для города</label>
                                <input type="text" class="form-control" v-model="data.price">
                            </div>
                        </div>
                        <div class="col-md-6">
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
    import {Events} from "../../app";
    export default {
        data () {
            return {
                data: this.edit ? Object.assign({}, this.city) : {
                    name: '',
                    price: 1500,
                    show_city: 1
                },
                errors: {
                    name: false,
                    price: false
                },
                errorEdit: false
            }
        },
        props: ['city', 'edit'],
        mounted () {
        },
        methods: {
            cancelChange () {
                Events.$emit('toggle-popup-school')
            },
            editCity () {
                this.$http.put('/admin/city/update/' + this.data.id, this.data).then(res => {
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
                if (this.validate()) return false

                this.$http.post('/admin/city/create', this.data).then(res => {
                    if (res.status === 201) {
                        location.href = '/admin/cities'
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