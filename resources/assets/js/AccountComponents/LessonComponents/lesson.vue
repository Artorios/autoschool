<template>
    <div class="content demo-lesson">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/account">Главная</a></li>
                <li><a href="/account/lessons">Уроки</a></li>
                <li>Урок № {{lesson.lesson_num + ' ' + lesson.title}}</li>
            </ul>
        </div>
        <span>Урок № {{lesson.lesson_num}}</span>
        <h4>{{lesson.title}}</h4>

        <div class="video-wrapper" v-if="lesson.videos[0].youtube">
            <video   class=" video-js vjs-default-skin vjs-custom-skin"
                     ref="videoPlayer"
                     currentTime="100"
                   :class="{'custom-video': !lesson.videos[0].viewed}"
                     :data-setup="videoOptionsYT"
                   :playsinline="false"
                   width="650" height="360"
                   @ended="onPlayerEnded($event)"
            >
            </video>
        </div>
        <div class="video-wrapper" v-if="!lesson.videos[0].youtube">
            <video-player v-if="lesson.videos.length "  class="vjs-custom-skin"
                           ref="videoPlayer"
                           :options="videoOptions"
                           :class="{'custom-video': !lesson.videos[0].viewed}"
                           :playsinline="false"
                            @ended="onPlayerEnded($event)">
            </video-player>

            <!--@play="onPlayerPlay($event)"-->
                           <!--@pause="onPlayerPause($event)"-->
                           <!--@ended="onPlayerEnded($event)"-->
                           <!--@loadeddata="onPlayerLoadeddata($event)"-->
                           <!--@waiting="onPlayerWaiting($event)"-->
                           <!--@playing="onPlayerPlaying($event)"-->
                           <!--@timeupdate="onPlayerTimeupdate($event)"-->
                           <!--@canplay="onPlayerCanplay($event)"-->
                           <!--@canplaythrough="onPlayerCanplaythrough($event)"-->
                           <!--@ready="playerReadied"-->
                           <!--@statechanged="playerStateChanged($event)"-->
        </div>
        <div class="video-wrapper" v-if="!lesson.videos[0]">
            <p>Нет видео!</p>
        </div>

        <span>{{lesson.description}}</span>
        <div class="btn-wrapper" :class="{'disabled': !lessonTraining}">
            <a :href="'/account/lessons/training/' + lesson.id"
               class="btn-grey">Тренировка</a>

            <a :href="'/account/lessons/exam/' + lesson.id"
               class="btn-grey"
               v-if="lesson.training_pass">Зачет</a>

            <a :href="'/account/lessons/group-exam/' + lesson.id"
               class="btn-grey"
               v-if="lesson.isGroup && lesson.exam_pass">Групповой зачет</a>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .inner-main-content .container .demo-lesson .btn-wrapper {
        max-width: 412px;
        display: flex;
        justify-content: flex-start;
        a {
            margin-right: 5px;
        }
    }
</style>

<script>
    export default {
        data () {
            return {
                videoOptions: {
                    muted: false,
                    autoplay: false,
                    language: 'ru',
                    playbackRates: [0.7, 1.0, 1.5, 2.0],
                    controls: true,
                    currentTime: 100,
                    sources: [{
                        type: this.lesson.videos[0] ? this.lesson.videos[0].mime_type : '',
                        src: this.lesson.videos[0] ? this.lesson.videos[0].path : ''
                    }],
                    poster: "/static/images/author.jpg"
                },
                videoOptionsYT: '{ "techOrder": ["youtube"], "controls": "true", "playbackRates": ["0.7", "1.0", "1.5", "2.0"],   "language": "ru", "sources": [{ "type": "video/youtube", "src": "'+this.lesson.videos[0].youtube+'"}] }',

                lessonTraining: this.lesson.videos[0].hasOwnProperty('viewed') ? 1 : 0
            }
        },
        props: ['lesson'],
        computed: {
            player() {
                return this.$refs.videoPlayer.player
            }
        },
        watch: {
            lessonTraining: function (val) {
                console.log(val)
            }
        },
        mounted () {
//            let time = localStorage.getItem('timePlay')
            let time = this.lesson.videos.length ? this.lesson.videos[0].time : false
            if (time) {
                this.player.on('loadedmetadata', () => {
                    this.player.currentTime(time);
                });
            }
            window.onbeforeunload = function(){
                if (!this.player.paused() && !this.lesson.videos[0].viewed) {
//                    localStorage.setItem('timePlay', this.player.currentTime())
                    this.$http.post('/account/lessons/video', {video_id: this.lesson.videos[0].id, time: this.player.currentTime()})
                    return "Are you sure you want to close the window?";
                }
            }.bind(this)

        },
        methods: {
            onPlayerEnded (player) {
                let data = {
                    video_id: this.lesson.videos[0].id,
                    end_view: 1
                }
                this.$http.post('/account/lessons/video/ended', data).then(res => {
                    this.lessonTraining = true
                    this.$set(this.lesson.videos[0], 'viewed', 1)
                })
            }
        }
    }

</script>

<style lang="scss">
    .custom-video {
        .vjs-progress-control.vjs-control{
            display: block;
            height: 0;
            overflow: hidden;
        }
    }
</style>