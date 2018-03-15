import Vue from 'vue';
import VueResource from 'vue-resource';
import VueVideoPlayer from 'vue-video-player'
import LessonsVue from './AccountComponents/LessonComponents/lessons.vue'
import LessonVue from './AccountComponents/LessonComponents/lesson.vue'
import TrainingVue from './AccountComponents/LessonComponents/traning.vue'
import ExamVue from './AccountComponents/LessonComponents/exam.vue'
import GroupExamVue from './AccountComponents/LessonComponents/group-exam.vue'
import NumberLessons from './AccountComponents/number-lessons.vue'
import AnalysisVue from './AccountComponents/LessonComponents/error-analysis.vue'
import StatisticVue from './AccountComponents/StatisticComponents/statistic.vue'
import DoneLessons from './AccountComponents/MainComponents/done-lessons'
import CurrentLesson from './AccountComponents/MainComponents/current-lesson'
import SliderVue from './AccountComponents/MainComponents/slider'
import TicketsVue from './AccountComponents/TicketsComponents/tickets'
import TicketQuestionsVue from './AccountComponents/TicketsComponents/ticket-questions'
require('video.js/dist/video-js.css')
require('vue-video-player/src/custom-theme.css')
Vue.use(VueResource);
Vue.use(VueVideoPlayer);

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
Vue.http.options.emulateJSON = true;

Vue.filter('two_digits', function (value) {
    if (value.toString().length <= 1) {
        return "0" + value.toString()
    }
    return value.toString()
});

export const Events = new Vue({});

const app = new Vue({
    el: '#app',

    components: {
        LessonsVue,
        LessonVue,
        TrainingVue,
        NumberLessons,
        ExamVue,
        AnalysisVue,
        StatisticVue,
        DoneLessons,
        CurrentLesson,
        SliderVue,
        GroupExamVue,
        TicketsVue,
        TicketQuestionsVue
    }
});