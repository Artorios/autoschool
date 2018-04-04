<template>
    <div>
        <div class="modal-backdrop in "></div>
        <div class="modal school in" id="schoolModal" @click.self="close" style="display: block;" tabindex="-1"
             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body city-choose">
                    <span class="close" data-dismiss="modal" aria-label="Close" @click="close">
                    </span>
                        <div class="modal-toggle" data-dismiss="modal" aria-label="Close">
                            <span>Адреса автошкол</span>
                        </div>

                        <h3>
                            Список автошкол партнеров сервиса Автотренер в {{checkedCity ? 'г. ' + checkedCity.name : 'городах'}}:</h3>
                        <div class="wrapper row" v-for="school in schools">
                            <div class="col-md-4 left">
                                <ul>
                                    <li >
                                        <a href="#">{{school.title}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-8 right">
                                <div class="ul-wrapper" >
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="adress" v-if="school.addresses[0]">
                                                    <li v-for="addres in school.addresses" >
                                                        <img src="/img/location.png" alt="">
                                                        <span v-if="school.city.name">{{'г. '+school.city.name}}</span>
                                                        <span v-if="addres.value">{{addres.value}}</span>
                                                    </li>
                                                </ul>
                                                <ul class="adress" v-else>
                                                    <li >
                                                        <img src="/img/location.png" alt="">
                                                        <span v-if="school.city.name">{{'г. '+school.city.name}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="tel" v-if="school.phones">
                                                    <li v-for="phone in school.phones">
                                                        <img src="/img/tel.png" alt="">
                                                        <span>{{phone.value}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import {Events} from "../../../siteApp"
    export default {
        data () {
            return {
                schools: null,
                checkedSchool: null,
                checkedCity: JSON.parse(localStorage.getItem('city'))
            }
        },
        created () {
            this.getData()
        },
        mounted () {
            //$('body').addClass('modal-open')
        },
        methods: {
            getData () {
                let id = ''
                if (this.checkedCity) {
                    id = this.checkedCity.id
                }
                this.$http.get('/schools/' + id).then(res => {
                    if (res.status === 200) {
                        this.schools = res.data
                        this.checkedSchool = this.schools[0]
                    }
                })
            },
            checkedSchoolFunc (school) {
                this.checkedSchool = school
            },
            close () {
                $('body').removeClass('modal-open')
                Events.$emit('close-popup-school')
            }
        }
    }
</script>