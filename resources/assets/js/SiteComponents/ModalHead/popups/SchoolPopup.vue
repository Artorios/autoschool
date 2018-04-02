<template>
    <div>
        <div class="modal-backdrop in "></div>
        <div class="modal school in" id="schoolModal" @click.self="close" style="display: block;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body city-choose">
                    <span class="close" data-dismiss="modal" aria-label="Close" @click="close">
              </span>
                        <div class="modal-toggle" data-dismiss="modal" aria-label="Close">
                            <span>Адреса автошкол</span>
                        </div>

                        <h3>Список автошкол партнеров сервиса Автотренер в {{checkedCity ? 'г. ' + checkedCity.name : 'городах'}}:</h3>
                        <div class="wrapper">
                            <div class="left">
                                <ul>
                                    <li v-for="school in schools">
                                        <a href="#" @click.prevent="checkedSchoolFunc(school)" :class="{'active': school.id === checkedSchool.id}">{{school.title}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="right">

                                <div class="ul-wrapper" v-if="checkedSchool">
                                    <ul class="adress" v-if="checkedSchool.addresses.length">
                                        <li v-for="address in checkedSchool.addresses">
                                            <img src="/img/location.png" alt="">
                                            {{(checkedSchool.city ? 'г' + checkedSchool.city.name : '') + ' ' + address.value}}
                                        </li>
                                    </ul>
                                    <ul class="tel" v-if="checkedSchool.phones.length">
                                        <li v-for="phone in checkedSchool.phones">
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
            $('body').addClass('modal-open')
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