<template>
    <div class="img">
        <img class="upload-image" :src="imgDataUrl" alt="">
        <a href="#" class="photo-edit" @click="toggleShow">
            <img src="/img/img/pencil.png" alt="">
        </a>
        <upload-profile-photo
                   field="img"
                   @crop-success="cropSuccess"
                   @crop-upload-success="cropUploadSuccess"
                   @crop-upload-fail="cropUploadFail"
                   v-model="show"
                   lang-type = "ru"
                   :width="125"
                   :height="125"
                   :border="1"
                   url="/account/profile-save-image"
                   :params="params"
                   :headers="headers"
                   img-format="png"></upload-profile-photo>
    </div>
</template>

<script>
    import UploadProfilePhoto from 'vue-image-crop-upload'
    export default {
        name: "profile-photo",
        data () {
            return {
                show: false,
                params: {
                    token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    name: 'img',
                },
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    smail: '*_~'
                },
                serverError: '',
                imgDataUrl: ''
            }
        },
        props:  ['user'],
        components: {
            UploadProfilePhoto
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
            if(this.user.image){
                this.imgDataUrl = '/storage/user/' + this.user.image
            }else{
                this.imgDataUrl = '/img/img/prof-photo-full.png'
            }
        },
    }
</script>

<style scoped>
    .img .upload-image{
        border-radius: 50%;
        border: 1px solid #ccc;
    }
</style>