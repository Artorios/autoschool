<template>
    <div class="img-profile text-center img  photo-edit-container">
        <img :src="imgDataUrl" alt="" class="upload-image">
        <a class="photo-edit" href="#" @click="toggleShow">
            <i class="fa fa-pencil" aria-hidden="true"></i>
        </a>
        <upload-profile-photo
                field="img"
                @crop-success="cropSuccess"
                @crop-upload-success="cropUploadSuccess"
                @crop-upload-fail="cropUploadFail"
                v-model="show"
                lang-type = "ru"
                :width="200"
                :height="200"
                :border="1"
                url="/autoschool/profile-logo-edit"
                :params="params"
                :headers="headers"
                img-format="png">
        </upload-profile-photo>
    </div>
</template>

<script>
    import UploadProfilePhoto from 'vue-image-crop-upload'
    export default {
        name: "autoschool-profile-logo",
        data: function() {
            return {
                show: false,
                params: {
                    token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    name: 'img',
                    filialId: ''
                },
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    smail: '*_~'
                },
                serverError: '',
                imgDataUrl: ''
            }
        },
        props: {
            filial: {}
        },
        components: {
            UploadProfilePhoto
        },
        watch: {
            filial () {
                this.params.filialId = this.filial.id
                this.imgDataUrl = '/storage/school/' + this.filial.logo
            }
        },
        methods: {
            toggleShow() {
                this.show = !this.show;
            },
            cropSuccess(imgDataUrl, field){
                console.log('-------- crop success --------');
                this.imgDataUrl = imgDataUrl;
            },
            cropUploadSuccess(jsonData, field){
                console.log('-------- upload success --------');
                console.log(jsonData);
                console.log('field: ' + field);
            },
            cropUploadFail(status, field){
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);
            }
        },
        created () {
            if(this.filial.logo){
                this.imgDataUrl = '/storage/school/' + this.filial.logo
            }else{
                this.imgDataUrl = '/img/img/prof-photo-full.png'
            }
        },
        mounted() {
            this.params.filialId = this.filial.id
        },
    }
</script>

<style scoped>
    .img .upload-image{
        border-radius: 50%;
        border: 1px solid #ccc;
    }
</style>