<template>
    <div class="map">
        <div class="map-wrapper">
            <div id="map" style="width: 100%;height: 240px;"></div>
        </div>
    </div>
</template>

<script type="text/babel">
    import {Events} from '../siteApp'
    export default {
        data(){
            return {
                coordinates: [55.76, 37.64],
                myMap: {},
                user_city: JSON.parse(localStorage.getItem('city')),
                schools: null
            }
        },

        computed: {
            geocode: function () {
                let city = 'г.' + this.user_city ? this.user_city.name : 'Москва';
                return city
            }
        },

        events: {
            'map-search': function () {
                this.mapSearch();
            }
        },

        created () {
            this.mapInit();
            Events.$on('close-popup-city', () => {
                this.update()
            })
        },

        methods: {
            update () {
                this.user_city = JSON.parse(localStorage.getItem('city'))
                this.myMap.destroy()
                this.mapInit()
            },
            mapInit(){
                let vm = this;

                ymaps.ready(init);
                function init() {
                    vm.myMap = new ymaps.Map("map", {
                        center: vm.coordinates,
                        zoom: 14,
                    });
                    vm.mapSearch()
                    if (vm.user_city) {
                        vm.getSchools(vm.user_city.id)
                    }
                }
            },
            getSchools (id) {
                this.$http.get('/schools/' + id).then(res => {
                    if (res.status === 200) {
                        this.schools = res.data
                        if (this.schools.length) {
                            this.schools.forEach(school => {
                                // school.faceAdresses = ['Кирочная, 5', 'Гороховая, 2', 'Витебская, 21']
                                school.addresses.forEach(address => {
                                    this.setCircles(school, address.value)
                                })
                            })
                        }
                    }
                })
            },
            mapSearch(){
                let vm = this;

                vm.myMap.geoObjects.removeAll();
                ymaps.geocode(vm.geocode, {
                    results: 1
                }).then(function (res) {
                    // Выбираем первый результат геокодирования.
                    var firstGeoObject = res.geoObjects.get(0),
                        // Координаты геообъекта.
                        coords = firstGeoObject.geometry.getCoordinates(),
                        // Область видимости геообъекта.
                        bounds = firstGeoObject.properties.get('boundedBy');

                    // Добавляем первый найденный геообъект на карту.

                    vm.myMap.geoObjects.add(firstGeoObject);
                    vm.myMap.setBounds(bounds, {
                        // Проверяем наличие тайлов на данном масштабе.
                        checkZoomRange: true
                    });
                });
            },

            setCircles (school, value) {
                let vm = this
                // vm.myMap.geoObjects.removeAll();
                if (vm.myMap) {
                    ymaps.geocode(vm.geocode + ' ул. ' + value, {
                        results: 1
                    }).then(function (res) {
                        // Выбираем первый результат геокодирования.
                        let firstGeoObject = res.geoObjects.get(0)
                        let coords = firstGeoObject.geometry.getCoordinates()
                        let bounds = firstGeoObject.properties.get('boundedBy');
                        vm.myMap.geoObjects.add(new ymaps.Placemark(coords, {
                            balloonContent: '<strong>' + school.title +'</strong> <p>' + school.description + '</p>'
                        }, {
                            preset: 'islands#dotIcon',
                            iconColor: '#735184'
                        }))

                    });
                }
            }
        }
    }
</script>