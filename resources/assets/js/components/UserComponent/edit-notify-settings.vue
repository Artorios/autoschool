<template>
    <div class="pass-change notes-config">
        <h4>Настройка уведомлений:</h4>
        <form v-on:submit.prevent="getNotifySettings">
            <div class="form-group">
                <input type="checkbox" true-value="1" false-value="0" id="mail" v-model="user.notify_email">
                <label for="mail">Получать уведомления на почту</label>
            </div>
            <div class="form-group">
                <input type="checkbox" true-value="1" false-value="0" id="tel" v-model="user.notify_phone">
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
                    notify_email: '',
                    notify_phone: ''
                },

            }
        },
        created () {
            this.getData()

        },

        methods: {
            getData () {
                this.$http.get('/account/auth-info-acc').then(res => {
                    this.user = res.data.user
                })
            },
            getNotifySettings () {
                this.$http.post('/account/edit-notify-settings', this.user).then(res => {
                    if (res.status === 204) {
                        location.href = '/account/edit-profile'
                    }
                })

            }
        }
    }
</script>