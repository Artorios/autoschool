<template>


    <div class="form-group">
        <autocomplete
                :url="'/api/get-autoschool-city-api/'+user.id"
                anchor="title"
                label="filial_name"
                :initValue="checkedSchool ? checkedSchool['title'] : ''"
                :classes="{ wrapper: 'form-wrapper', input: 'form-control', list: 'data-list', item: 'data-list-item' }"
                :on-select="getDataSchool">
        </autocomplete>
        <button class="btn btn-grey" @click="choice">Выбрать</button>
    </div>


</template>

<script>

    import {Events} from '../../account'

    require('vue2-autocomplete-js/dist/style/vue2-autocomplete.css')
    import Autocomplete from 'vue2-autocomplete-js'

    export default {
        name: "choice-autoschool",
        data() {
            return {
                checkedSchool: '',
                data: {
                    school: ''
                }
            }
        },
        components: {
            Autocomplete
        },
        props: ['user'],
        methods: {
            getDataSchool(val) {
                this.checkedSchool = val.id
            },
            choice() {
                if (this.checkedSchool) {
                    this.data.school = this.checkedSchool
                    this.$http.post('/account/finance/choice-autoschool', this.data).then(res => {
                        if (res.status === 201) {
                            location.href = '/account/finance'
                            // console.log(res.data)
                        } else {
                            this.errorEdit = true
                        }
                    }, err => {
                        this.errorEdit = true
                    })
                }
            }
        }

    }
</script>
