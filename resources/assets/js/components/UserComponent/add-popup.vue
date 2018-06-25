<template>
    <div class="modal fade in" id="modal-default" style="display: block; padding-top: 50px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="cancelChange">×</span></button>
                    <h4 class="modal-title" v-if="edit">Редактировать профиль</h4>
                    <h4 class="modal-title" v-else>Добавить профиль</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Имя*</label>
                                <p class="error" v-if="serverErrors.name">{{serverErrors.name[0]}}</p>
                                <input type="text" class="form-control" v-model="data.name">
                            </div>
                            <div class="form-group">
                                <label>Фамилия*</label>
                                <p class="error" v-if="serverErrors.last_name">{{serverErrors.last_name[0]}}</p>
                                <input type="text" class="form-control" v-model="data.last_name">
                            </div>
                            <div class="form-group">
                                <label>Отчество</label>
                                <p class="error" v-if="serverErrors.second_name">serverErrors.second_name[0]</p>
                                <input type="text" class="form-control" v-model="data.second_name">
                            </div>
                            <div class="form-group">
                                <label>Выберите регион</label>
                                <p class="error" v-if="serverErrors.city_id">{{serverErrors.city_id[0]}}</p>

                                <autocomplete
                                        url="/api/address/get-regions-api"
                                        anchor="name"
                                        label="writer"
                                        :initValue="checkedRegion ? checkedRegion.name : ''"
                                        :classes="{ wrapper: 'form-wrapper', input: 'form-control', list: 'data-list', item: 'data-list-item' }"
                                        :on-select="getData">
                                </autocomplete>

                            </div>
                            <div class="form-group" v-if="checkedRegion">
                                <label>Выберите город</label>

                                <autocomplete
                                        :url="city_url.concat(checkedRegion.id)"
                                        anchor="name"
                                        label="ru_path"
                                        ref="cityComplete"
                                        :initValue="checkedCity ? checkedCity.name : ''"
                                        :classes="{ wrapper: 'form-wrapper', input: 'form-control', list: 'data-list', item: 'data-list-item' }"
                                        :on-select="getDataCity">
                                </autocomplete>
                            </div>
                            <div class="form-group" v-if="edit && (data.role == 'autoschool' || data.role.slug == 'autoschool')">
                                <label>Центральный филиал</label>
                                <autocomplete
                                        :url="'/api/get-center-api/'+ user.id"
                                        anchor="title"
                                        label="filial_name"
                                        :initValue="checkedCentral ? checkedCentral['title'] : ''"
                                        :classes="{ wrapper: 'form-wrapper', input: 'form-control', list: 'data-list', item: 'data-list-item' }"
                                        :on-select="getDataCentral">
                                </autocomplete>
                            </div>
                            <div v-if="edit && (data.role == 'user' || data.role.slug == 'user')">
                                <div class="form-group">
                                    <label>Автошкола</label>
                                    <autocomplete
                                            url="/api/get-autoschool-api"
                                            anchor="title"
                                            label="filial_name"
                                            :initValue="checkedSchool ? checkedSchool['title'] : ''"
                                            :classes="{ wrapper: 'form-wrapper', input: 'form-control', list: 'data-list', item: 'data-list-item' }"
                                            :on-select="getDataSchool">
                                    </autocomplete>
                                </div>

                                <div class="form-group" v-if="checkedSchool">
                                    <label>Группа</label>
                                    <autocomplete
                                            :url="group_url.concat(checkedSchool)"
                                            anchor="name"
                                            label="writer"
                                            :initValue="checkedGroup ? checkedGroup.name : ''"
                                            :classes="{ wrapper: 'form-wrapper', input: 'form-control', list: 'data-list', item: 'data-list-item' }"
                                            :on-select="getDataGroup">
                                    </autocomplete>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email*</label>
                                <p class="error" v-if="serverErrors.email">{{serverErrors.email[0]}}</p>
                                <input type="text" class="form-control" v-model="data.email">
                            </div>
                            <div class="form-group">
                                <label>Телефон*</label>
                                <p class="error" v-if="serverErrors.phone">{{serverErrors.phone[0]}}</p>
                                <input type="text" class="form-control" v-model="data.phone">
                            </div>
                            <div class="form-group">
                                <label>Пароль*</label>
                                <p class="error" v-if="serverErrors.password">{{serverErrors.password[0]}}</p>
                                <input type="password" class="form-control" v-model="data.password">
                            </div>
                            <div class="form-group">
                                <label>Роль*</label>
                                <p class="error" v-if="serverErrors.role">{{serverErrors.role[0]}}</p>
                                <select class="form-control select2"
                                        style="width: 100%;"
                                        v-model="data.role"
                                        required>
                                    <option selected="selected" value="" disabled>Выберите роль</option>
                                    <option :value="role.slug" v-for="role in roles">{{role.name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Категория*</label>
                                <p class="error" v-if="serverErrors.license">{{serverErrors.license[0]}}</p>
                                <select class="form-control select2"
                                        style="width: 100%;"
                                        v-model="data.license"
                                        required>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal" @click="cancelChange">Отмена</button>
                    <button type="button" class="btn btn-primary" v-if="edit" @click="editUser">Сохранить изменения</button>
                    <button type="button" class="btn btn-primary" @click="createUser" v-else>Добавить пользователя</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    import {Events} from "../../app";
    require('vue2-autocomplete-js/dist/style/vue2-autocomplete.css')
    import Autocomplete from 'vue2-autocomplete-js'

    export default {
        data () {
            return {
                data: this.edit ? Object.assign({}, this.user) : {
                    name: '',
                    email: '',
                    role: '',
                    last_name: '',
                    second_name: '',
                    phone: '',
                    auto_school_group_id: '',
                    city_id: '',
                    license: '',
                    password: '',
                },
                checkedCentral: '',
                checkedSchool: '',
                checkedGroup: '',
                city_url: '/api/address/get-cities-api/',
                checkedRegion: null,
                checkedCity: null,

                group_url: '/api/get-schoolgroup-api/',
                roles: [
                    {
                        id: 1,
                        name: 'Администратор',
                        slug: 'admin'
                    },
                    {
                        id: 2,
                        name: 'Директор',
                        slug: 'autoschool'
                    },
                    {
                        id: 3,
                        name: 'Инвестор',
                        slug: 'investor'
                    },
                    {
                        id: 4,
                        name: 'Пользователь',
                        slug: 'user'
                    },

                ],
                errorEdit: false,
                serverErrors: {}
            }
        },
        created () {
            if(this.edit){
                if(this.user.auto_school_group_id){
                    this.checkedGroup = this.user.autoschoolgroup
                    this.checkedSchool = this.user.school



                }
                if(this.user.directors.length > 0){
                    for(let i = 0; i < this.user.directors.length; i++){
                        if(this.user.directors[i].central == 1 ){
                            this.checkedCentral = this.user.directors[i]
                        }
                    }
                }
                this.checkedRegion = this.user.city.region
                this.checkedCity = this.user.city

            }
        },
        watch: {
            checkedCity: function (val) {
                if (val) {
                    this.data.city_id = val.id
                }
            },

        },

        props: ['user', 'edit'],
        components: {
            Autocomplete
        },
        methods: {
            getData(val) {
                this.checkedRegion = val
                this.checkedCity = null
                this.$refs.cityComplete ? this.$refs.cityComplete.setValue('') : ''
            },
            getDataCity(val) {
                this.checkedCity = val
            },

            cancelChange () {
                Events.$emit('toggle-popup')
            },
            editUser () {
//                console.log(this.school)
                if(this.checkedCity){
                    this.data.city_id = this.checkedCity.id
                }
                if(this.checkedSchool){
                    if(this.checkedGroup){
                        if(this.checkedGroup.id){
                            this.data.auto_school_group_id = this.checkedGroup.id
                        }
                        else {
                            this.data.auto_school_group_id = this.checkedGroup
                        }
                    }
                    else {
                        alert('Не сохранено! Выберите группу!');
                    }
                }
                if(this.checkedCentral){
                    if(this.checkedCentral.id){
                        this.data.central = this.checkedCentral.id
                    }
                    else{
                        this.data.central = this.checkedCentral
                    }

                }

                this.$http.put('/admin/user/edit-user/' + this.user.id, this.data).then(res => {
                    if (res.status === 202) {
                        location.href = '/admin/users'
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                    this.serverErrors = err.data.errors

                })
            },
            createUser () {
                if(this.checkedCity){
                    this.data.city_id = this.checkedCity.id
                }
                console.log(this.data)
                this.$http.post('/admin/user/create', this.data).then(res => {
                    if (res.status === 201) {
                        window.location.href = '/admin/users'
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                    this.serverErrors = err.data.errors
                })
            },
            getDataSchool(val){
                this.checkedSchool = val.id
                this.checkedGroup = ''
            },
            getDataGroup(val){
                this.checkedGroup = val.id
            },
            getDataCentral(val){
                this.checkedCentral = val.id
            },


        }
    }
</script>

<style>
    p.error {
        color: red;
    }
</style>