<template>
    <div>
        <div class="modal-backdrop in "></div>
        <div class="modal in" id="cityModal" @click.self="close" tabindex="-1" role="dialog" style="display: block;"
             aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body city-choose">
                        <span class="close" @click="close"></span>
                        <div class="modal-toggle" data-dismiss="modal" aria-label="Close" v-if="checkedRegionData">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
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

                                    <ul v-if="!error">
                                        <li v-if="!allCities.length" v-for="city in filteredCities">
                                            <input type="radio" @change="setCity(city)" name="city"
                                                   :id="'city' + city.id" :value="city.id" v-model="checkedCityId">
                                            <label :for="'city' + city.id">{{city.name}}</label>
                                        </li>

                                        <label v-if="!filteredCities.length && !allCities.length">
                                            Невозможно найти город в этом регионе. Нажмите "Искать" для поиска в других
                                            рагионах.
                                        </label>

                                        <li v-for="city in allCities">
                                            <input type="radio" @change="setCity(city)" name="city"
                                                   :id="'city' + city.id" :value="city.id" v-model="checkedCityId">
                                            <label :for="'city' + city.id">{{ city.name }}</label>
                                        </li>

                                    </ul>
                                    <ul v-else>
                                        <label>{{ error }}</label>
                                    </ul>
                                    <ul></ul>
                                    <ul></ul>

                                </div>
                            </div>
                        </div>
                        <div class="search">
                            <input type="text" v-model="query" v-bind:style="{border: noCity}"
                                   placeholder="Название города" autofocus>
                            <button class="btn-red" @click="search()" v-if="!loading">Искать</button>
                            <button href="#" class="btn-red" v-if="loading">Поиск...</button>
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
        data() {
            return {
                border: false,
                checkedCityId: null,
                city: null,
                checkedRegionData: this.checkedRegion,
                allCities: [],
                loading: false,
                error: false,
                noCity: false,
                query: ''
            }
        },
        props: ['regions', 'checkedRegion'],
        mounted() {
            $('body').addClass('modal-open')
        },
        watch: {},
        created() {
            let user_city = JSON.parse(localStorage.getItem('city'))
            if (user_city) {
                this.checkedCityId = user_city.id
            }
        },
        methods: {
            close() {
                Events.$emit('close-popup-city', {region: this.checkedRegionData, city: this.city})
            },
            checkedRegionFunc(region) {
                this.checkedRegionData = region
                this.allCities = []
                this.query = ''
                this.noCity = false
                this.loading = false
                this.error = ''
                this.noCity = ''
            },
            setCity(city) {
                this.city = city
                localStorage.setItem('city', JSON.stringify(this.city))
                this.close()
            },
            search() {
                this.error = ''
                this.allCities = []
                this.loading = true
                this.noCity = ''

                if (this.query) {
                    this.$http.get('/api/search?q=' + this.query).then(res => {
                        res.body.error ? this.error = res.body.error : this.allCities = res.body
                        this.loading = false
                    });
                }
                else {
                    this.noCity = '1px solid #c00'
                    this.loading = false
                }
            }
        },

        computed: {
            filteredCities() {

                return this.checkedRegionData.cities_main.filter((city) => {

                    return city.name.match(this.query)
                });
            }
        }
    }

</script>