<template>
    <div class="details">
        <h3>Реквизиты юр. лица:</h3>
        <form>
            <div class="form-group">
                <label>ИНН:</label>
                <input type="text" :value="profile.taxpayerIdentificationNumber" placeholder="*****">
            </div>
            <div class="form-group">
                <label>Сокращенное наименование организации: </label>
                <input type="text" :value="profile.abbreviatedNameOfTheOrganization"  placeholder="ООО Франчайзи ">
            </div>
            <div class="form-group">
                <label>Полное наименование организации:</label>
                <input type="text" :value="profile.fullNameOfTheOrganization" placeholder="Общество с ограниченной ответвеностью Франчайзи ">
            </div>
            <div class="form-group">

                <label>КПП:</label>
                <input :value="profile.codeOfReason" type="text" placeholder="*****">
            </div>
            <div class="form-group">
                <label>Дата государственной регистрации: </label>
                <input :value="profile.dateOfStateRegistration" type="text" placeholder="01.12.2017">
            </div>
            <div class="form-group">
                <label>Ген. директор: </label>
                <input :value="profile.director" type="text" placeholder=" Иванов Иван Иванович">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data (){
            return {

            }
        },
        props: ['profile']
    }
</script>

<style scoped>

</style>