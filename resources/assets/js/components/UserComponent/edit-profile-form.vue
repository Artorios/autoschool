<template>

    <form v-on:submit.prevent="editing">
        <p class="error" v-if="serverError">Произошла ошибка при изменении данных</p>
        <div class="form-group">
            <label>Имя пользователя:</label>
            <input type="text" v-model="user.name">
        </div>
        <div class="form-group">
            <label>Фамилия:</label>
            <input type="text" class="input-error" v-model="user.last_name">
        </div>
        <div class="form-group error-content">
            <label>Отчество:</label>
            <input type="text" v-model="user.second_name">
        </div>
        <div class="form-group">
            <label>Электронная почта:</label>
            <input type="email" v-model="user.email">
        </div>
        <div class="form-group">
            <label>Телефон:</label>
            <input type="phone" v-model="user.phone">
        </div>
        <div class="form-group">
            <label>Город: </label>
            <select class="select" id="city">
                <option v-for="city in cities" :selected="city.id === user.city_id"  v-bind:value="city.id"  >{{city.name}}</option>
            </select>
        </div>
        <div class="form-group">
            <label>Категория:</label>
            <select class="select" id="license">
                <option value="A" :selected="user.license === 'A'">A</option>
                <option value="B" :selected="user.license === 'B'">B</option>
                <option value="C" :selected="user.license === 'C'">C</option>
            </select>
        </div>
        <button type="submit" class="btn-grey">Сохранить изменения</button>
    </form>
</template>
<script type="text/babel">
    export default {
        data () {
            return {
                user: {
                    name: '',
                    last_name: '',
                    second_name: '',
                    email: '',
                    password: '',
                    phone: '',
                    city_id: '',
                    license: '',
                    id: ''
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
                serverError: '',

            }
        },
        created () {
                this.getData()

        },
        props:  ['cities'],

        methods: {
            getData () {
                this.$http.get('/account/auth-info-acc').then(res => {
                    this.user = res.data.user
                })
            },
            editing () {
                this.user.license = $('#license option:selected').text()
                this.user.city_id = $('#city option:selected').text()

                console.log(this.user.city_id)
                if (this.validate()) return false

                this.$http.post('/account/edit-profile', this.user).then(res => {
                    if (res.status === 201) {
                        location.href = '/account/edit-profile'
                    }
                }, err => {
                    if (+err.status === 400) {
                        this.serverError = true
                    }
                })
            },
            validate () {
                for (let key in this.user) {
                    switch (key) {
                        case 'name':
                            if (!this.user[key] && this.user[key].length < 3) {
                                this.$set(this.errors, key, true)
                            } else {
                                this.$set(this.errors, key, false)
                            }
                            break
                        case 'last_name':
                            if (!this.user[key] || this.user[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'second_name':
                            if (!this.user[key] || this.user[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'password':
                            if (!this.user[key] || this.user[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'phone':
                            if (!this.user[key] || this.user[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'city_id':
                            if (!this.user[key]) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'email':
                            if (!this.checkEmail(this.user[key])) {
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
            },

    }
</script>