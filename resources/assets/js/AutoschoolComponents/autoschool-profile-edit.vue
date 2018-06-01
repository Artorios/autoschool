<template>
    <div>
        <div class="breadcrumbs">
            <ul>
                <li><a href="/autoschool">Главная</a> / {{filial.title}}</li>
            </ul>
        </div>
        <div class="profile-edit">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <autoschool-profile-logo :filial="filial"></autoschool-profile-logo>
                </div>
                <div class="col-md-8 col-xs-12">
                    <div class="form-group">
                        <span class="label">Филиал Главный</span>
                        <select class="select" id="fillials_select" v-model="selected">
                            <option v-for="(autoschool, index) in autoschools"
                                    v-text="autoschool.title"
                                    v-bind:value="index">
                            </option>
                        </select>
                    </div>
                    <div>
                        <a href="/logout" class="btn-grey btn-exit">
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
            </div>
        </div>
        <div class="details">
            <form>
                <div v-show="tab==='addressType1'">
                    <h3>Реквизиты юр. лица:</h3>
                    <div class="form-group">
                        <label>ИНН:</label>
                        <input type="text" :value="[filial.info ? filial.info.taxpayer_identification_number : '']" placeholder="*****">
                    </div>
                    <div class="form-group">
                        <label>Сокращенное наименование организации:</label>
                        <input type="text" :value="[filial.info ? filial.info.abbreviated_name_of_the_organization : '']" placeholder="ООО Франчайзи">
                    </div>
                    <div class="form-group">
                        <label>Полное наименование организации:</label>
                        <input type="text" :value="[filial.info ? filial.info.full_name_of_the_organization : '']"
                               placeholder="Общество с ограниченной ответвеностью Франчайзи">
                    </div>
                    <div class="form-group">
                        <label>КПП:</label>
                        <input :value="[filial.info ? filial.info.code_of_reason : '']" type="text" placeholder="*****">
                    </div>
                    <div class="form-group">
                        <label>ОГРН:</label>
                        <input :value="[filial.info ? filial.info.date_of_state_registration  : '']" type="text" placeholder="01.12.2017">
                    </div>
                    <div class="form-group">
                        <label>Ген. директор:</label>
                        <input :value="[filial.info ? filial.info.director  : '']" type="text" placeholder="Иванов Иван Иванович">
                    </div>
                    <div class="form-group">
                        <label>Дополнительная информация:</label>
                        <input :value="[filial.info ? filial.info.additional_information  : '']" type="text" placeholder="Дополнительная информация">
                    </div>
                </div>
                <div v-show="tab==='addressType2'">
                    <h3>Фактический адрес:</h3>
                    <div class="form-group">
                        <label>Город:</label>
                        <input type="text" :value="[filial.info ? filial.info.actual_city : '']" placeholder="Город">
                    </div>
                    <div class="form-group">
                        <label>Индекс:</label>
                        <input type="text" :value="[filial.info ? filial.info.actual_index : '']" placeholder="Индекс">
                    </div>
                    <div class="form-group">
                        <label>Адрес:</label>
                        <input type="text" :value="[filial.info ? filial.info.actual_address : '']" placeholder="Адрес">
                    </div>
                    <div class="form-group">
                        <label>Почтовый адрес:</label>
                        <input :value="[filial.info ? filial.info.actual_post_index : '']" type="text" placeholder="Почтовый адрес">
                    </div>
                </div>
                <div v-show="tab==='addressType3'">
                    <h3>Юридический адрес:</h3>
                    <div class="form-group">
                        <label>Город:</label>
                        <input type="text" :value="[filial.info ? filial.info.legal_city : '']" placeholder="Город">
                    </div>
                    <div class="form-group">
                        <label>Индекс:</label>
                        <input type="text" :value="[filial.info ? filial.info.legal_index : '']" placeholder="Индекс">
                    </div>
                    <div class="form-group">
                        <label>Адрес:</label>
                        <input type="text" :value="[filial.info ? filial.info.legal_address : '']" placeholder="Адрес">
                    </div>
                </div>
                <div v-show="tab==='addressType4'">
                    <h3>Банк:</h3>
                    <div class="form-group">
                        <label>БИК:</label>
                        <input type="text" :value="[filial.info ? filial.info.bank_identification_code : '']" placeholder="БИК">
                    </div>
                    <div class="form-group">
                        <label>Наименование банка:</label>
                        <input type="text" :value="[filial.info ? filial.info.bank_name : '']" placeholder="Наименование банка">
                    </div>
                    <div class="form-group">
                        <label>Кор счет:</label>
                        <input type="text" :value="[filial.info ? filial.info.bank_correspondent_account : '']" placeholder="Кор счет">
                    </div>
                    <div class="form-group">
                        <label>Расчетный счет:</label>
                        <input :value="[filial.info ? filial.info.bank_settlement_account : '']" type="text" placeholder="Расчетный счет">
                    </div>
                </div>
                <div v-show="tab==='addressType5'">
                    <h3>Контакты:</h3>
                    <div class="form-group">
                        <label>Телефон:</label>
                        <input type="text" :value="[filial.info ? filial.info.contact_phone : '']" placeholder="Телефон">
                    </div>
                    <div class="form-group">
                        <label>Доп. телефон:</label>
                        <input type="text" :value="[filial.info ? filial.info.contact_reserve_phone : '']" placeholder="Доп. телефон">
                    </div>
                    <div class="form-group">
                        <label>Факс:</label>
                        <input type="text" :value="[filial.info ? filial.info.fax : '']" placeholder="Факс">
                    </div>
                    <div class="form-group">
                        <label>Скайп:</label>
                        <input :value="[filial.info ? filial.info.skype : '']" type="text" placeholder="Скайп">
                    </div>
                    <div class="form-group">
                        <label>Емайл:</label>
                        <input :value="[filial.info ? filial.info.email : '']" type="text" placeholder="Емайл">
                    </div>
                    <div class="form-group">
                        <label>Дополнительная информация:</label>
                        <input :value="[filial.info ? filial.info.contact_additional_information : '']" type="text" placeholder="Дополнительная информация">
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import AutoschoolProfileLogo from './autoschool-profile-logo'
    export default {
        components: {
            AutoschoolProfileLogo
        },
        data() {
            return {
                tab: 'addressType1',
                selected: '',
                filial: {},
            }
        },
        props: {
            autoschools: {}
        },
        created() {
            this.filial = this.autoschools[0];
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
    }
</script>

<style scoped>

</style>