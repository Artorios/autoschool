<template>
    <div class="personal">
        <div class="row">
            <div class="col-md-4">
                <div class="img-profile">
                    <img v-bind:src="`/img/${student.image}`" alt="" class="img-profile">
                </div>
            </div>
            <div class="col-md-8">
                <h3 v-text="getFullName()"></h3>

                <div class="row">
                    <div class="col-md-5">
                        <a :href="student.id + '/statistic-test'" class="btn-grey">Статистика зачетов</a>
                    </div>
                    <div class="col-md-5">
                        <a :href="student.id + '/statistic-exam'" class="btn-grey">Статистика экзамена</a>
                    </div>
                </div>
                <div class="row block-info">
                    <div class="col-md-12">
                        <div class="info">
                                <span class="address">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    {{student.city.name}}
                                </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info">
                            <span class="number">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                                 {{student.phone}}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info">
                            <span class="mail">
                            <i class="fa fa-envelope-open" aria-hidden="true"></i>
                                    <a :href="`mailto:mailto:${student.email}`"
                                       v-text="student.email">
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
                        <option v-text=""></option>
                    </select>
                </div>

            </div>
            <div class="col-md-4 col-xs-12 col-sm-12">
                Группа:
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12">
                <div class="form-group">
                    <select class="select">
                        <option></option>
                    </select>
                </div>
            </div>
            <div v-if="student.orders" v-for="order in student.orders">
                <div class="clearfix">
                    <div class="col-md-4 col-xs-6 ">
                        Метод оплаты:
                    </div>
                    <div class="col-md-8 col-xs-6"  >
                        <div v-text="order.payment_option"></div>
                    </div>
                </div>
                <div class="clearfix">
                <div class="col-md-4 col-xs-6">
                    Дата оплаты:
                </div>
                    <div class="col-md-8 col-xs-6" v-text="student.created_at"></div>
                </div>

            </div>
            <div v-if="student.orders" v-for="coupon in student.coupons">
                <div v-if="coupon.status == 3">
                    <div class="clearfix">
                        <div class="col-md-4 col-xs-6 ">
                            Метод оплаты:
                        </div>
                        <div class="col-md-8 col-xs-6"  >
                            <div v-text="'Купон ' +coupon.code"></div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="col-md-4 col-xs-6">
                            Дата оплаты:
                        </div>
                        <div class="col-md-8 col-xs-6" v-text="coupon.created_at"></div>
                    </div>
                </div>

            </div>
            <div class="clearfix">
                <div class="col-md-4 col-xs-6 ">
                    Дата регистрации в системе:
                </div>
                <div class="col-md-8 col-xs-6"  >
                    <div v-text="student.created_at"></div>
                </div>
            </div>
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
            student: {},
        },

        methods: {
            getFullName(){
                return `${this.student.name} ${this.student.second_name} ${this.student.last_name}`
            }
        },
    }
</script>

<style scoped>

</style>