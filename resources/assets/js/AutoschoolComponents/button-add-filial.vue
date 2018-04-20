<template>
    <div class="btn-wrapper">
        <a @click.prevent="showForm" href="#" class="btn-grey">
            Добавить филиал
        </a>
    </div>
</template>

<script>
    import {Events} from '../autoschool'
    export default {
        name: "button-add-filial",
        methods: {
            showForm() {
                Events.$emit('show-form');
            },
        }
    }
</script>

<style scoped>

</style>