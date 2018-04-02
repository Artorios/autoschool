<template>
    <div class="price">
        <span>Цена г. {{checkedCity ? checkedCity.name : 'Москва'}}:</span>
        <h5>{{price}}</h5>
        <span>руб.</span>
    </div>
</template>

<script type="text/babel">
    import {Events} from '../siteApp'

    export default {
        data () {
            return {
                checkedCity: JSON.parse(localStorage.getItem('city')),
                price: 0
            }
        },
        created () {
            if (!this.checkedCity) {
                this.price = 1500
            } else {
                this.getPrice()
            }
            Events.$on('close-popup-city', () => {
                this.checkedCity = JSON.parse(localStorage.getItem('city'))
                this.getPrice()
            })
        },
        methods: {
            getPrice () {
                let data = {
                    city_id: +this.checkedCity.id
                }

                this.$http.post('/get-price', data).then(res => {
                    this.price = res.data.price
                }, err => {
                    this.price = 1500
                })
            }
        }
    }
</script>