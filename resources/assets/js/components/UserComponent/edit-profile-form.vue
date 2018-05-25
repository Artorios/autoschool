<template>

    <form v-on:submit.prevent="editing">
        <p class="error" style="color: red" v-if="serverError">Произошла ошибка при изменении данных</p>
        <div class="form-group">
            <label>Имя пользователя:</label>
            <input type="text" v-model="userProfile.name" v-bind:class="{'input-error': errors.name}" minlength="2" required>
        </div>
        <div class="form-group">
            <label>Фамилия:</label>
            <input type="text"  v-model="userProfile.last_name" v-bind:class="{'input-error': errors.last_name}" minlength="2" required>
        </div>
        <div class="form-group error-content">
            <label>Отчество:</label>
            <input type="text" v-model="userProfile.second_name" v-bind:class="{'input-error': errors.second_name}">
        </div>
        <div class="form-group">
            <label>Электронная почта:</label>
            <input type="email" v-model="userProfile.email" v-bind:class="{'input-error': errors.email}" minlength="7" required>
        </div>
        <div class="form-group">
            <label>Телефон:</label>
            <input type="tel" required  v-model="userProfile.phone" v-bind:class="{ 'input-error': errors.phone}" minlength="5" pattern="[0-9]{5,16}">
        </div>
        <div class="form-group">
            <label>Город: </label>
            <select class="select" id="city">
                <option v-for="city in cities" :selected="city.id == userdata.city_id"  v-bind:value="city.id"  >{{city.name}}</option>
            </select>
        </div>
        <div class="form-group">
            <label>Категория:</label>
            <select class="select" id="license">
                <option value="A" :selected="userdata.license == 'A'">A</option>
                <option value="B" :selected="userdata.license == 'B'">B</option>
                <option value="C" :selected="userdata.license == 'C'">C</option>
            </select>
        </div>
        <button type="submit" class="btn-grey">Сохранить изменения</button>
    </form>
</template>
<script type="text/babel">
    export default {
        data () {
            return {
                userProfile: {
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
        props: {
            cities: {},
            userdata: {}
        },

        created () {
            this.getData()
        },

        mounted () {
            let vm = this
            $('#city').selectric({
                onChange: function(element) {
                    vm.userProfile.city_id = $(element).val()
                },
            })
            $('#license').selectric({
                onChange: function(element) {
                    vm.userProfile.license = $(element).val()
                },
            })
//            this.getCities()
        },
        methods: {
            getData () {
                this.$http.get('/account/auth-info-acc').then(res => {
                    this.userProfile = res.data.user
                })
            },

            editing () {

                if (this.validate()) return false
                this.$http.post('/account/edit-profile', this.userProfile).then(res => {
                    if (res.status === 201) {
                        location.href = '/account/edit-profile'
                    }
                }, err => {
                    if (+err.status === 400) {
                        this.serverError = true
                    }
                    if (+err.data.status == 5){
                        this.errors.email = true
                    }

                })
            },
            validate () {
                for (let key in this.userProfile) {
                    switch (key) {
                        case 'name':
                            if (!this.userProfile[key] || this.userProfile[key].length < 3) {
                                this.$set(this.errors, key, true)
                            } else {
                                this.$set(this.errors, key, false)
                            }
                            break
                        case 'last_name':
                            if (!this.userProfile[key] || this.userProfile[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'second_name':
                            if (this.userProfile[key] && this.userProfile[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'password':
                            if (!this.userProfile[key] || this.userProfile[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'phone':
                            if (!this.userProfile[key] || this.userProfile[key].length < 3 ) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'city_id':
                            if (!this.userProfile[key]) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'email':
                            if (!this.checkEmail(this.userProfile[key])) {
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

            },

    }
</script>