<template>
    <div>
        <div class="row add-student">
            <div class="col-md-6">
                <div class="error-server error" v-if="serverError">Произошла ошибка при регистрации</div>
                <ul class="error-list error" v-if="registerErrors">
                    <li v-for="error in registerErrors">{{ error[0] }}</li>
                </ul>
                    <div class="form-group">
                        <p class="error" v-if="errors.name">Имя должно быть минимум 3 символа</p>
                        <input type="text"  class="form-control" placeholder="Имя*" v-model="data.name" v-bind:class="{ 'input-error': errors.name}">
                    </div>
                    <div class="form-group">
                        <p class="error" v-if="errors.last_name">Фамилия должна быть минимум 3 символа</p>
                        <input type="text"  class="form-control" placeholder="Фамилия*" v-model="data.last_name" v-bind:class="{ 'input-error': errors.last_name}">
                    </div>
                    <div class="form-group">
                        <p class="error" v-if="errors.second_name">Отчество должно быть минимум 3 символа</p>
                        <input type="text"  class="form-control" placeholder="Отчество" v-model="data.second_name" v-bind:class="{ 'input-error': errors.second_name}">
                    </div>
                    <div class="form-group">
                        <p class="error" v-if="errors.email">Не правильный email</p>
                        <input type="text"  class="form-control" placeholder="Электронная почта*" v-model="data.email" v-bind:class="{ 'input-error': errors.email}">
                    </div>
                    <div class="form-group">
                        <p class="error" v-if="errors.phone">Не правильный телефон</p>
                        <input type="text"  class="form-control" placeholder="Телефон*" v-model="data.phone" v-bind:class="{ 'input-error': errors.phone}">
                    </div>
                    <div class="form-group">
                    <p class="error" v-if="errors.license">Выберите категорию</p>
                        <select class="select" id="license" v-model="data.license">
                            <option disabled value="">Категория*</option>
                            <option value="A" >A</option>
                            <option value="B" >B</option>
                            <option value="C" >C</option>
                        </select>
                    </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <p class="error" v-if="errors.coupon">Выберите купон</p>
                    <select class="select" id="coupon" v-model="data.coupon">
                        <option disabled value="">Купон*</option>
                        <option v-if="coupons" v-for="(item, index) in coupons" v-text="item.code" v-bind:value="item.id"></option>
                        <option v-else v-text="'Нет купонов'" v-bind:value="'0'"></option>
                    </select>
                </div>
                <div class="form-group">
                    <p class="error" v-if="errors.auto_school_group_id">Выберите групу</p>
                    <select class="select" id="auto_school_group_id" v-model="data.auto_school_group_id">
                        <option disabled value="">Група*</option>
                        <option v-for="(item, index) in groups" v-bind:value="item.id" v-text="item.name"></option>
                    </select>
                </div>
                <div class="form-group">
                    <p class="error" v-if="errors.city_id">Выбирите город</p>
                    <select class="select"  id="city_id" v-model="data.city_id">
                        <option disabled value="">Ваш город*</option>
                        <option :value="city.id" v-for="city in cities">{{city.name}}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="addstudent">
            <a href="#" class="btn-grey" @click="registration()"> Добавить</a>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                data: {
                    name: '',
                    last_name: '',
                    second_name: '',
                    email: '',
                    phone: '',
                    coupon: '',
                    auto_school_group_id: '',
                    license: '',
                    city_id: '',
                },
                errors: {
                    name: false,
                    last_name: false,
                    second_name: false,
                    email: false,
                    phone: false,
                    coupon: false,
                    auto_school_group_id: false,
                    license: false,
                    city_id: false,
                },
                serverError: false,
                registerErrors: false,

            }
        },
        props: {
            schools: {},
            groups: {},
            coupons: {},
            cities: {}
        },


        mounted () {
            let vm = this
            $('#coupon').selectric({
                onChange: function(element) {
                    vm.data.coupon = $(element).val()
                },
            })
            $('#auto_school_group_id').selectric({
                onChange: function(element) {
                    vm.data.auto_school_group_id = $(element).val()
                },
            })
            $('#license').selectric({
                onChange: function(element) {
                    vm.data.license = $(element).val()
                },
            })

            $('#city_id').selectric({
                onChange: function(element) {
                    vm.data.city_id = $(element).val()
                },
            })
        },
        methods: {
            registration () {
                if (this.validate()) return false

                this.$http.post('/autoschool/save-new-student', this.data).then(res => {
                    if (res.status === 201) {
                        location.href = '/autoschool/filials/groups/' + res.data.group
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
                        case 'phone':
                            if (!this.checkPhone(this.data[key])) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'coupon':
                            if (!this.data[key]) {
                                this.errors[key] = true
                            } else {
                                this.data[key] = +this.data[key]
                                this.errors[key] = false
                            }
                            break
                        case 'auto_school_group_id':
                            if (!this.data[key]) {
                                this.errors[key] = true
                            } else {
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
                        case 'city_id':
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
                console.log(hasError)
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
        }
    }
</script>

<style scoped>

</style>