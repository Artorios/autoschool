import Vue from 'vue';
import axios from 'axios';
import VueResource  from 'vue-resource';
import Pages from './AccountComponents/NotifyComponents/pages.vue';
import EditPassForm from './components/UserComponent/edit-pass-form';
import EditNotifySettings from './components/UserComponent/edit-notify-settings';
import NotifyAll from './AccountComponents/NotifyComponents/notify-all';
import NotifyNew from './AccountComponents/NotifyComponents/notify-new';
import InvestorProfile from './InvestorComponents/Main/investor-profile';
import SchoolsList from './InvestorComponents/Main/schools-list';
import Statistic from './InvestorComponents/Main/statistic';
import HistoryList from './InvestorComponents/Main/history-list';
import CouponList from './InvestorComponents/Main/coupon-list';
import FinanceList from './InvestorComponents/Main/finance-list';
import StatisticFinanceList from './InvestorComponents/Main/statistic-finance-list';
import AutoSchoolProfileEdit from './InvestorComponents/Main/autoschool-profile-edit';
import VCalendar from 'v-calendar'
import 'v-calendar/lib/v-calendar.min.css';
const VueInputMask = require('vue-inputmask').default;



Vue.use(VueInputMask);
Vue.use(VueResource);
Vue.use(VCalendar, {
    firstDayOfWeek: 2,
});
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
Vue.http.options.emulateJSON = true;
window.axios = axios;

export const Events = new Vue({});

const app = new Vue({
    el: '#app',

    components: {
        Pages,
        EditPassForm,
        EditNotifySettings,
        NotifyNew,
        NotifyAll,
        InvestorProfile,
        SchoolsList,
        Statistic,
        HistoryList,
        CouponList,
        FinanceList,
        AutoSchoolProfileEdit,
        StatisticFinanceList
    }
});