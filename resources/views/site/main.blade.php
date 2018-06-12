@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="info-block" id="kak-uchim">
            <div class="container">
                @if(Session::has('pass_message'))
                    <p class="alert alert-{{ Session::get('pass_class') }}">{{ Session::get('pass_message') }}</p>
                @endif
                <div class="ico-wrapper">
                    <div class="block">
                        <div class="img">
                            <img src="/img/ico1.png" alt="">
                        </div>
                        <h5>64 видеоурока</h5>
                        <span>в 3D формате</span>
                    </div>
                    <div class="block">
                        <div class="img">
                            <img src="/img/ico2.png" alt="">
                        </div>
                        <h5>Свободный <br> график занятий</h5>
                    </div>
                    <div class="block">
                        <div class="img">
                            <img src="/img/ico3.png" alt="">
                        </div>
                        <h5>Крепкие <br> знания ПДД</h5>
                        <span>Игровой процесс обучения</span>
                    </div>
                    <div class="block">
                        <div class="img">
                            <img src="/img/ico4.png" alt="">
                        </div>
                        <h5>Категории <br> А, В, С</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="video-block">
            <div class="container">
                <h2>5000 учеников «АвтоТренера» уже получили права.<br>99% сдали ПДД с 1-го раз.</h2>
                <div class="video-wrapper">
                    <iframe width="555" height="315" src="https://www.youtube.com/embed/-KBxKJKUVKM" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                </div>
                <span>Смотрите все нюансы на видео</span>
            </div>
        </div>
        <div class="start-block">
            <div class="container">
                <h2>Обучение с АвтоТренером. <br>Каждый урок с двойным закреплением знаний</h2>
                <div class="ico-wrapper">
                    <div class="block">
                        <div class="img">
                            <img src="/img/ico2-1.png" alt="">
                        </div>
                        <h5>Просмотр видеоурока</h5>
                        <span>Переход к следующему уроку только после зачета по предыдущему</span>
                        <span class="number">01</span>
                    </div>
                    <div class="block">
                        <div class="img">
                            <img src="/img/ico2-2.png" alt="">
                        </div>
                        <h5>Тестирование с подсказками</h5>
                        <span>Подробный разбор ошибок</span>
                        <span class="number">02</span>
                    </div>
                    <div class="block">
                        <div class="img">
                            <img src="/img/ico2-3.png" alt="">
                        </div>
                        <h5>Зачет по видеоуроку</h5>
                        <span>Зачеты по группам видеоуроков (пройденным темам)</span>
                        <span class="number">03</span>
                    </div>
                </div>
                <img src="/img/brace.png" alt="0">
                <span class="total">Итого:</span>
                <span>Крепкие знания для сдачи ПДД в автошколе и с ГИБДД с 1-го раза</span>
                <a href="{{route('regUser')}}" class="btn-red">Начните обучаться бесплатно</a>
            </div>
        </div>
        <div class="top" id="top7plus">
            <div class="container">
                <h2>ТОП-7 плюсов онлайн-курса: <span>«АвтоТренер»</span></h2>
                <div class="first">
                    <img src="/img/top-img.png" alt="">
                    <ul>
                        <li>
                            <span>01</span>
                            <h4>Мобильность</h4>
                            <p>Занятия без привязки к месту и времени с любого устройства подключенного к интернет;</p>
                        </li>
                        <li>
                            <span>02</span>
                            <h4>Видео-уроки в 3D формате</h4>
                            <p>Великолепные 3D-уроки с детальной графикой и пояснениями. Полноценная замена 140 часам лекций по ПДД в автошколе;*</p>
                        </li>
                        <li>
                            <span>03</span>
                            <h4>Максимальная полнота материала</h4>
                            <p>Специальная методология для сдачи зачета по ПДД с 1-й попытки. Подтверждается в 99% случаев;</p>
                        </li>
                        <li>
                            <span>04</span>
                            <h4>Закрепление знаний</h4>
                            <p>Прохождение курса с 2-этапным закреплением знаний по принципу компьютерной игры. Тестирование с подсказками и зачет по каждому уроку;</p>
                        </li>
                    </ul>
                </div>
                <div class="second">
                    <ul>
                        <li>
                            <span>05</span>
                            <h4>Экономия времени</h4>
                            <p>Экономия как минимум 52 часов на дорогу в автошколу и обратно и 3000 рублей на проезд; Начало обучения в любое время без привязки к срокам комплектования группы в автошколе;</p>
                        </li>
                        <li>
                            <span>06</span>
                            <h4>Скорость прохождения</h4>
                            <p>Возможность быстрого прохождения 1-го блока ПДД (9 видеоуроков) и начала занятий по вождению в автошколе уже через 1-2 дня изучения курса;</p>
                        </li>
                        <li>
                            <span>07</span>
                            <h4>Объем материалов</h4>
                            <p>Курс «АвтоТренер» заменяет 140 часов лекций по ПДД за исключением 3 обязательных очных занятий по психологии и медицине. Эти занятия необходимо пройти в автошколе.</p>
                        </li>
                    </ul>
                    <img src="/img/3d.png" alt="">
                </div>
            </div>
        </div>
        <div class="suit" id="komu">
            <div class="container">
                <h2>«АвтоТренер» идеально подходит, если:</h2>
                <div>
                    <ul>
                        <li class="title">
                            <h5>Вы только планируете учиться в автошколе: </h5>
                        </li>
                        <li>Начните обучение прямо сейчас;</li>
                        <li>Занимайтесь в любое удобное вам время вместо посещения лекций в автошколе;</li>
                        <li>Сэкономьте время на дорогу в автошколу и обратно и затраты на проезд;</li>
                        <li>Сдавайте зачеты после каждого видеоурока и получайте крепкие знания ПДД;</li>
                        <li>Пропустите изучение ПДД, если вы и так их знаете;</li>
                        <li>Сдайте зачет по ПДД в автошколе и ГИБДД с 1-го раза;</li>
                    </ul>
                    <ul>
                        <li class="title">
                            <h5>Вы уже зачислены и обучаетесь в автошколе: </h5>
                        </li>
                        <li>Переключитесь с лекций по ПДД в автошколе на «АвтоТренер», чтобы:</li>
                        <li>Продолжить занятия в любое удобное вам время вместо посещения лекций в автошколе;</li>
                        <li>Сэкономить время на дорогу в автошколу и затраты на проезд;</li>
                        <li>Наверстать пропущенные лекции;</li>
                        <li>Прокачать уже полученные знания по ПДД; <br> Пропустить оставшиеся лекции, если вы и так знаете ПДД;</li>
                        <li>Сдать зачет по ПДД в автошколе и ГИБДД с 1-го раза;</li>
                    </ul>
                </div>
                <img src="/img/fingers.png" alt="">
                <h3>Сэкономьте своё время и получите консультацию прямо сейчас</h3>
                <span>Оставьте заявку на консультацию и наши специалисты свяжутся с вами в течение 15 минут.</span>
                <form>
                    <input type="text" placeholder="Ваше имя">
                    <input type="text" placeholder="Ваш телефон">
                    <button type="submit" class="btn-red">Отправить запрос</button>
                </form>
            </div>
        </div>
        <div class="comments" id="otzuv">
            <div class="container">
                <h3>Отзывы наших учеников: </h3>
                <div class="slick-wrapper">
                    <div class="slick-video">
                        <div class="slide">
                            <div class="video-wrapper">
                                <iframe height="380" src="https://www.youtube.com/embed/Ul9sFd-mFCU" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="slide">
                            <div class="video-wrapper">
                                <iframe height="380" src="https://www.youtube.com/embed/Ul9sFd-mFCU" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slick-wrapper second-slick-wrapper">
                    <div class="slick-text">
                        <div class="slide">
                            <span>Седжио Бодрый</span>
                            <h6>С удовольствием отмечу, что методика ONLINE обучения качественно справляется со своей задачей.</h6>
                            <p>Перед обучением поспрашивал друзей, знакомых как они проходили учебу в традиционных автошколах. И многие высказались, что на теорию "забивали". Якобы зачем нудные лекции слушать, да и время тратить на дорогу. Всё ведь верно))</p>
                        </div>
                        <div class="slide">
                            <span>Олеся Норкина</span>
                            <h6>Долго выбирала автошколу, знакомые посоветовали вашу автошколу.</h6>
                            <p>Скажу честно, сомневалась в качестве онлайн обучения, потом посмотрела первый урок на сайте, убедилась, что лучше и доступнее не объяснит даже самый опытный преподаватель. Мне кажется, что за онлайн обучением будущее!) Большой плюс, это соотношение цена-качество. Отдельное спасибо инструктору Алексею</p>
                        </div>
                        <div class="slide">
                            <span>Седжио Бодрый</span>
                            <h6>С удовольствием отмечу, что методика ONLINE обучения качественно справляется со своей задачей.</h6>
                            <p>Перед обучением поспрашивал друзей, знакомых как они проходили учебу в традиционных автошколах. И многие высказались, что на теорию "забивали". Якобы зачем нудные лекции слушать, да и время тратить на дорогу. Всё ведь верно))</p>
                        </div>
                        <div class="slide">
                            <span>Олеся Норкина</span>
                            <h6>Долго выбирала автошколу, знакомые посоветовали вашу автошколу.</h6>
                            <p>Скажу честно, сомневалась в качестве онлайн обучения, потом посмотрела первый урок на сайте, убедилась, что лучше и доступнее не объяснит даже самый опытный преподаватель. Мне кажется, что за онлайн обучением будущее!) Большой плюс, это соотношение цена-качество. Отдельное спасибо инструктору Алексею</p>
                        </div>
                    </div>
                </div>
                <span>Смотрите и читайте еще больше отзывов в социальных сетях</span>
                <ul class="icon-list clearfix">
                    <li class="icon-item">
                        <a href="" class="icon-link">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="icon-item">
                        <a href="" class="icon-link">
                            <i class="fa fa-google-plus" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="icon-item">
                        <a href="" class="icon-link">
                            <i class="fa fa-vimeo" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="icon-item">
                        <a href="" class="icon-link">
                            <i class="fa fa-tumblr" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="icon-item">
                        <a href="" class="icon-link">
                            <i class="fa fa-odnoklassniki" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="icon-item">
                        <a href="" class="icon-link">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="buy" id="sale">
            <div class="container">
                <img src="/img/box.png" alt="">
                <price-vue></price-vue>
                <div class="info">
                    <h3>Купить «АвтоТренер»:</h3>
                    <ul>
                        <li>64 видеоурока по ПДД в 3D;</li>
                        <li>Дистанционные занятия в любое время;</li>
                        <li>Игровой процесс обучения;</li>
                        <li>2-этапное закрепление знаний: тестирование с подсказками и зачет по каждому видеоуроку;</li>
                        <li>Крепкие знания для сдачи зачета в автошколе и в ГИБДД с 1-го раза;</li>
                    </ul>
                    @if (auth()->user())
                        <a href="{{route('user.finance')}}" class="btn-red">Купить онлайн</a>
                        <a href="{{route('user.finance')}}" class="btn-white">Активировать купон</a>
                    @else
                        <a href="{{route('authUser')}}" class="btn-red">Купить онлайн</a>
                        <a href="{{route('authUser')}}" class="btn-white">Активировать купон</a>
                    @endif
                </div>
                <p>*Обучение на курсе «АвтоТренер» не отменяет необходимость заключения договора с автошколой и оплаты полной стоимости обучения в автошколе, включая лекции по ПДД и вождение. Покупка курса – это ваши дополнительные расходы для получения более комфортных и действенных условий для изучения ПДД. <br>** Вы можете приобрести курс Автотренер в любой из автошкол Вашего города, контакты которых указаны на нашем сайте</p>
            </div>
        </div>
    </div>
@endsection