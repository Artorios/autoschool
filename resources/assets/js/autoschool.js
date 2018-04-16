import Vue from 'vue';
import VueResource  from 'vue-resource';
import BlockStatistic from './AutoschoolComponents/Main/block-statistic.vue'
import Pages from './AccountComponents/NotifyComponents/pages.vue'
import EditPassForm from './components/UserComponent/edit-pass-form'
import EditNotifySettings from './components/UserComponent/edit-notify-settings'
import NotifyAll from './AccountComponents/NotifyComponents/notify-all'
import NotifyNew from './AccountComponents/NotifyComponents/notify-new'
import ProfilePhoto from './components/UserComponent/profile-photo'

Vue.use(VueResource);
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
Vue.http.options.emulateJSON = true;



export const Events = new Vue({});

const app = new Vue({
    el: '#app',

    components: {
        BlockStatistic,
        Pages,
        EditPassForm,
        EditNotifySettings,
        NotifyNew,
        NotifyAll,
        ProfilePhoto
    }
});