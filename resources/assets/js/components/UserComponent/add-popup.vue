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
                                <input type="text" class="form-control" v-model="data.name">
                            </div>
                            <div class="form-group">
                                <label>Фамилия*</label>
                                <input type="text" class="form-control" v-model="data.last_name">
                            </div>
                            <div class="form-group">
                                <label>Отчество</label>
                                <input type="text" class="form-control" v-model="data.second_name">
                            </div>
                            <div v-if="edit">
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
                                <input type="text" class="form-control" v-model="data.email">
                            </div>
                            <div class="form-group">
                                <label>Телефон*</label>
                                <input type="text" class="form-control" v-model="data.phone">
                            </div>
                            <div class="form-group">
                                <label>Роль*</label>
                                <select class="form-control select2"
                                        style="width: 100%;"
                                        v-model="data.role"
                                        required>
                                    <option selected="selected" value="" disabled>Выберите роль</option>
                                    <option :value="role.slug" v-for="role in roles">{{role.name}}</option>
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
                    auto_school_group_id: ''
                },
                checkedSchool: '',
                checkedGroup: '',
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
                errorEdit: false
            }
        },
        created () {
            if(this.user.auto_school_group_id){
                this.checkedGroup = this.user.autoschoolgroup
                this.checkedSchool = this.user.school



            }
        },
        props: ['user', 'edit'],
        components: {
            Autocomplete
        },
        methods: {
            cancelChange () {
                Events.$emit('toggle-popup')
            },
            editUser () {
//                console.log(this.school)
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

                this.$http.put('/admin/user/edit-user/' + this.user.id, this.data).then(res => {
                    if (res.status === 202) {
                        location.href = '/admin/users'
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            },
            createUser () {
                console.log(this.data)
                this.$http.post('/admin/user/create', this.data).then(res => {
                    if (res.status === 201) {
                        //location.href = '/admin/users'
                        console.log(res.data)
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            },
            getDataSchool(val){
                this.checkedSchool = val.id
                this.checkedGroup = ''
            },
            getDataGroup(val){
                this.checkedGroup = val.id
            },


        }
    }
</script>