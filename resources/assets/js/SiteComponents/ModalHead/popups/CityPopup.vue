<template>
    <div>
        <div class="modal-backdrop in "></div>
        <div class="modal in" id="cityModal" @click.self="close" tabindex="-1" role="dialog" style="display: block;" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body city-choose">
                    <span class="close" @click="close"></span>
                        <div class="modal-toggle" data-dismiss="modal" aria-label="Close">
                            <img src="/img/location.png" alt="">
                            <span>{{checkedRegionData.name}}</span>
                        </div>
                        <div class="mobile-title">
                            <h4>Выберите регион</h4>
                            <h4>Выберите город</h4>
                        </div>
                        <div class="wrapper">
                            <div class="left">
                                <h3>Выберите регион:</h3>
                                <ul>
                                    <li v-for="region in regions">
                                        <a href="#"
                                           :class="{'active': region.id === checkedRegionData.id}"
                                           @click.prevent="checkedRegionFunc(region)">{{region.name}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="right">
                                <h3>Выберите город</h3>
                                <div class="ul-wrapper">
                                    <ul>
                                        <li v-for="city in checkedRegionData.cities_main">
                                            <input type="radio" @change="setCity(city)" name="city" :id="'city' + city.id" :value="city.id" v-model="checkedCityId">
                                            <label :for="'city' + city.id">{{city.name}}</label>
                                        </li>
                                    </ul>
                                    <ul></ul>
                                    <ul></ul>
                                </div>
                            </div>
                        </div>
                        <div class="search">
                            <input type="text" placeholder="Название города">
                            <a href="#" class="btn-red">Искать</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {Events} from "../../../siteApp"
    export default {
        data () {
            return {
                checkedCityId: null,
                city: null,
                checkedRegionData: this.checkedRegion
            }
        },
        props: ['regions', 'checkedRegion'],
        mounted () {
//            $('body').addClass('modal-open')
        },
        watch: {

        },
        created () {
            let user_city = JSON.parse(localStorage.getItem('city'))
            if (user_city) {
                this.checkedCityId = user_city.id
            }
        },
        methods: {
            close () {
                $('body').removeClass('modal-open')
                Events.$emit('close-popup-city', {region: this.checkedRegionData, city: this.city})
            },
            checkedRegionFunc (region) {
                this.checkedRegionData = region
            },
            setCity (city) {
                this.city = city
                localStorage.setItem('city', JSON.stringify(this.city))
                this.close()
            }
        }
    }
</script>