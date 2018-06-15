<template>
    <div class="modal fade in" id="modal-default" style="display: block; padding-top: 50px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="cancelChange">×</span></button>
                    <h4 class="modal-title">Оплата</h4>
                </div>
                <span class="error" v-if="error">Произошла ошыбка</span>
                <div class="modal-body">
                        <div class="requsites">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="radio-button">
                                        <input type="radio" name="address-type" id="address-type-1" value="addressType1"
                                                v-model="tab">
                                        <label for="address-type-1">Реквизиты юр. лица</label>
                                    </div>
                                    <div class="radio-button">
                                        <input type="radio" name="address-type" id="address-type-2" value="addressType2"
                                                v-model="tab">
                                        <label for="address-type-2">Фактический адрес</label>
                                    </div>
                                    <div class="radio-button">
                                        <input type="radio" name="address-type" id="address-type-3" value="addressType3"
                                                v-model="tab">
                                        <label for="address-type-3">Юридический адрес</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="radio-button">
                                        <input type="radio" name="address-type" id="address-type-4" value="addressType4"
                                                v-model="tab">
                                        <label for="address-type-4">Банк</label>
                                    </div>
                                    <div class="radio-button">
                                        <input type="radio" name="address-type" id="address-type-5" value="addressType5"
                                                v-model="tab">
                                        <label for="address-type-5">Контакты</label>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="details">
                        <form>
                            <div class="row" v-show="tab==='addressType1'">
                                <div class="col-md-12">
                                    <h3>Реквизиты юр. лица:</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ИНН:</label>
                                        <input type="text" v-model="data.info.taxpayer_identification_number"
                                                placeholder="*****" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Сокращенное наименование организации:</label>
                                        <input type="text" v-model="data.info.abbreviated_name_of_the_organization"
                                                placeholder="ООО Франчайзи" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Полное наименование организации:</label>
                                        <input type="text" v-model="data.info.full_name_of_the_organization"
                                                placeholder="Общество с ограниченной ответвеностью Франчайзи" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>КПП:</label>
                                        <input v-model="data.info.code_of_reason" type="text" placeholder="*****" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ОГРН:</label>
                                        <input v-model="data.info.date_of_state_registration" type="text"
                                                placeholder="01.12.2017" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Ген. директор:</label>
                                        <input v-model="data.info.fio" type="text" placeholder="Иванов Иван Иванович" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Дополнительная информация:</label>
                                        <input v-model="data.info.additional_information" type="text"
                                                placeholder="Дополнительная информация" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-show="tab==='addressType2'">
                                <div class="col-md-12">
                                    <h3>Фактический адрес:</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Город:</label>
                                        <input type="text" v-model="data.info.actual_city" placeholder="Город" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Индекс:</label>
                                        <input type="text" v-model="data.info.actual_index" placeholder="Индекс" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Адрес:</label>
                                        <input type="text" v-model="data.info.actual_address" placeholder="Адрес" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Почтовый адрес:</label>
                                        <input v-model="data.info.actual_post_index" type="text"
                                                placeholder="Почтовый адрес" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-show="tab==='addressType3'">
                                <div class="col-md-12">
                                    <h3>Юридический адрес:</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Город:</label>
                                        <input type="text" v-model="data.info.legal_city" placeholder="Город" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Индекс:</label>
                                        <input type="text" v-model="data.info.legal_index" placeholder="Индекс" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Адрес:</label>
                                        <input type="text" v-model="data.info.legal_address" placeholder="Адрес" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-show="tab==='addressType4'">
                                <div class="col-md-12">
                                    <h3>Банк:</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>БИК:</label>
                                        <input type="text" v-model="data.info.bank_identification_code" placeholder="БИК" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Наименование банка:</label>
                                        <input type="text" v-model="data.info.bank_name" placeholder="Наименование банка" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Кор счет:</label>
                                        <input type="text" v-model="data.info.bank_correspondent_account"
                                                placeholder="Кор счет" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Расчетный счет:</label>
                                        <input v-model="data.info.bank_settlement_account" type="text"
                                                placeholder="Расчетный счет" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-show="tab==='addressType5'">
                                <div class="col-md-12">
                                    <h3>Контакты:</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Телефон:</label>
                                        <input type="text" v-model="data.info.contact_phone" placeholder="Телефон" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Доп. телефон:</label>
                                        <input type="text" v-model="data.info.contact_reserve_phone"
                                                placeholder="Доп. телефон" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Факс:</label>
                                        <input type="text" v-model="data.info.contact_fax" placeholder="Факс" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Скайп:</label>
                                        <input v-model="data.info.contact_skype" type="text" placeholder="Скайп" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Емайл:</label>
                                        <input v-model="data.info.contact_email" type="text" placeholder="Емайл" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Дополнительная информация:</label>
                                        <input v-model="data.info.contact_additional_information" type="text"
                                                placeholder="Дополнительная информация" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal" @click="cancelChange">
                        Отмена
                    </button>
                    <button type="button" class="btn btn-primary" @click="save()">Сохранить</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    import {Events} from "../../app";

    export default {
        data() {
            return {
                data: {
                    info: {
                        'taxpayer_identification_number': '',
                        'abbreviated_name_of_the_organization': '',
                        'full_name_of_the_organization': '',
                        'code_of_reason': '',
                        'date_of_state_registration': '',
                        'fio': '',
                        'additional_information': '',
                        'actual_city': '',
                        'actual_index': '',
                        'actual_address': '',
                        'actual_post_index': '',
                        'legal_city': '',
                        'legal_index': '',
                        'legal_address': '',
                        'bank_identification_code': '',
                        'bank_name': '',
                        'bank_correspondent_account': '',
                        'bank_settlement_account': '',
                        'contact_phone': '',
                        'contact_reserve_phone': '',
                        'contact_fax': '',
                        'contact_skype': '',
                        'contact_email': '',
                        'contact_additional_information': '',
                        'user_id': ''

                    }
                },
                error: false,
                tab: 'addressType1',

            }
        },
        created() {
            if (this.investor.info) {
                this.data = this.investor
            }
        },
        props: ['investor'],
        methods: {
            cancelChange() {
                Events.$emit('toggle-popup-investor')
            },
            save() {
                console.log(this.data.info)
                this.data.info.user_id = this.investor.id
                this.$http.post('/admin/user/investor-info-save', this.data.info).then(res => {
                    if (res.status === 202) {
                        this.error = false
                        // console.log(res.data)
                        location.href = '/admin/users'
                    } else {
                        this.error = true
                    }
                }, err => {
                    if (+err.status === 422) {
                        this.error = true
                    }
                })
            }


        }
    }
</script>
<style>
    span.error {
        color: red;
    }
</style>