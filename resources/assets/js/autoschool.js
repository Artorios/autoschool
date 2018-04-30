import Vue from 'vue';
import VueResource  from 'vue-resource';
import BlockStatisticGroups from './AutoschoolComponents/Main/block-statistic-groups.vue';
import BlockStatisticFilials from './AutoschoolComponents/Main/block-statistic-filials.vue';
import Pages from './AccountComponents/NotifyComponents/pages.vue';
import EditPassForm from './components/UserComponent/edit-pass-form';
import EditNotifySettings from './components/UserComponent/edit-notify-settings';
import NotifyAll from './AccountComponents/NotifyComponents/notify-all';
import NotifyNew from './AccountComponents/NotifyComponents/notify-new';
import ProfilePhoto from './components/UserComponent/profile-photo';
import FilialGroups from './AutoschoolComponents/filial-groups';
import ButtonAddFilial from './AutoschoolComponents/button-add-filial';

const VueInputMask = require('vue-inputmask').default


Vue.use(VueInputMask);
Vue.use(VueResource);
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
Vue.http.options.emulateJSON = true;

export const Events = new Vue({});

const app = new Vue({
    el: '#app',

    components: {
        BlockStatisticGroups,
        Pages,
        EditPassForm,
        EditNotifySettings,
        NotifyNew,
        NotifyAll,
        ProfilePhoto,
        ButtonAddFilial,
        FilialGroups,
        BlockStatisticFilials,
    }
});