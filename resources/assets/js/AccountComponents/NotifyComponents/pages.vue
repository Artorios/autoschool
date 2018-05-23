<template>
    <ul class="pagination" v-if="pages && page && total">
        <li class="page-item" v-for="n in Math.ceil(pages/total)">

            <a :href="url+n" v-if="page == n" class="active">{{n}}</a>
            <a :href="url+n" v-else>{{n}}</a>
        </li>
    </ul>
</template>
<script type="text/babel">
    export default {
        data() {
            return {
                n: 1,
                numbers: '',
                numbersPage: '',
                url: '?page='


            }
        },


        props:['pages','page', 'total'],


    }
</script>