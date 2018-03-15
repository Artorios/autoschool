<template>
    <div class="timer-wrapper">
        <span>осталось Времени:</span>
        <div class="timer">
            <span class="hours">{{hours | two_digits}}</span>
            <span class="minutes">{{minutes | two_digits}}</span>
            <span class="seconds">{{seconds | two_digits}}</span>
        </div>
    </div>
</template>

<script type="text/babel">
    import moment from 'moment';
    import {Events} from '../../account'
    let interval = null
    export default {
        data () {
            return {
                now: Math.trunc((new Date()).getTime() / 1000),
                setTime: Math.trunc(Date.parse(moment().add(this.time, 'm')) / 1000)
            }
        },
        props: ['time'],
        created () {
            interval = window.setInterval(() => {
                this.now = Math.trunc((new Date()).getTime() / 1000);
            },1000);
        },
        watch: {
            now: function (val) {
                if (val === this.setTime) {
                    clearInterval(interval)
                    Events.$emit('time-ended')
                }
            }
        },
        computed: {
            seconds() {
                return (this.setTime - this.now) % 60;
            },
            minutes() {
                return Math.trunc((this.setTime - this.now) / 60) % 60;
            },
            hours() {
                return Math.trunc((this.setTime - this.now) / 60 / 60) % 24;
            }
        }
    }
</script>