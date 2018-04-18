<template>
    <div>
        <div class="btn-wrapper">
            <a @click.prevent="visible=true" href="#" class="btn-grey">
                Добавить филиал
            </a>
        </div>
        <create-filial v-if="visible"></create-filial>
    </div>
</template>

<script>
    import CreateFilial from './create-filial'
    import {Events} from '../autoschool'
    export default {
        name: "button-add-filial",
        data () {
            return {
                visible: false,
            }
        },
        computed: {

        },

        components:{
            CreateFilial
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