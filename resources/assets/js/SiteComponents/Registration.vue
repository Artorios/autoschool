<template>
    <div class="main-wrapper">
        <div class="registration">

            <div class="container">
                <div class="registration-wrapper">
                    <h3>Регистрация</h3>
                    <div class="error-server error" v-if="serverError">Произошла ошибка при регистрации</div>
                    <ul class="error-list error" v-if="registerErrors">
                        <li v-for="error in registerErrors">{{ error[0] }}</li>
                    </ul>
                    <form v-on:submit.prevent="registration">
                        <div>
                            <div class="form-group">
                                <p class="error" v-if="errors.name">Имя должно быть минимум 3 символа</p>
                                <input type="text" placeholder="Имя*" v-model="data.name" v-bind:class="{ 'input-error': errors.name}">
                            </div>
                            <div class="form-group">
                                <p class="error" v-if="errors.last_name">Фамилия должна быть минимум 3 символа</p>
                                <input type="text" placeholder="Фамилия*" v-model="data.last_name" v-bind:class="{ 'input-error': errors.last_name}">
                            </div>
                            <div class="form-group">
                                <p class="error" v-if="errors.second_name">Отчество должно быть минимум 3 символа</p>
                                <input type="text" placeholder="Отчество" v-model="data.second_name" v-bind:class="{ 'input-error': errors.second_name}">
                            </div>
                            <div class="form-group">
                                <p class="error" v-if="errors.email">Не правильный email</p>
                                <input type="email" placeholder="Электронная*" v-model="data.email" v-bind:class="{ 'input-error': errors.email}">
                            </div>
                        </div>
                        <div class="right">
                            <div class="form-group">
                                <p class="error" v-if="errors.phone">Не правильный телефон</p>
                                <input type="text" placeholder="Телефон*" v-model="data.phone" v-bind:class="{ 'input-error': errors.phone}">
                            </div>
                            <div class="form-group">
                                <p class="error" v-if="errors.password">Пароль должен быть минимум 6 символов</p>
                                <input type="password" placeholder="Пароль*" v-model="data.password" v-bind:class="{ 'input-error': errors.password}">
                            </div>
                            <div class="form-group">
                                <p class="error" v-if="errors.city_id">Выбирите город</p>
                                <select class="select"  id="city_id" v-model="data.city_id">
                                    <option disabled value="">Ваш город*</option>
                                    <option :value="city.id" v-for="city in cities">{{city.name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p class="error" v-if="errors.license">Выбирите категорию</p>
                                <select class="select" id="license" v-model="data.license">
                                    <option disabled value="">Категория*</option>
                                    <option value="A" >A</option>
                                    <option value="B" >B</option>
                                    <option value="C" >C</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn-red">Зарегистрироваться</button>
                        <div class="auth-wrapper">
                            <a href="#">Авторизация</a>
                        </div>
                        <div class="agree">
                            <p class="error" v-if="errors.agree">Подтвердите согласие на обработку персональных данных</p>
                            <input type="checkbox" id="agree" v-model="data.agree">
                            <label for="agree">Я согласен на обработку моих персональных данных.</label>
                            <a href="#">Соглашение</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {
        data () {
            return {
                data: {
                    name: '',
                    last_name: '',
                    second_name: '',
                    email: '',
                    password: '',
                    phone: '',
                    city_id: '',
                    license: '',
                    agree: false
                },
                errors: {
                    name: false,
                    last_name: false,
                    second_name: false,
                    email: false,
                    password: false,
                    phone: false,
                    city_id: false,
                    license: false,
                    agree: false
                },
                serverError: false,
                registerErrors: false,
            }
        },
        props: ['cities'],
        mounted () {
            let vm = this
            $('#city_id').selectric({
                onChange: function(element) {
                    vm.data.city_id = $(element).val()
                },
            })
            $('#license').selectric({
                onChange: function(element) {
                    vm.data.license = $(element).val()
                },
            })
//            this.getCities()
        },
//        munted () {
//        },
        methods: {
            registration () {
                if (this.validate()) return false
                this.$http.post('/registration', this.data).then(res => {
                    if (res.status === 201) {
                        location.href = '/'
                    }
                }, err => {
                    if (+err.status === 422) {
                        this.serverError = true
                        this.registerErrors = err.data['errors']
                    }
                })
            },
            validate () {
                for (let key in this.data) {
                    switch (key) {
                        case 'name':
                            if (!this.data[key] || this.data[key].length < 3) {
                                this.$set(this.errors, key, true)
                            } else {
                                this.$set(this.errors, key, false)
                            }
                            break
                        case 'last_name':
                            if (!this.data[key] || this.data[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'second_name':
                            if (!this.data[key] || this.data[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'password':
                            if (!this.data[key] || this.data[key].length < 4) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'phone':
                            if (!this.checkPhone(this.data[key])) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'city_id':
                            if (!this.data[key]) {
                                this.errors[key] = true
                            } else {
                                this.data[key] = +this.data[key]
                                this.errors[key] = false
                            }
                            break
                        case 'license':
                            if (!this.data[key]) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'email':
                            if (!this.checkEmail(this.data[key])) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'agree':
                            if (!this.data[key]) {
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
            getCities () {
                this.$http.post('/api/get-prices', {}).then(res => {
                    this.cities = res.data.cities
                    $('.select').selectric('refresh')
                })
            }
        }
    }
</script>
<style scoped>
    p.error{
        color: red;
        font-size: 12px;
        position: absolute;
        left: auto;
        top: 0;
        width: 100%;
        line-height: 12px;
    }
    .form-group{
        position: relative;
        padding: 17px 0 0 0;
    }
    .registration .container form > div input {
        margin: 0 0 15px;
    }
    .registration .container form .agree{
        position: relative;
        padding: 10px 0 0 0;
        margin-top: 20px;
    }
    @media screen and (max-width: 680px){
        .agree p.error{
            top: -20px;
        }
    }
    .error-server.error{
        color: red;
    }
    .error-list.error{
        color: red;
        list-style: none;
        padding: 0;
    }
</style>