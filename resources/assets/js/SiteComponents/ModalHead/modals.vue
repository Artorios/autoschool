<template>
    <span>
        <city-popup :regions="regions" :checked-region="checkedRegion" v-if="showCityPopup"></city-popup>
        <school-popup v-if="showSchoolPopup"></school-popup>
        <div class="select-wrapper">
            <img src="/img/location.png" alt="">
            <span data-toggle="modal" data-target="#cityModal" @click="showCityPopup = !showCityPopup">
                {{userCity ? userCity.name : 'Москва'}}
            </span>
            <span data-toggle="modal" @click="showSchoolPopup = !showSchoolPopup">
                Адреса автошкол
            </span>
        </div>
    </span>
</template>

<script type="text/babel">
    import CityPopup from './popups/CityPopup.vue'
    import SchoolPopup from './popups/SchoolPopup.vue'
    import {Events} from "../../siteApp"
    export default {
        data () {
            return {
                regions: null,
                allCities: null,
                showCityPopup: false,
                checkedRegion: null,
                showSchoolPopup: false,
                userCity: JSON.parse(localStorage.getItem('city'))
            }
        },
        components: {
            CityPopup,
            SchoolPopup
        },
        created () {
            Events.$on('close-popup-city', (data) => {
                this.showCityPopup = false
                this.checkedRegion = data.region
                this.userCity = data.city ? JSON.parse(localStorage.getItem('city')) : Fasle
            })
            Events.$on('close-popup-school', () => {
                this.showSchoolPopup = false
            })
            this.getData()
        },
        methods: {
            getData () {
                this.$http.get('/api/get-region-prices').then(res => {
                    this.regions   = res.data.regions
                    this.allCities = res.data.allCities
                    if (this.userCity) {
                        this.regions.forEach(region => {
                            if (region.id == this.userCity.regions_id) {
                                this.checkedRegion = region
                            }
                        })
                    } else {
                        this.checkedRegion = this.regions[0]
                    }
                })
            }
        }
    }
</script>