<template>
    <div class="main-wrapper">
        <div class="registration">

            <div class="container">
                <div class="registration-wrapper">
                    <h3>Регистрация</h3>
                    <form v-on:submit.prevent="registration">
                        <p class="error" v-if="serverError">Произошла ошибка при регистрации</p>
                        <div class="error" v-if="registerErrors">
                            <ul>
                                <li v-for="error in registerErrors">{{ error[0] }}</li>
                            </ul>
                        </div>
                        <div>
                            <p class="error" v-if="errors.name">Длина имени должна быть минимум 3 символа</p>
                            <input type="text" placeholder="Имя*" v-model="data.name">
                            <p class="error" v-if="errors.last_name">Длина фамилии должна быть минимум 3 символа</p>
                            <input type="text" placeholder="Фамилия*" v-model="data.last_name">
                            <input type="text" placeholder="Отчество*" v-model="data.second_name">
                            <p class="error" v-if="errors.second_name">Длина отчества должна быть минимум 3 символа</p>
                            <input type="text" placeholder="Отчество" v-model="data.second_name">
                            <p class="error" v-if="errors.email">Не правильный email</p>
                            <input type="email" placeholder="Электронная*" v-model="data.email">
                        </div>
                        <div class="right">
                            <p class="error" v-if="errors.phone">Не правильный телефон</p>
                            <input type="text" placeholder="Телефон*" v-model="data.phone">
                            <p class="error" v-if="errors.password">Длина пароля должна быть минимум 6 символа</p>
                            <input type="password" placeholder="Пароль*" v-model="data.password">
                            <p class="error" v-if="errors.city_id">Выбирите город</p>
                            <select class="select"  id="city_id" v-model="data.city_id">
                                <option disabled value="">Ваш город*</option>
                                <option :value="city.id" v-for="city in cities">{{city.name}}</option>
                            </select>
                            <br>
                            <p class="error" v-if="errors.license">Выбирите категорию</p>
                            <select class="select" id="license" v-model="data.license">
                                <option disabled value="">Категория*</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-red">Зарегистрироваться</button>
                        <div class="auth-wrapper">
                            <a href="#">Авторизация</a>
                        </div>
                        <p class="error" v-if="errors.agree">Подтвердите согласие на обработку персональных данных</p>
                        <div class="agree">
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
                    license: false
                },
                serverError: false,
                registerErrors: []
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
                    if (+err.status === 400) {
                        this.serverError = true
                        this.registerErrors = err.data['registerErrors']
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
                            if (!this.data[key] || this.data[key].length < 6) {
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