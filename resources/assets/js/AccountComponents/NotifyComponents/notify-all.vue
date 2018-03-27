<template>
    <div class="notice-wrapper">

        <div v-for="notify in notifies" class="for-pagination"   id="notify.id">
            <div class="line active"   v-if="notify.status == 1"  v-on:click="classActive(notify.id)"  :id="notify.id" >
                <span class="date-time"><img src="/img/clock.png" alt="">{{editDate(notify.date)}} {{editTime(notify.time)}}</span>
                <p>{{notify.notify}}</p>
            </div>
            <div class="line" v-else="notify.status == 0">
                <span class="date-time" ><img src="/img/clock.png" alt="">{{editDate(notify.date)}} {{editTime(notify.time)}}</span>
                <p>{{notify.notify}}</p>
            </div>


        </div>


    </div>

</template>
<script type="text/babel">
    export default {
        data () {
            return {
                notifies: {
                    user_id: '',
                    id: '',
                    date: '',
                    time: '',
                    notify: '',
                    status: ''
                }


            }
        },
        created () {
//            this.getData()

        },
        props: ['notifies'],

        methods: {
            editDate(date){
                var dateTemp = date.split('-')
                date = dateTemp['2']+'.'+dateTemp['1']+'.'+dateTemp['0']
                return date
            },
            editTime(time){
                var timeTemp = time.split(':')
                time = timeTemp['0']+':'+timeTemp['1']
                return time
            },
            classActive(elemActive){
                $('#'+elemActive).removeClass('active')
                this.$http.post('/account/notify-read', elemActive).then(res => {
                    if (res.status === 204) {
                        return true
                    }
                })
                return false
            },
            clickCallback(pageNum) {
                console.log(pageNum)
            }
            /*getData () {
             this.$http.get('/account/auth-info-acc').then(res => {
             this.user = res.data.user
             })
             },*/
            /*getNotifySettings () {
             this.$http.post('/account/edit-notify-settings', this.user).then(res => {
             if (res.status === 204) {
             location.href = '/account/edit-profile'
             }
             })

             }*/
        }
    }
</script>