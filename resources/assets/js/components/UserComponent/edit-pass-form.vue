<template>
    <div class="pass-change">
        <h4>Смените пароль:</h4>
        <span>Внимание! Пароль должен содержать цифру, заглавную и строчную букву и иметь длинну от 8 до 25 символов</span><br>
        <span style="color: red" v-if="passError === true">Неверно указан старый пароль</span>
        <span style="color: red" v-if="passConfirmError === true">Содержание полей должно быть одинаковым</span>
        <span style="color: red" v-if="passNullError === true">Не все данные введены</span>
        <form v-on:submit.prevent="editing_pass">
            <div class="form-group">
                <label>Старый пароль </label>
                <input type="password" v-model="password">
            </div>
            <div class="form-group">
                <label>Новый пароль </label>
                <input type="password" v-model="new_password">
            </div>
            <div class="form-group">
                <label>Подтверждение</label>
                <input type="password" v-model="confirm_password">
            </div>
            <button type="submit" class="btn-grey">Сохранить изменения</button>
        </form>
    </div>
</template>
<script type="text/babel">
    export default {
        data () {
            return {
                password: '',
                new_password: '',
                confirm_password: '',
                passError: false,
                passConfirmError: false,
                passNullError: false,
                pass: {
                    password: '',
                    new_password: ''
                }

            }
        },


        methods: {
            editing_pass () {
//                if (this.validate()) return false
                if(!this.password) {
                    this.passNullError = true
                    return false
                }
                else{
                    this.passNullError = false
                }
                if(!this.new_password) {
                    this.passNullError = true
                    return false
                }
                else{
                    this.passNullError = false
                }
                if(!this.confirm_password) {
                    this.passNullError = true
                    return false
                }
                else{
                    this.passNullError = false
                }
                if(this.new_password != this.confirm_password)
                {
                    this.passConfirmError = true
                    return false
                }
                else{
                    this.passConfirmError = false
                }
                this.pass.password = this.password
                this.pass.new_password = this.new_password
                this.$http.post('/account/edit-pass', this.pass).then(res => {
                if (res.status === 205) {
                        location.href = '/account/edit-profile'
                    }
                }, err => {
                    if (+err.status === 400) {
                            this.password = +err.data.password
                            this.passError = true

                    }
                })
            },

        },

    }
</script>