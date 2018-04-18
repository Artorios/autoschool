import Vue from 'vue';
import VueResource from 'vue-resource';
import RegistrationVue from './SiteComponents/Registration.vue';
import LoginVue from './SiteComponents/Login.vue';
import ModalVue from './SiteComponents/ModalHead/modals.vue';
import PriceVue from './SiteComponents/price';
import YandexMap from './SiteComponents/yandex-map';

Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
Vue.http.options.emulateJSON = true;

export const Events = new Vue({});

const app = new Vue({
    el: '#app',

    components: {
        RegistrationVue,
        LoginVue,
        ModalVue,
        PriceVue,
        YandexMap
    }
});