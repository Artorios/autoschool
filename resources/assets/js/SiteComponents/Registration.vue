<template>
    <div class="main-wrapper">
        <div class="registration">

            <div class="container">
                <div class="registration-wrapper">
                    <h3>Регистрация</h3>
                    <form v-on:submit.prevent="registration">
                        <p class="error" v-if="serverError">Произошла ошибка при регистрации</p>
                        <div>
                            <input type="text" placeholder="Имя*" v-model="data.name">
                            <input type="text" placeholder="Фамилия*" v-model="data.last_name">
                            <input type="text" placeholder="Отчество" v-model="data.second_name">
                            <input type="email" placeholder="Электронная*" v-model="data.email">
                        </div>
                        <div class="right">
                            <input type="text" placeholder="Телефон*" v-model="data.phone">
                            <input type="password" placeholder="Пароль*" v-model="data.password">
                            <select class="select"  id="city_id">
                                <option selected disabled>Ваш город*</option>
                                <option :value="city.id" v-for="city in cities">{{city.name}}</option>
                            </select>
                            <br>
                            <select class="select" id="license">
                                <option selected disabled>Категория*</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-red">Зарегистрироваться</button>
                        <div class="auth-wrapper">
                            <a href="#">Авторизация</a>
                        </div>
                        <div class="agree">
                            <input type="checkbox" id="agree">
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
                    license: ''
                },
                errors: {
                    name: false,
                    last_name: false,
                    second_name: false,
                    email: false,
                    password: false,
                    phone: false,
                    price_city_id: false
                },
                serverError: false
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
                console.log(this.data.city_id)
                console.log(this.data.license)
                if (this.validate()) return false
                this.$http.post('/registration', this.data).then(res => {
                    if (res.status === 201) {
                        location.href = '/'
                    }
                }, err => {
                    if (+err.status === 400) {
                        this.serverError = true
                    }
                })
            },
            validate () {
                for (let key in this.data) {
                    switch (key) {
                        case 'name':
                            if (!this.data[key] && this.data[key].length < 3) {
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
                            if (!this.data[key] || this.data[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'phone':
                            if (!this.data[key] || this.data[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'price_city_id':
                            if (!this.data[key]) {
                                this.errors[key] = true
                            } else {
                                this.data[key] = +this.data[key]
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
            getCities () {
                this.$http.post('/api/get-prices', {}).then(res => {
                    this.cities = res.data.cities
                    $('.select').selectric('refresh')
            })
            }
        }
    }
</script>