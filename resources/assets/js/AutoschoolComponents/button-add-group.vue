<template>
    <div>
        <div class="btn-wrapper">
            <a @click.prevent="visible=true" href="#" class="btn-grey">
                Добавить группу
            </a>

        </div>
    <create-group v-if="visible"></create-group>
    </div>

</template>

<script>
    import CreateGroup from './create-group'
    import {Events} from '../autoschool'
    export default {
        name: "button-add-group",
        data () {
            return {
                visible: false,
            }
        },
        computed: {

        },

        components:{
            CreateGroup
        },
        methods: {

        },
        created () {
            Events.$on('close-form', () => {
                this.visible = false
            })
        },
    }
</script>

<style scoped>

</style>