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
                        <div class="wrapper">
                            <div class="left">
                                <ul>
                                    <li v-for="school in schools" @click="showAddresses(school.id)">
                                        <a href="#" class="school-media-991">{{school.title}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="right" v-show="showSchool == 0">
                                <div class="ul-wrapper" v-for="school in schools">
                                    <ul class="adress" v-if="school.addresses[0]">
                                        <li v-for="addres in school.addresses">
                                            <img src="/img/location.png" alt="">
                                            <span v-if="school.city.name">{{'г. ' + school.city.name}}</span>
                                            <span v-if="addres.value">{{addres.value}}</span>
                                        </li>
                                    </ul>

                                    <ul class="adress" v-else>
                                        <li>
                                            <img src="/img/location.png" alt="">
                                            <span v-if="school.city.name">{{'г. ' + school.city.name}}</span>
                                        </li>
                                    </ul>

                                    <ul class="tel" v-if="school.phones">
                                        <li v-for="phone in school.phones">
                                            <img src="/img/tel.png" alt="">
                                            <span>{{phone.value}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="right" v-show="showSchool != 0">
                                <span class="close hidden-md hidden-lg" @click.self="hideAddresses"></span>
                                <div class="ul-wrapper" v-for="school in schools" v-if="school.id == showSchool">
                                    <ul class="adress" v-if="school.addresses[0]">
                                        <li v-for="addres in school.addresses">
                                            <img src="/img/location.png" alt="">
                                            <span v-if="school.city.name">{{'г. ' + school.city.name}}</span>
                                            <span v-if="addres.value">{{addres.value}}</span>
                                        </li>
                                    </ul>

                                    <ul class="adress" v-else>
                                        <li>
                                            <img src="/img/location.png" alt="">
                                            <span v-if="school.city.name">{{'г. ' + school.city.name}}</span>
                                        </li>
                                    </ul>

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
</template>

<script type="text/babel">
    import {Events} from "../../../siteApp"
    export default {
        data () {
            return {
                schools: null,
                checkedSchool: null,
                showSchool: 0,
                checkedCity: JSON.parse(localStorage.getItem('city'))
            }
        },
        created () {
            this.getData();
        },
        mounted () {
            //$('body').addClass('modal-open')
        },
        methods: {
            getData () {
                let id = '';
                if (this.checkedCity) {
                    id = this.checkedCity.id;
                }
                this.$http.get('/schools/' + id).then(res => {
                    if (res.status === 200) {
                        this.schools = res.data;
                        this.checkedSchool = this.schools[0];
                    }
                })
            },
            checkedSchoolFunc (school) {
                this.checkedSchool = school;
            },
            close () {
                $('body').removeClass('modal-open');
                Events.$emit('close-popup-school');
            },
            showAddresses (schoolId) {
                this.showSchool = schoolId;

                $('#schoolModal').find('.right').addClass('show-addresses');
            },
            hideAddresses () {
                this.showSchool = 0;
                $('#schoolModal').find('.right').removeClass('show-addresses');
            }
        }
    }
</script>