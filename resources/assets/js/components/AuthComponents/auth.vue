<template>
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>Auto-tests</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Войти в аккаунт</p>
                <p class="error" v-if="notCorrect">Неправильный логин и/или пароль</p>
                <div class="form-group has-feedback" :class="{'has-error': hasError.email}">
                    <input type="email" class="form-control" placeholder="Email" v-model="data.email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback" :class="{'has-error': hasError.password}">
                    <input type="password" class="form-control" placeholder="Password" v-model="data.password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" @click="logIn">Войти</button>
                    </div>
                    <!-- /.col -->
                </div>


        </div>
        <!-- /.login-box-body -->
    </div>
</template>

<script>
    export default {
        data () {
            return {
                data: {
                    email: '',
                    password: ''
                },
                hasError: {
                    password: false,
                    email: false
                },
                notCorrect: false
            }
        },
        methods: {
            validate () {
                for (let key in this.data) {
                    switch (key) {
                        case 'email':
                            if (!this.checkEmail(this.data[key])) {
                                this.hasError.email = true
                            } else {
                                this.hasError.email = false
                            }
                            break
                        case 'password':
                            if (!this.data[key]) {
                                this.hasError.password = true
                            } else {
                                this.hasError.password = false
                            }
                    }
                }
                let hasError = false
                for (let key in this.hasError) {
                    if (this.hasError[key]) {
                        hasError = true
                    }
                }
                return hasError
            },
            checkEmail (email) {
                let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                return re.test(email.toLowerCase());

            },
            logIn () {
                if (this.validate()) return false
                this.$http.post('/admin/login', this.data).then(res => {
                    if (res.status === 202) {
                        location.href = res.data.url
                    }
                }, err => {
                    if (err.status === 400) {
                        this.notCorrect = true
                    }
                })
            }
        }
    }
</script>