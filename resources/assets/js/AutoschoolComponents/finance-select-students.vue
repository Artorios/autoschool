<template>

</template>

<script>
    export default {
        data (){

            return {

            }
        },
        props: {
            students: {}
        },
        methods: {
            fullName(item){
                return item.studentName + " " + item.studentSecondName + " " + item.studentLastName
            },
        }
    }
</script>

<style scoped>

</style>