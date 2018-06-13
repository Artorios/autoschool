<template>
    <div class="blockform">
        <div class="error-server error" v-if="serverError">Произошла ошибка</div>
        <form action="">
            <div class="row nero">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                    <input v-model.trim="data.name" v-bind:class="{'input-error': errors.name}" id="name" type="text"
                           class="name-group" placeholder="Название группы" required="">
                </div>
                <div class="col-xs-6 col-sm-5 col-md-5 col-lg-2">
                    <div class="data data-small">
                        <input v-model.trim="data.exam_date" v-bind:class="{'input-error': errors.exam_date}"
                                v-mask="'9999-99-99'" id="date" type="text"  placeholder="Дата" required="">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-2">
                    <span class="error" v-if="errors.exam_time">Время должно быть в формате ЧЧ:ММ</span>
                    <div class="time time-small">
                        <input v-model.trim="data.exam_time" v-bind:class="{'input-error': errors.exam_time}"
                                v-mask="'99:99'" id="time" type="text" placeholder="Время" required="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                    <a href="#" class="btn-grey" v-on:click.prevent="sendDataToServer()">Сохранить</a>
                </div>
                <span class="close" @click="closeForm"></span>
            </div>
        </form>
    </div>
</template>

<script>
    import {Events} from '../autoschool'
    export default {
        name: "create-group",
        data (){
            return {
                data: {
                    name: "",
                    exam_date: "",
                    exam_time: "",
                },
                errors: {
                    name: false,
                    exam_date: false,
                    exam_time: false
                },
                serverError: false,
                createErrors: []
            }
        },
        props: ['filial'],
        methods: {
            sendDataToServer () {
                if (this.validate()) return false
                this.data.auto_school_id = this.filial.id
                this.$http.post('/autoschool/filials/groups/create', this.data).then(res => {
                    if (res.status === 201) {
                        location.href = '/autoschool/filials/' + this.filial.id
                    }
                }, err => {
                    if (+err.status === 400) {
                        this.serverError = true
                        this.createErrors = err.data['errors']
                    }
                })
            },
            closeForm (){
                Events.$emit('close-form');
            },
            validate () {
                for (let key in this.data) {
                    switch (key) {
                        case 'name':
                            if (!this.data[key] || this.data[key].length > 255) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'exam_date':
                            if (!this.data[key]) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'exam_time':
                            if (!this.checkTime(this.data[key])) {
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
            checkTime (time){
                let re = /^([0-1][0-9]|2[0-3]):([0-5][0-9])$/
                return re.test(time);
            }
        }
    }

</script>

<style scoped>

</style>