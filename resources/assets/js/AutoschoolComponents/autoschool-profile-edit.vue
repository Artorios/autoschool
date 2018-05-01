<template>
    <div>
        <div class="profile-edit">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="img-profile text-center">
                        <img src="" alt="">c
                        <a class="pen-but" href="#"><img src="/img/penbut.png"></a>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <h3>АШ "Старт"</h3>
                    <div class="form-group">
                        <div class="selectric-wrapper">
                            <div class="selectric">
                                <span class="label">Филиал Главный</span>
                                <b class="button">▾</b>
                                <select class="select" id="fillials_select">
                                    <option selected disabled>Филиал Главный</option>
                                    <option>филиал1</option>
                                    <option>филиал2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="/logout" class="btn-grey"><img src="/img/img/power.png" alt="">Выход</a>
                    </div>
                </div>
            </div>
            <div class="requsites">
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
                        <input type="text" :value="profile.taxpayerIdentificationNumber" placeholder="*****">
                    </div>
                    <div class="form-group">
                        <label>Сокращенное наименование организации:</label>
                        <input type="text" :value="profile.abbreviatedNameOfTheOrganization" placeholder="ООО Франчайзи">
                    </div>
                    <div class="form-group">
                        <label>Полное наименование организации:</label>
                        <input type="text" :value="profile.fullNameOfTheOrganization" placeholder="Общество с ограниченной ответвеностью Франчайзи">
                    </div>
                    <div class="form-group">
                        <label>КПП:</label>
                        <input :value="profile.codeOfReason" type="text" placeholder="*****">
                    </div>
                    <div class="form-group">
                        <label>ОГРН:</label>
                        <input :value="profile.dateOfStateRegistration" type="text" placeholder="01.12.2017">
                    </div>
                    <div class="form-group">
                        <label>Ген. директор:</label>
                        <input :value="profile.director" type="text" placeholder="Иванов Иван Иванович">
                    </div>
                    <div class="form-group">
                        <label>Дополнительная информация:</label>
                        <input :value="test" type="text" placeholder="Дополнительная информация">
                    </div>
                </div>
                <div v-show="tab==='addressType2'">
                    <h3>Фактический адрес:</h3>
                    <div class="form-group">
                        <label>Город:</label>
                        <input type="text" :value="test" placeholder="Город">
                    </div>
                    <div class="form-group">
                        <label>Индекс:</label>
                        <input type="text" :value="test" placeholder="Индекс">
                    </div>
                    <div class="form-group">
                        <label>Адрес:</label>
                        <input type="text" :value="test" placeholder="Адрес">
                    </div>
                    <div class="form-group">
                        <label>Почтовый адрес:</label>
                        <input :value="test" type="text" placeholder="Почтовый адрес">
                    </div>
                </div>
                <div v-show="tab==='addressType3'">
                    <h3>Юридический адрес:</h3>
                    <div class="form-group">
                        <label>Город:</label>
                        <input type="text" :value="test" placeholder="Город">
                    </div>
                    <div class="form-group">
                        <label>Индекс:</label>
                        <input type="text" :value="test" placeholder="Индекс">
                    </div>
                    <div class="form-group">
                        <label>Адрес:</label>
                        <input type="text" :value="test" placeholder="Адрес">
                    </div>
                </div>
                <div v-show="tab==='addressType4'">
                    <h3>Банк:</h3>
                    <div class="form-group">
                        <label>БИК:</label>
                        <input type="text" :value="test" placeholder="БИК">
                    </div>
                    <div class="form-group">
                        <label>Наименование банка:</label>
                        <input type="text" :value="test" placeholder="Наименование банка">
                    </div>
                    <div class="form-group">
                        <label>Кор счет:</label>
                        <input type="text" :value="test" placeholder="Кор счет">
                    </div>
                    <div class="form-group">
                        <label>Расчетный счет:</label>
                        <input :value="test" type="text" placeholder="Расчетный счет">
                    </div>
                </div>
                <div v-show="tab==='addressType5'">
                    <h3>Контакты:</h3>
                    <div class="form-group">
                        <label>Телефон:</label>
                        <input type="text" :value="test" placeholder="Телефон">
                    </div>
                    <div class="form-group">
                        <label>Доп. телефон:</label>
                        <input type="text" :value="test" placeholder="Доп. телефон">
                    </div>
                    <div class="form-group">
                        <label>Факс:</label>
                        <input type="text" :value="test" placeholder="Факс">
                    </div>
                    <div class="form-group">
                        <label>Скайп:</label>
                        <input :value="test" type="text" placeholder="Скайп">
                    </div>
                    <div class="form-group">
                        <label>Емайл:</label>
                        <input :value="test" type="text" placeholder="Емайл">
                    </div>
                    <div class="form-group">
                        <label>Дополнительная информация:</label>
                        <input :value="test" type="text" placeholder="Дополнительная информация">
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                test: '',
                tab: 'addressType1'
            }
        },
        props: ['profile']
    }
</script>

<style scoped>

</style>