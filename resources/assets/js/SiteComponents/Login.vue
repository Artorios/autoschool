<template>
    <div class="main-wrapper">
        <div class="login">
            <div class="container">
                <div class="login-wrapper">
                    <form class="left" v-on:submit.prevent="login">
                        <h3>Авторизация</h3>
                        <span>Войти на сайт используя e-mail и пароль</span>
                        <div class="error" v-if="loginErrors">
                            <ul>
                                <li v-for="error in loginErrors">{{ error[0] }}</li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <p class="error" v-if="errors.email">Не правильный email</p>
                            <input type="text" placeholder="Ваш e-mail" v-model="data.email">
                        </div>
                        <div class="form-group">
                            <p class="error" v-if="errors.password">Длина пароля должна быть минимум 6 символов</p>
                            <p class="error" v-if="passwordError">{{ passwordError }}</p>
                            <input type="password" placeholder="Пароль" v-model="data.password">
                        </div>
                        <button type="submit" class="btn-red">Войти</button>
                        <div class="link-wrapper">
                            <a href="#">Забыли пароль</a>
                        </div>
                    </form>
                    <div class="right">
                        <span>Или Вы можете войти через одну из учетных записей:</span>
                        <div class="socials">
                            <a href="/user/redirect/facebook" class="facebook"></a>
                            <a href="/user/redirect/vkontakte" class="vk"></a>
                            <a href="#" class="ok"></a>
                            <a href="/user/redirect/twitter" class="twitter"></a>
                            <a href="#" class="yandex"></a>
                            <a href="#" class="mail"></a>
                        </div>
                        <a href="/registration" class="btn-red">Зарегистрироваться</a>
                    </div>
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
                    email: '',
                    password: ''
                },
                errors: {
                    email: false,
                    password: false
                },
                serverError: false,
                loginErrors: [],
                passwordError: ''
            }
        },
        methods: {
            login () {
                if (this.validate()) return false

                this.$http.post('/login', this.data).then(res => {
                    if (res.status === 202) {
                        location.href = '/'
                    }
                }, err => {
                    if (+err.status === 400) {
                        this.serverError = true
                        this.loginErrors = err.data['loginErrors']
                        this.passwordError = err.data['passwordError']
                    }
                })
            },
            validate () {
                for (let key in this.data) {
                    switch (key) {
                        case 'password':
                            if (!this.data[key] || this.data[key].length < 6) {
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

            }
        }
    }
</script>
