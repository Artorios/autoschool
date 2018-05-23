<template>
    <div class="pass-change notes-config">
        <h4>Настройка уведомлений:</h4>
        <span style="color: green" v-if="success">Изменения успешно сохранены</span>
        <form v-on:submit.prevent="getNotifySettings">
            <div class="form-group">
                <input type="checkbox" true-value="1" false-value="0" id="mail" v-model="user.email_notice">
                <label for="mail">Получать уведомления на почту</label>
            </div>
            <div class="form-group">
                <input type="checkbox" true-value="1" false-value="0" id="tel" v-model="user.sms_notice">
                <label for="tel">Получать уведомления на телефон</label>
            </div>
            <button type="submit" class="btn-grey">Сохранить изменения</button>
        </form>
    </div>
</template>

<script type="text/babel">
    export default {
        data () {
            return {
                user: {
                    id: '',
                    email_notice: '',
                    sms_notice: ''
                },
                success: false,
            }
        },
        created () {
            this.getData()

        },
        props: {
          user: {}
        },
        methods: {

            getNotifySettings () {
                this.$http.post('/autoschool/edit-notify-settings', this.user).then(res => {
                    if (res.status === 204) {
                        this.success = true
                        location.href = "/autoschool/profile-edit"
                    }
                })

            }
        }
    }
</script>