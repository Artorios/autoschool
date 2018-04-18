<template>
    <div class="blockform">
        <form action="">
            <div class="row nero">
                <div class="col-xs-12 col-sm-4">
                    <input v-model="data.name" id="name" type="text" class="name-group" placeholder="Название группы" required="">
                </div>
                <div class="col-xs-6 col-sm-2">
                    <input v-model="data.exam_date" id="date" type="text" class="data" placeholder="Дата" required="">
                </div>
                <div class="col-xs-6 col-sm-2">
                    <input v-model="data.exam_time" id="time" type="text" class="time" placeholder="Время" required="">
                </div>
                <div class="col-xs-12 col-sm-3">
                    <a href="#" class="btn-grey" v-on:click.prevent="sendDataToServer()">Сохранить</a>
                </div>
                <span class="close"></span>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['group'],
        name: "edit-group",
        data (){
            return{
                data:{
                    name: "",
                    exam_date: "",
                    exam_time: ""
                }
            }
        },
        methods: {
            sendDataToServer () {
                this.$http.post('/autoschool/filials/create', this.data).then(res => {
                    if (res.data.status === 'passed') {
                        console.log(res,111111111111111111)
                    } else {
                        console.log(res, 22222222222222222222)
                    }
                })
            }
        }
    }

</script>

<style scoped>

</style>