<template>
    <div class="main-wrapper">
        <div class="login">
            <div class="container">
                <div class="login-wrapper">
                    <form class="left" v-on:submit.prevent="login">
                        <h3>Авторизация</h3>
                        <span>Войти на сайт используя e-mail и пароль</span>

                        <div v-bind:class="{'has-error': errors.email}">
                            <input type="text" placeholder="Ваш e-mail" v-model="data.email">
                            <span v-if="errors.email" class="control-label">{{ errors.email[0] }}</span>
                        </div>

                        <div v-bind:class="{'has-error': errors.password}">
                            <input type="password" placeholder="Пароль" v-model="data.password">
                            <span v-if="errors.password" class="control-label">{{ errors.password[0] }}</span>
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
                serverError: false
            }
        },
        methods: {
            login () {
//                if (this.validate()) return false

                this.$http.post('/login', this.data).then(res => {
                    if (res.status === 202) {
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
                        case 'password':
                            if (!this.data[key] || this.data[key].length < 3) {
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