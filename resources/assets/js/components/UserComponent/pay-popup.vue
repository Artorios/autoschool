<template>
    <div class="modal fade in" id="modal-default" style="display: block; padding-top: 50px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="cancelChange">×</span></button>
                    <h4 class="modal-title" >Оплата</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Автошкола</label>
                                    <span class="error" v-if="createErrors.auto_school_id">{{createErrors.auto_school_id[0]}}</span>
                                    <autocomplete
                                            url="/api/get-autoschool-api"
                                            anchor="title"
                                            label="filial_name"
                                            :initValue="checkedSchool ? checkedSchool['title'] : ''"
                                            :classes="{ wrapper: 'form-wrapper', input: 'form-control', list: 'data-list', item: 'data-list-item' }"
                                            :on-select="getDataSchool">
                                    </autocomplete>
                                </div>
                            <div class="form-group">
                                <label>Тип оплаты*</label>
                                <span class="error" v-if="createErrors.payment_option">{{createErrors.payment_option[0]}}</span>
                                <select class="form-control select2"
                                        style="width: 100%;"
                                        v-model="data.payment_option"
                                        required>
                                    <option selected="selected" value="">Выберите тип</option>
                                    <option value="transfer">Банковский перевод</option>
                                </select>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Сумма*</label>
                                <span class="error" v-if="createErrors.amount">{{createErrors.amount[0]}}</span>
                                <input type="text" class="form-control" v-model="data.amount">
                            </div>
                            <div class="form-group">
                                <label>Номер договора*</label>
                                <span class="error" v-if="createErrors.number_contract">{{createErrors.number_contract[0]}}</span>
                                <input type="text" class="form-control" v-model="data.number_contract">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal" @click="cancelChange">Отмена</button>
                    <button type="button" class="btn btn-primary" @click="save()">Сохранить </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    import {Events} from "../../app";
    require('vue2-autocomplete-js/dist/style/vue2-autocomplete.css')
    import Autocomplete from 'vue2-autocomplete-js'

    export default {
        data () {
            return {
                data:  {
                    payment_option: '',
                    number_contract: '',
                    amount: '',
                    auto_school_id: '',
                    user_id: ''
                },
                checkedSchool: '',
                errorPay: false,
                createErrors: ''
            }
        },
        created () {
        },
        props: ['user'],
        components: {
            Autocomplete
        },
        methods: {
            cancelChange () {
                Events.$emit('toggle-popup-pay')
            },
            getDataSchool(val){
                this.checkedSchool = val.id
            },
            save(){
                this.data.auto_school_id = this.checkedSchool
                this.data.user_id = this.user.id
                this.$http.post('/admin/user/pay-user/' + this.user.id, this.data).then(res => {
                    if (res.status === 202) {
                        location.href = '/admin/users'
                    } else {
                        this.errorPay = true
                    }
                }, err => {
                    if (+err.status === 422) {
                        console.log(err.data)
                        this.errorPay = true
                        this.createErrors = err.data['errors']
                    }
                })
            }



        }
    }
</script>
<style>
    span.error{
        color: red;
    }
</style>