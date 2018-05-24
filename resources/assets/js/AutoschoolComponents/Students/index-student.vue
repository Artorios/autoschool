<template>
    <div class="personal">
        <div class="row">
            <div class="col-md-4">
                <div class="img-profile">
                    <img v-bind:src="`/img/${student_with_orders.image}`" alt="" class="img-profile">
                </div>
            </div>
            <div class="col-md-8">
                <h3 v-text="getFullName()"></h3>
                <div class="date-examination">
                    <div class="row">
                        <div class="col-md-4">Дата и время екзамена</div>
                        <div class="col-md-3">
                            <img src="/img/clock.png" alt=""> {{student_with_auto_school.exam_date}}</div>
                        <div class="col-md-3" v-text="student_with_auto_school.exam_time"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <a :href="student_with_auto_school.userId + '/statistic-test'" class="btn-grey">Статистика зачетов</a>
                    </div>
                    <div class="col-md-5">
                        <a :href="student_with_auto_school.userId + '/statistic-exam'" class="btn-grey">Статистика экзамена</a>
                    </div>
                </div>
                <div class="row block-info">
                    <div class="col-md-12">
                        <div class="info">
                                <span class="address">
                                    <img src="/img/location.png" alt="">
                                    {{student_with_address.cityName}}
                                </span>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="info"><img src="/img/tel.png" alt="">
                            <span class="number">
                                 {{student_with_orders.phone}}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info"><img src="/img/mail.png" alt="">
                            <span class="mail">
                                    <a :href="`mailto:mailto:${student_with_orders.email}`"
                                       v-text="student_with_orders.email">
                                    </a>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row inner-block">
            <div class="col-md-4 col-xs-12 col-sm-12">
                Филиал:
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12">
                <div class="form-group">
                    <select class="select">
                        <option v-text="student_with_auto_school.title"></option>
                    </select>
                </div>

            </div>
            <div class="col-md-4 col-xs-12 col-sm-12">
                Группа:
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12">
                <div class="form-group">
                    <select class="select">
                        <option v-text="student_with_auto_school.autoSchoolGroupName"></option>
                    </select>
                </div>
            </div>
            <div class="clearfix">
                <div class="col-md-4 col-xs-6 ">
                    Метод оплаты:
                </div>
                <div class="col-md-8 col-xs-6" v-text="student_with_orders.payment_option"></div>
            </div>
            <div class="clearfix">
            <div class="col-md-4 col-xs-6">
                Дата оплаты:
            </div>
            <div class="col-md-8 col-xs-6" v-text="student_with_orders.created_at"></div>
            </div>
            <div class="clearfix">
            <div class="col-md-4 col-xs-6">
                Дата регистрации в ситеме:
            </div>
            </div>
            <div class="col-md-8 col-xs-6" v-text="student_with_orders.DateCreateUser"></div>
            <div class="col-md-4"></div>
            <!--<div class="col-md-8 col-xs-12 col-sm-12">-->
                    <!--<textarea name="" id="" class="form-control" cols="0" rows="5" placeholder="Комментарий">-->
                    <!--</textarea>-->
                <!--<a href="" class="btn-grey">Сохранить изменения</a>-->
            <!--</div>-->
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        props: {
            student_with_orders: {},
            student_with_auto_school: {},
            student_with_address: {}
        },

        methods: {
            getFullName(){
                return `${this.student_with_orders.userName} ${this.student_with_orders.second_name} ${this.student_with_orders.last_name}`
            }
        },
    }
</script>

<style scoped>

</style>