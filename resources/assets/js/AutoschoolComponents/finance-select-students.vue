<template>
    <h1>qwerty</h1>
    <!--<div class="coupon-table">-->
        <!--<div class="table-wrapper">-->
            <!--<div class="title-line">-->
                <!--<span class="number">№</span>-->
                <!--<span class="name-student">ФИО ученика</span>-->
                <!--<span class="name-student-group">Група</span>-->
                <!--<span class="name-student-type-offer">Тип оплаты</span>-->
                <!--<span class="date">Дата оплаты</span>-->
                <!--<span class="price">Сумма оплаты</span>-->
            <!--</div>-->

            <!--<div class="block-media-768 active">-->
                <!--<div>-->
                    <!--<div class="coupons-cheskbox">-->
                        <!--<input type="checkbox"></div>-->
                <!--</div>-->
                <!--<div>-->
                    <!--<div class="number">{{key}}</div>-->
                <!--</div>-->
                <!--<div>-->
                    <!--<span class="name-student">-->
                         <!--{{user.studentName}} {{user.second_name}} {{user.last_name}}-->
                    <!--</span>-->

                    <!--<div>-->
                        <!--<span>Група {{user.autoSchoolGroupName}}</span>-->
                    <!--</div>-->
                    <!--<div class="activate-date">-->
                        <!--<span>Дата оплаты</span>-->
                        <!--<a href="">{{user.created_at}}</a>-->
                    <!--</div>-->
                    <!--<div class="price"><span>Сумма оплаты </span>-->
                        <!--<span style="font-weight: bold">{{user.price}}</span>-->
                    <!--</div>-->

                    <!--<div class="status">-->
                        <!--<span>Статус</span>-->
                        <!--<span class="status-active"><a href="">Активирован</a></span>-->
                        <!--<span class="status-free"><a href="">Свободный</a></span>-->
                        <!--<span class="status-paid"><a href="">Выплачен</a> <img src="/img/attention.png" alt=""></span>-->

                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->

            <!--<div class="line active">-->
                <!--<div class="coupons-cheskbox"><input type="checkbox"></div>-->
                <!--<div class="number">{{++key}}</div>-->
                <!--<div class="autoschool">-->
                    <!--{{user.studentName}} {{user.second_name}} {{user.last_name}}-->
                <!--</div>-->
                <!--<div>-->
                    <!--<span>Група {{user.autoSchoolGroupName}}</span>-->
                <!--</div>-->
                <!--<div class="activate-date">-->
                    <!--<span>Дата оплаты</span>-->
                    <!--<a href="">{{user.created_at}}</a>-->
                <!--</div>-->
                <!--<div class="price"><span>Сумма оплаты </span>-->
                    <!--<span style="font-weight: bold">{{user.price}}</span>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
</template>

<script>
    export default {
        data (){
            return {

            }
        },
        props: ['users'],
    }
</script>

<style scoped>

</style>