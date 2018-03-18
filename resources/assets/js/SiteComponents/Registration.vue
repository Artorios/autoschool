<template>
    <div class="main-wrapper">
        <div class="registration">

            <div class="container">
                <div class="registration-wrapper">
                    <h3>Регистрация</h3>
                    <form v-on:submit.prevent="registration">
                        <p class="error" v-if="errors">Произошла ошибка при регистрации</p>
                        <div>
                            <div v-bind:class="{'has-error': errors.name}">
                                <input type="text" placeholder="Имя*" v-model="data.name">
                                <span v-if="errors.name" class="control-label">{{ errors.name[0] }}</span>
                            </div>

                            <div v-bind:class="{'has-error': errors.last_name}">
                                <input type="text" placeholder="Фамилия*" v-model="data.last_name">
                                <span v-if="errors.last_name" class="control-label">{{ errors.last_name[0] }}</span>
                            </div>

                            <div v-bind:class="{'has-error': errors.second_name}">
                                <input type="text" placeholder="Отчество" v-model="data.second_name">
                                <span v-if="errors.second_name" class="control-label">{{ errors.second_name[0] }}</span>
                            </div>

                        </div>
                        <div class="right">
                            <div v-bind:class="{'has-error': errors.email}">
                                <input type="email" placeholder="Электронная*" v-model="data.email">
                                <span v-if="errors.email" class="control-label">{{ errors.email[0] }}</span>
                            </div>

                            <div v-bind:class="{'has-error': errors.phone}">
                                <input type="text" placeholder="Телефон*" v-model="data.phone">
                                <span v-if="errors.phone" class="control-label">{{ errors.phone[0] }}</span>
                            </div>

                            <div v-bind:class="{'has-error': errors.password}">
                                <input type="password" placeholder="Пароль*" v-model="data.password">
                                <span v-if="errors.password" class="control-label">{{ errors.password[0] }}</span>
                            </div>

                            <!--<div v-bind:class="{'has-error': errors.city}">-->
                                <!--<select class="select" v-model="data.city">-->
                                    <!--<option selected disabled>Ваш город*</option>-->
                                    <!--<option :value="city.id" v-for="city in cities">{{city.name}}</option>-->
                                <!--</select>-->
                                <!--<span v-if="errors.city" class="control-label">{{ errors.city[0] }}</span>-->
                            <!--</div>-->

                            <div v-bind:class="{'has-error': errors.city}">
                                <select class="select" v-model="data.city">
                                    <option selected disabled>Ваш город*</option>
                                    <option :value="city.id" v-for="city in cities">{{city.name}}</option>
                                </select>
                                <span v-if="errors.city" class="control-label">{{ errors.city[0] }}</span>
                            </div>
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
                    city: ''
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
            $('.select').selectric({
                onChange: function(element) {
                    vm.data.city = $(element).val()
                },
            })
//            this.getCities()
        },
//        munted () {
//        },
        methods: {
            registration () {
//                if (this.validate()) return false

                this.$http.post('/registration', this.data).then(res => {
                    if (res.status === 201) {
                        location.href = '/'
                    }
                }, response => {
					if (response.body.errors) {
						this.errors = response.body.errors;
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