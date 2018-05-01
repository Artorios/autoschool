import Vue from 'vue';
import VueResource  from 'vue-resource';
import BlockStatisticGroups from './AutoschoolComponents/Main/block-statistic-groups.vue';
import BlockStatisticFilials from './AutoschoolComponents/Main/block-statistic-filials.vue';
import BlockStatisticGroupsInFilial from './AutoschoolComponents/Main/block-statistic-group-in-filial';
import Pages from './AccountComponents/NotifyComponents/pages.vue';
import EditPassForm from './components/UserComponent/edit-pass-form';
import EditNotifySettings from './components/UserComponent/edit-notify-settings';
import NotifyAll from './AccountComponents/NotifyComponents/notify-all';
import NotifyNew from './AccountComponents/NotifyComponents/notify-new';
import ProfilePhoto from './components/UserComponent/profile-photo';
import ButtonAddFilial from './AutoschoolComponents/button-add-filial';
import SchoolFilials from './AutoschoolComponents/school-filials'
import FilialGroups from './AutoschoolComponents/filial-groups'
import AutoschoolProfileEdit from './AutoschoolComponents/autoschool-profile-edit'
import ButtonAddFilial from './AutoschoolComponents/button-add-filial';
import FilialGroups from './AutoschoolComponents/filial-groups';
import FinanceStatisticMain from './AutoschoolComponents/finance-statistic-main';
import FinanceSearchStudents from './AutoschoolComponents/finance-search-students'
import FinanceSelectStudents from './AutoschoolComponents/finance-select-students'
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
        BlockStatisticGroupsInFilial,
        FinanceStatisticMain,
        FinanceSearchStudents,
        FinanceSelectStudents,
        BlockStatisticFilials,
        SchoolFilials,
        AutoschoolProfileEdit
    }
});