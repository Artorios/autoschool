<template>
    <div class="blockform">
        <div class="error-server error" v-if="serverError">Произошла ошибка</div>
        <form action="">
            <div class="row nero">
                <div class="col-xs-12 col-sm-4">
                    <span class="error" v-if="errors.name">Введите имя филиала</span>
                    <input v-model.trim="data.name" v-bind:class="{'input-error': errors.name}" id="name" type="text" class="name-group" placeholder="Название филиала" required="">
                </div>
                <div class="col-xs-6 col-sm-2">
                    <span class="error" v-if="errors.address">Введите адрес филиала</span>
                    <input v-model.trim="data.address" v-bind:class="{'input-error': errors.address}" id="date" type="text" class="data" placeholder="Адрес филиала" required="">
                </div>
                <div class="col-xs-12 col-sm-3">
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
        name: "create-filial",
        data (){
            return{
                data:{
                    name: "",
                    address: "",
                },
                errors:{
                    name: false,
                    address: false,
                },
                serverError: false,
                createErrors: []
            }
        },
        methods: {
            sendDataToServer () {
                if (this.validate()) return false

                this.$http.post('/autoschool/filials/create', this.data).then(res => {
                    if (res.status === 201) {
                        location.href = '/autoschool/filials'
                    }
                }, err => {
                    if (+err.status === 400) {
                        this.serverError = true
                        this.createErrors = err.data['errors']
                    }
                })
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
                        case 'address':
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
                return hasError
            },
            closeForm (){
                Events.$emit('close-form');
            },

        }
    }
</script>

<style scoped>

</style>