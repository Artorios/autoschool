<template>
    <div class="content error statistics">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a></li>
                <li>Статистика (Успеваемость)</li>
            </ul>
        </div>
        <div class="table-wrapper">
            <div class="title-line">
                <span class="number">№</span>
                <span class="name">Название</span>
                <span class="lesson">Урок</span>
                <span class="train">Тренировка</span>
                <span class="exam">Зачет</span>
                <span class="group-exam">Групповой зачет</span>
            </div>
            <div v-for="(lesson, i) in statistics">
                <div class="line">
                    <div class="number">
                        <span>{{lesson.lesson_num}}</span>
                    </div>
                    <div class="name">
                        <a :href="'/account/lessons/' + lesson.id">{{lesson.title}}</a>
                    </div>
                    <div class="lesson">
                        <span class="mobile-title">Урок</span>
                        <span :class="{'ready': lesson.viewed}">{{lesson.viewed ? 'Пройден' : 'Не пройден'}}</span>
                        <span class="date">{{lesson.updated_at.split(' ')[0]}}</span>
                    </div>
                    <div class="train">
                        <div v-if="lesson.right_quest_train">
                            <span class="mobile-title">Тренировка</span>
                            <span>{{lesson.right_quest_train}} из {{lesson.all_quest_train}}</span>
                            <a :href="'/account/lessons/training/' + lesson.id"><span class="refresh"></span></a>
                            <span>27.11.2017</span>
                        </div>
                    </div>
                    <div class="exam">
                        <div v-if="lesson.right_quest_exam">
                            <span class="mobile-title">Зачет</span>
                            <span>{{lesson.right_quest_exam}} из {{lesson.all_quest_exam}}</span>
                            <a :href="'/account/lessons/exam/' + lesson.id"><span class="refresh"></span></a>
                            <span>28.11.2017</span>
                        </div>
                    </div>
                    <div class="group-exam">
                        <div v-if="lesson.isGroup">
                            <span class="mobile-title">Груп. зачет</span>
                            <span v-if="!lesson.right_quest_group">-</span>
                            <!--<span v-if="lesson.isGroup" class="refresh"></span>-->
                            <!--<span v-if="lesson.isGroup">28.11.2017</span>-->
                        </div>
                    </div>
                    <div class="toggle">
                        <span class="btn-grey" data-toggle="collapse" :data-target="'#theme' + i">Статистика попыток</span>
                    </div>
                </div>
                <div class="hidden-statistics collapse" :id="'theme' + i">
                    <span class="close" data-toggle="collapse" data-target="#theme1"></span>
                    <div class="try-wrapper">
                        <div class="try">
                            <div class="number">
                                <span>Попытка 1</span>
                            </div>
                            <div class="train-wrapper">
                                <div class="train">
                                    <span>Ошибок <span>5</span></span>
                                    <span>27.11.2017</span>
                                    <a href="#">Разбор ошибок</a>
                                </div>
                                <div class="train">
                                    <span>Ошибок <span>5</span></span>
                                    <span>27.11.2017</span>
                                    <a href="#">Разбор ошибок</a>
                                </div>
                                <div class="train">
                                    <span>Ошибок <span>5</span></span>
                                    <span>27.11.2017</span>
                                    <a href="#">Разбор ошибок</a>
                                </div>
                            </div>
                            <div class="exam-wrapper">
                                <div class="exam">
                                    <span>Ошибок <span>18</span></span>
                                    <span>28.11.2017</span>
                                    <a href="#">Разбор ошибок</a>
                                </div>
                            </div>
                        </div>
                        <div class="try">
                            <div class="number">
                                <span>Попытка 2</span>
                            </div>
                            <div class="train-wrapper">
                                <div class="train">
                                    <span>Ошибок <span class="without">0</span></span>
                                    <span>27.11.2017</span>
                                    <a href="#">Разбор ошибок</a>
                                </div>
                            </div>
                            <div class="exam-wrapper">
                                <div class="exam">
                                    <span>Ошибок <span>15</span></span>
                                    <span>28.11.2017</span>
                                    <a href="#">Разбор ошибок</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="line">-->
                <!--<div class="number">-->
                    <!--<span>02</span>-->
                <!--</div>-->
                <!--<div class="name">-->
                    <!--<a href="#">Предупреждающие знаки</a>-->
                <!--</div>-->
                <!--<div class="lesson">-->
                    <!--<span class="mobile-title">Урок</span>-->
                    <!--<span class="ready">Пройден</span>-->
                    <!--<span class="date">22.11.2017</span>-->
                <!--</div>-->
                <!--<div class="train">-->
                    <!--<span class="mobile-title">Тренировка</span>-->
                    <!--<span class="ready">28 из 28</span>-->
                    <!--<span class="refresh"></span>-->
                    <!--<span>27.11.2017</span>-->
                <!--</div>-->
                <!--<div class="exam">-->
                    <!--<span class="mobile-title">Зачет</span>-->
                    <!--<span>0 из 28</span>-->
                    <!--<span class="refresh"></span>-->
                    <!--<span>27.11.2017</span>-->
                <!--</div>-->
                <!--<div class="group-exam">-->
                    <!--<span class="mobile-title">Груп. зачет</span>-->
                    <!--<span>5 из 28</span>-->
                    <!--<span class="refresh"></span>-->
                    <!--<span>28.11.2017</span>-->
                <!--</div>-->
                <!--<div class="toggle">-->
                    <!--<span class="btn-grey" data-toggle="collapse" data-target="#theme2">Статистика попыток</span>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="hidden-statistics collapse" id="theme2">-->
                <!--<span class="close" data-toggle="collapse" data-target="#theme2"></span>-->
                <!--<div class="try-wrapper">-->
                    <!--<div class="try">-->
                        <!--<div class="number">-->
                            <!--<span>Попытка 1</span>-->
                        <!--</div>-->
                        <!--<div class="train-wrapper">-->
                            <!--<div class="train">-->
                                <!--<span>Ошибок <span>5</span></span>-->
                                <!--<span>27.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="exam-wrapper">-->
                            <!--<div class="exam">-->
                                <!--<span>Ошибок <span>18</span></span>-->
                                <!--<span>28.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                    <!--<div class="try">-->
                        <!--<div class="number">-->
                            <!--<span>Попытка 2</span>-->
                        <!--</div>-->
                        <!--<div class="train-wrapper">-->
                            <!--<div class="train">-->
                                <!--<span>Ошибок <span class="without">0</span></span>-->
                                <!--<span>27.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="exam-wrapper">-->
                            <!--<div class="exam">-->
                                <!--<span>Ошибок <span>15</span></span>-->
                                <!--<span>28.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="line">-->
                <!--<div class="number">-->
                    <!--<span>03</span>-->
                <!--</div>-->
                <!--<div class="name">-->
                    <!--<a href="#">Групповой зачет</a>-->
                <!--</div>-->
                <!--<div class="lesson">-->
                <!--</div>-->
                <!--<div class="train">-->
                <!--</div>-->
                <!--<div class="exam">-->
                    <!--<span>6 из 28</span>-->
                    <!--<span class="refresh"></span>-->
                    <!--<span>27.11.2017</span>-->
                <!--</div>-->
                <!--<div class="group-exam">-->
                    <!--<span class="mobile-title">Груп. зачет</span>-->
                    <!--<span>5 из 28</span>-->
                    <!--<span class="refresh"></span>-->
                    <!--<span>28.11.2017</span>-->
                <!--</div>-->
                <!--<div class="toggle">-->
                    <!--<span class="btn-grey" data-toggle="collapse" data-target="#theme3">Статистика попыток</span>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="hidden-statistics collapse" id="theme3">-->
                <!--<span class="close" data-toggle="collapse" data-target="#theme3"></span>-->
                <!--<div class="try-wrapper">-->
                    <!--<div class="try">-->
                        <!--<div class="number">-->
                            <!--<span>Попытка 1</span>-->
                        <!--</div>-->
                        <!--<div class="train-wrapper">-->
                            <!--<div class="train">-->
                                <!--<span>Ошибок <span>5</span></span>-->
                                <!--<span>27.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="exam-wrapper">-->
                            <!--<div class="exam">-->
                                <!--<span>Ошибок <span>18</span></span>-->
                                <!--<span>28.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                    <!--<div class="try">-->
                        <!--<div class="number">-->
                            <!--<span>Попытка 2</span>-->
                        <!--</div>-->
                        <!--<div class="train-wrapper">-->
                            <!--<div class="train">-->
                                <!--<span>Ошибок <span class="without">0</span></span>-->
                                <!--<span>27.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="exam-wrapper">-->
                            <!--<div class="exam">-->
                                <!--<span>Ошибок <span>15</span></span>-->
                                <!--<span>28.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="line">-->
                <!--<div class="number">-->
                    <!--<span>04</span>-->
                <!--</div>-->
                <!--<div class="name">-->
                    <!--<a href="#">Приоритет МТС</a>-->
                <!--</div>-->
                <!--<div class="lesson">-->
                    <!--<span class="mobile-title">Урок</span>-->
                    <!--<span class="ready">Пройден</span>-->
                    <!--<span class="date">21.11.2017</span>-->
                <!--</div>-->
                <!--<div class="train">-->
                    <!--<span class="mobile-title">Тренировка</span>-->
                    <!--<span>6 из 28</span>-->
                    <!--<span class="refresh"></span>-->
                    <!--<span>27.11.2017</span>-->
                <!--</div>-->
                <!--<div class="exam">-->
                    <!--<span class="mobile-title">Зачет</span>-->
                    <!--<span>0 из 28</span>-->
                    <!--<span class="refresh"></span>-->
                    <!--<span>27.11.2017</span>-->
                <!--</div>-->
                <!--<div class="group-exam">-->
                    <!--<span class="mobile-title">Груп. зачет</span>-->
                    <!--<span>5 из 28</span>-->
                    <!--<span class="refresh"></span>-->
                    <!--<span>28.11.2017</span>-->
                <!--</div>-->
                <!--<div class="toggle">-->
                    <!--<span class="btn-grey" data-toggle="collapse" data-target="#theme4">Статистика попыток</span>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="hidden-statistics collapse" id="theme4">-->
                <!--<span class="close" data-toggle="collapse" data-target="#theme4"></span>-->
                <!--<div class="try-wrapper">-->
                    <!--<div class="try">-->
                        <!--<div class="number">-->
                            <!--<span>Попытка 1</span>-->
                        <!--</div>-->
                        <!--<div class="train-wrapper">-->
                            <!--<div class="train">-->
                                <!--<span>Ошибок <span>5</span></span>-->
                                <!--<span>27.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="exam-wrapper">-->
                            <!--<div class="exam">-->
                                <!--<span>Ошибок <span>18</span></span>-->
                                <!--<span>28.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                    <!--<div class="try">-->
                        <!--<div class="number">-->
                            <!--<span>Попытка 2</span>-->
                        <!--</div>-->
                        <!--<div class="train-wrapper">-->
                            <!--<div class="train">-->
                                <!--<span>Ошибок <span class="without">0</span></span>-->
                                <!--<span>27.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="exam-wrapper">-->
                            <!--<div class="exam">-->
                                <!--<span>Ошибок <span>15</span></span>-->
                                <!--<span>28.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="line">-->
                <!--<div class="number">-->
                    <!--<span>05</span>-->
                <!--</div>-->
                <!--<div class="name">-->
                    <!--<a href="#">Предписывающие знаки</a>-->
                <!--</div>-->
                <!--<div class="lesson">-->
                    <!--<span class="mobile-title">Урок</span>-->
                    <!--<span class="ready">Пройден</span>-->
                    <!--<span class="date">21.11.2017</span>-->
                <!--</div>-->
                <!--<div class="train">-->
                    <!--<span class="mobile-title">Тренировка</span>-->
                    <!--<span class="ready">6 из 28</span>-->
                    <!--<span class="refresh"></span>-->
                    <!--<span>27.11.2017</span>-->
                <!--</div>-->
                <!--<div class="exam">-->
                    <!--<span class="mobile-title">Зачет</span>-->
                    <!--<a href="#">пройти</a>-->
                    <!--<span class="refresh"></span>-->
                <!--</div>-->
                <!--<div class="group-exam">-->
                    <!--<span class="mobile-title">Груп. зачет</span>-->
                    <!--<span>5 из 28</span>-->
                    <!--<span class="refresh"></span>-->
                    <!--<span>28.11.2017</span>-->
                <!--</div>-->
                <!--<div class="toggle">-->
                    <!--<span class="btn-grey" data-toggle="collapse" data-target="#theme5">Статистика попыток</span>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="hidden-statistics collapse" id="theme5">-->
                <!--<span class="close" data-toggle="collapse" data-target="#theme5"></span>-->
                <!--<div class="try-wrapper">-->
                    <!--<div class="try">-->
                        <!--<div class="number">-->
                            <!--<span>Попытка 1</span>-->
                        <!--</div>-->
                        <!--<div class="train-wrapper">-->
                            <!--<div class="train">-->
                                <!--<span>Ошибок <span>5</span></span>-->
                                <!--<span>27.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="exam-wrapper">-->
                            <!--<div class="exam">-->
                                <!--<span>Ошибок <span>18</span></span>-->
                                <!--<span>28.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                    <!--<div class="try">-->
                        <!--<div class="number">-->
                            <!--<span>Попытка 2</span>-->
                        <!--</div>-->
                        <!--<div class="train-wrapper">-->
                            <!--<div class="train">-->
                                <!--<span>Ошибок <span class="without">0</span></span>-->
                                <!--<span>27.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="exam-wrapper">-->
                            <!--<div class="exam">-->
                                <!--<span>Ошибок <span>15</span></span>-->
                                <!--<span>28.11.2017</span>-->
                                <!--<a href="#">Разбор ошибок</a>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="line">-->
                <!--<div class="number">-->
                    <!--<span>06</span>-->
                <!--</div>-->
                <!--<div class="name">-->
                    <!--<a href="#">Знаки особых предписаний</a>-->
                <!--</div>-->
                <!--<div class="lesson">-->
                <!--</div>-->
                <!--<div class="train">-->
                <!--</div>-->
                <!--<div class="exam">-->
                <!--</div>-->
                <!--<div class="group-exam">-->
                <!--</div>-->
                <!--<div class="toggle">-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="line">-->
                <!--<div class="number">-->
                    <!--<span>07</span>-->
                <!--</div>-->
                <!--<div class="name">-->
                    <!--<a href="#">Групповой зачет</a>-->
                <!--</div>-->
                <!--<div class="lesson">-->
                <!--</div>-->
                <!--<div class="train">-->
                <!--</div>-->
                <!--<div class="exam">-->
                    <!--<span>26.11.2017</span>-->
                <!--</div>-->
                <!--<div class="group-exam">-->
                <!--</div>-->
                <!--<div class="toggle">-->
                <!--</div>-->
            <!--</div>-->
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
            </ul>
        </nav>
    </div>
</template>

<script type="text/babel">
    export default {
        data () {
            return {}
        },
        props: ['statistics']
    }
</script>