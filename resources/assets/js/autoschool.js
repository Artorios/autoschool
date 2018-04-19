import Vue from 'vue';
import VueResource  from 'vue-resource';
import ButtonAddGroup from './AutoSchoolComponent/button-add-group'
import ButtonAddFilial from './AutoSchoolComponent/button-add-filial'
// import VueInputMask from 'vue-inputmask'
const VueInputMask = require('vue-inputmask').default
Vue.use(VueInputMask);
Vue.use(VueResource);
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
Vue.http.options.emulateJSON = true;

export const Events = new Vue({});

const app = new Vue({
    el: '#app',

    components: {
        ButtonAddGroup,
        ButtonAddFilial
    }
});