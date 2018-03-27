import Vue from 'vue';
import VueResource from 'vue-resource';

import AuthVue from './components/AuthComponents/auth.vue'
import UserVue from './components/UserComponent/user.vue'
import SchoolVue from './components/ScoolComponents/index.vue'
import RegionVue from './components/CityComponents/regions.vue'
import DistrictVue from './components/CityComponents/districts.vue'
import PriceVue from './components/CityComponents/price.vue'
import LessonsVue from './components/LessonComponents/index.vue'
import LessonVue from './components/LessonComponents/single.vue'
import QuestionsVue from './components/QuestionComponents/questions.vue'
import QuestionVue from './components/QuestionComponents/question.vue'
import QuestionSingle from './components/QuestionComponents/question-single.vue'
import LessonsSettings from './components/SettingsComponents/LessonsSettings.vue'
import EditProfile from './components/UserComponent/edit-profile-form.vue'
import VueVideoPlayer from 'vue-video-player'
import Toasted from 'vue-toasted';

require('video.js/dist/video-js.css')
require('vue-video-player/src/custom-theme.css')
Vue.use(VueResource);
Vue.use(VueVideoPlayer);
Vue.use(Toasted, {iconPack : 'material'});

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
Vue.http.options.emulateJSON = true;

export const Events = new Vue({});

const app = new Vue({
    el: '#app',

    components: {
        AuthVue,
        UserVue,
        SchoolVue,
        RegionVue,
        DistrictVue,
        PriceVue,
        LessonsVue,
        LessonVue,
        QuestionsVue,
        QuestionVue,
        QuestionSingle,
        LessonsSettings,
        EditProfile
    }
});