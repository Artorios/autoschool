<template>
    <div>
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a> / {{autoschool.title}}</li>
            </ul>
        </div>
        <div class="profile-edit">
            <div class="profile-content">
                <div class="img photo-edit-container">
                    <img :src="getPathToImage()" class="upload-image" alt="">
                </div>
                <div class="profile-info-block">
                    <h3 class="profile-info-title" v-text="autoschool.title"></h3>
                    <div class="profile-info-bottom">
                        <div class="form-group profile-form-group">
                            <select class="select" id="fillials_select" v-model="selected">
                                <option>{{autoschool.title}}</option>
                            </select>
                        </div>
                        <a href="/logout" class="btn-grey btn-exit profile-btn-exit">
                            <i class="fa fa-power-off" aria-hidden="true"></i>
                            Выход
                        </a>
                    </div>
                </div>
            </div>
            <div class="requsites clearfix">
                <div class="radio-button">
                    <input type="radio" name="address-type" id="address-type-1" value="addressType1" v-model="tab">
                    <label for="address-type-1">Реквизиты юр. лица</label>
                </div>
                <div class="radio-button">
                    <input type="radio" name="address-type" id="address-type-2" value="addressType2" v-model="tab">
                    <label for="address-type-2">Фактический адрес</label>
                </div>
                <div class="radio-button">
                    <input type="radio" name="address-type" id="address-type-3" value="addressType3" v-model="tab">
                    <label for="address-type-3">Юридический адрес</label>
                </div>
                <div class="radio-button">
                    <input type="radio" name="address-type" id="address-type-4" value="addressType4" v-model="tab">
                    <label for="address-type-4">Банк</label>
                </div>
                <div class="radio-button">
                    <input type="radio" name="address-type" id="address-type-5" value="addressType5" v-model="tab">
                    <label for="address-type-5">Контакты</label>
                </div>
                <div class="radio-button">
                    <input type="radio" name="address-type" id="address-type-6" value="addressType6" v-model="tab">
                    <label for="address-type-6">Комисия</label>
                </div>
            </div>
        </div>
        <h2 v-if="this.status">Даные успешно обновлены</h2>
        <h3 v-if="this.errors.contact_email">Неверно введеный емейл</h3>
        <h3 v-if="this.errors.contact_phone">Неверно введеный телефон</h3>
        <h3 v-if="this.errors.contact_reserve_phone">Неверно введеный дополнительный телефон</h3>

        <h2 v-if="this.errors.serverError"></h2>
        <div class="details">
            <form v-on:submit.prevent="changeAutoschool()">
                <div v-show="tab==='addressType1'">
                    <h3>Реквизиты юр. лица:</h3>
                    <div class="form-group">
                        <label>ИНН:</label>

                        <input type="text" v-model="autoschoolInfo.taxpayer_identification_number" placeholder="*****">
                    </div>
                    <div class="form-group">
                        <label>Сокращенное наименование организации:</label>
                        <input type="text"
                               v-model="autoschoolInfo.abbreviated_name_of_the_organization"
                               placeholder="ООО Франчайзи">
                    </div>
                    <div class="form-group">
                        <label>Полное наименование организации:</label>
                        <input type="text"
                               v-model="autoschoolInfo.full_name_of_the_organization"
                               placeholder="Общество с ограниченной ответвеностью Франчайзи">
                    </div>
                    <div class="form-group">
                        <label>КПП:</label>
                        <input
                                v-model="autoschoolInfo.code_of_reason"
                                type="text" placeholder="*****">
                    </div>
                    <div class="form-group">
                        <label>ОГРН:</label>
                        <input
                                v-model="autoschoolInfo.date_of_state_registration"
                                type="text" placeholder="01.12.2017">
                    </div>
                    <div class="form-group">
                        <label>Ген. директор:</label>

                        <input
                               v-model="autoschoolInfo.director"
                               type="text" placeholder="Иванов Иван Иванович">
                    </div>
                    <div class="form-group">
                        <label>Дополнительная информация:</label>
                        <input
                               v-model="autoschoolInfo.additional_information"
                               type="text" placeholder="Дополнительная информация">
                    </div>
                </div>
                <div v-show="tab==='addressType2'">
                    <h3>Фактический адрес:</h3>
                    <div class="form-group">
                        <label>Город:</label>
                        <input type="text"
                               v-model="autoschoolInfo.actual_city"
                               placeholder="Город">
                    </div>
                    <div class="form-group">
                        <label>Индекс:</label>
                        <input type="text"
                               v-model="autoschoolInfo.actual_index"
                               placeholder="Индекс">
                    </div>
                    <div class="form-group">
                        <label>Адрес:</label>
                        <input type="text"
                               v-model="autoschoolInfo.actual_address"
                               placeholder="Адрес">
                    </div>
                    <div class="form-group">
                        <label>Почтовый адрес:</label>
                        <input type="text"
                               v-model="autoschoolInfo.actual_post_index"
                               placeholder="Почтовый адрес">
                    </div>
                </div>
                <div v-show="tab==='addressType3'">
                    <h3>Юридический адрес:</h3>
                    <div class="form-group">
                        <label>Город:</label>
                        <input type="text"
                               v-model="autoschoolInfo.legal_city"
                               placeholder="Город">
                    </div>
                    <div class="form-group">
                        <label>Индекс:</label>
                        <input type="text"
                               v-model="autoschoolInfo.legal_index"
                               placeholder="Индекс">
                    </div>
                    <div class="form-group">
                        <label>Адрес:</label>
                        <input type="text"
                               v-model="autoschoolInfo.legal_address"
                               placeholder="Адрес">
                    </div>
                </div>
                <div v-show="tab==='addressType4'">
                    <h3>Банк:</h3>
                    <div class="form-group">
                        <label>БИК:</label>
                        <input type="text"
                               v-model="autoschoolInfo.bank_identification_code"
                               placeholder="БИК">
                    </div>
                    <div class="form-group">
                        <label>Наименование банка:</label>
                        <input type="text"
                               v-model="autoschoolInfo.bank_name"
                               placeholder="Наименование банка">
                    </div>
                    <div class="form-group">
                        <label>Кор счет:</label>
                        <input type="text"
                               v-model="autoschoolInfo.bank_correspondent_account"
                               placeholder="Кор счет">
                    </div>
                    <div class="form-group">
                        <label>Расчетный счет:</label>
                        <input
                                v-model="autoschoolInfo.bank_settlement_account"
                                type="text" placeholder="Расчетный счет">
                    </div>
                </div>
                <div v-show="tab==='addressType5'">
                    <h3>Контакты:</h3>
                    <div class="form-group">
                        <label>Телефон:</label>
                        <input type="text"
                               v-model="autoschoolInfo.contact_phone"
                               placeholder="Телефон">
                    </div>
                    <div class="form-group">
                        <label>Доп. телефон:</label>
                        <input type="text"
                               v-model="autoschoolInfo.contact_reserve_phone"
                               placeholder="Доп. телефон">
                    </div>
                    <div class="form-group">
                        <label>Факс:</label>
                        <input type="text"
                               v-model="autoschoolInfo.contact_fax"
                               placeholder="Факс">
                    </div>
                    <div class="form-group">
                        <label>Скайп:</label>
                        <input
                              v-model="autoschoolInfo.contact_skype"
                              type="text" placeholder="Скайп">
                    </div>
                    <div class="form-group">
                        <label>Емайл:</label>
                        <input
                                v-model="autoschoolInfo.contact_email"
                                type="text" placeholder="Емайл">
                    </div>
                    <div class="form-group">
                        <label>Дополнительная информация:</label>
                        <input
                                v-model="autoschoolInfo.contact_contact_additional_information"
                                type="text" placeholder="Дополнительная информация">
                    </div>
                </div>
                <div v-show="tab==='addressType6'">
                    <h3>Комисия:</h3>
                    <div class="form-group">
                        <label>Комисия:</label>
                        <input type="text"
                               v-model="autoschoolInfo.commission"
                               placeholder="Комисия">
                    </div>
                </div>
            </form>
        </div>
        <a class="btn-grey btn-exit profile-btn-exit" @click="changeAutoschool">
            Изменить
        </a>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tab: 'addressType1',
                selected: '',
                filial: {},
                investor_id: '',
                autoschoolInfo: {},
                errors: {
                    serverError: false,
                    contact_reserve_phone: false,
                    contact_phone: false,
                    contact_email: false
                },
                status: false,
            }
        },
        props: {
            autoschool: {}
        },
        mounted() {
            let vm = this
            $('#fillials_select').selectric({
                onChange: function (element) {
                    vm.selected = $(element).val()
                    vm.filial = vm.autoschools[vm.selected]
                },
            })
        },

        methods: {
            changeAutoschool() {
                if (this.validate()) return false
                this.autoschoolInfo.auto_school_id = this.autoschool.id
                this.$http.post('/investor/school/change-info-about-autoschool', this.autoschoolInfo).then(res => {
                    if (res.status === 201) {
                        this.status = true
                    }
                }), err => {
                    if (+err.status === 400) {
                        this.serverError = true
                        }
                    }
                },

            getPathToImage() {
                return this.autoschool.logo ? '/storage/school/' + this.autoschool.logo : '/img/profile-photo.png'
            },

            validate() {
                for (let key in this.autoschoolInfo) {
                    switch (key) {
                        case 'contact_phone':
                            if (!this.checkPhone(this.autoschoolInfo[key])) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'contact_reserve_phone':
                            if (!this.checkPhone(this.autoschoolInfo[key])) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'contact_email':
                            if (!this.checkEmail(this.autoschoolInfo[key])) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
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
            },
            checkEmail (email) {
                let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                return re.test(email.toLowerCase());

            },
            checkPhone (phone){
                let re = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/
                return re.test(phone);

            },

        },

        created () {
           this.$http.post('/investor/school/get-info-about-school', {'autoschool': this.autoschool.id}).then(res => {
            if (res.status === 201) {
                this.autoschoolInfo = res.data.data
            }
          })

        }
    }
</script>

<style scoped>
    .img .upload-image {
        border-radius: 50%;
        border: 1px solid #ccc;
    }
    .photo-edit-container .upload-image {
        width: 125px;
        height: 125px;
    }
</style>