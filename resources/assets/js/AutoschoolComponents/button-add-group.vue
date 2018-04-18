<template>
    <div class="btn-wrapper">
        <a @click.prevent="showForm" href="#" class="btn-grey">
            Добавить группу
        </a>
    </div>
</template>

<script>
    import {Events} from '../autoschool'
    export default {
        name: "button-add-group",
        methods: {
            showForm() {
                Events.$emit('show-form');
            },
        }
    }
</script>

<style scoped>

</style>