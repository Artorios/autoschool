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
                            <i class="fa fa-clock-o fa-lg" aria-hidden="true"></i>
                            {{student_with_auto_school.exam_date}}
                        </div>
                        <div class="col-md-3" v-text="student_with_auto_school.exam_time"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <a :href="student_with_auto_school.userId + '/statistic-test'" class="btn-grey">Статистика
                            зачетов</a>
                    </div>
                    <div class="col-md-5">
                        <a :href="student_with_auto_school.userId + '/statistic-exam'" class="btn-grey">Статистика
                            экзамена</a>
                    </div>
                </div>
                <div class="row block-info">
                    <div class="col-md-12">
                        <div class="info">
                                <span class="address">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    {{student_with_address.cityName}}
                                </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info">
                            <span class="number">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                                 {{student_with_orders.phone}}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info">
                            <span class="mail">
                            <i class="fa fa-envelope-open" aria-hidden="true"></i>
                                    <a :href="`mailto:mailto:${student_with_orders.email}`"
                                       v-text="student_with_orders.email">
                                    </a>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-xs-12 col-sm-12">
                <span class="autocomplete-label">Филиал:</span>
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12">
                <autocomplete placeholder="Филиал"
                              :url="'/api/get-filials-api/'+director.id"
                              anchor="title"
                              label="filial_name"
                              :initValue="checkedFilial ? checkedFilial.title : ''"
                              :classes="{ wrapper: 'search-wrap', input: 'search-input', list: 'search-block', item: 'data-list-item' }"
                              :on-select="selectFilial">
                </autocomplete>
                <!--label="writer"-->


            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-xs-12 col-sm-12">
                <span class="autocomplete-label">Группа:</span>
            </div>
            <span class="error" v-if="errorEdit">Выберите группу</span>
            <div class="col-md-8 col-xs-12 col-sm-12">
                <autocomplete placeholder="Группа"
                              :url="'/api/get-schoolgroup-api/'+checkedFilial.id"
                              anchor="name"
                              label="writer"
                              :initValue="checkedGroup ? checkedGroup.name : ''"
                              :classes="{ wrapper: 'search-wrap', input: 'search-input', list: 'search-block', item: 'data-list-item' }"
                              :on-select="selectGroup">
                </autocomplete>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-xs-12 col-sm-12 col-md-offset-4">
                <a class="btn-grey btn-save" @click="saveGroup()">Сохранить изменения</a>
            </div>
        </div>

        <div class="row inner-block">


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
                    Дата регистрации в системе:
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
    require('vue2-autocomplete-js/dist/style/vue2-autocomplete.css')
    import Autocomplete from 'vue2-autocomplete-js'

    export default {
        data() {
            return {
                data: {
                    auto_school_group_id: '',
                    user_id: ''
                },
                checkedFilial: '',
                checkedGroup: '',
                errorEdit: false
            }
        },
        props: {
            student_with_orders: {},
            student_with_auto_school: {},
            student_with_address: {},
            director: {},
            group: {},
            student: {},
        },
        created() {
            this.checkedGroup = this.group
            this.checkedFilial = this.group.autoschool
        },
        components: {
            Autocomplete
        },
        methods: {
            getFullName() {
                return `${this.student_with_orders.userName} ${this.student_with_orders.second_name} ${this.student_with_orders.last_name}`
            },
            selectFilial(val) {
                this.checkedFilial = val
            },
            selectGroup(val) {
                this.checkedGroup = val
            },
            saveGroup() {
                if (this.checkedGroup.id) {
                    this.data.auto_school_group_id = this.checkedGroup.id
                    this.data.user_id = this.student.id
                    this.$http.post('/autoschool/filials/new/save-group', this.data).then(res => {
                        console.log(res.data)
                        if (res.status === 202) {
                            // location.href = '/autoschool/filials'
                        } else {
                        }
                    }, err => {
                        console.log(err.data)
                    })

                }
                else {
                    this.errorEdit = true
                }
            }
        },
    }
</script>

<style>

</style>