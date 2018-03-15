<template>
    <div class="modal fade in" id="modal-default" style="display: block; padding-top: 50px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="cancelChange">×</span></button>
                    <h4 class="modal-title">Редактировать профиль</h4>
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
    export default {
        data () {
            return {
                data: this.edit ? Object.assign({}, this.user) : {
                    name: '',
                    email: '',
                    role: '',
                    last_name: '',
                    second_name: '',
                    phone: ''
                },
                roles: [
                    {
                        id: 1,
                        name: 'Администратор',
                        slug: 'admin'
                    },
                    {
                        id: 2,
                        name: 'Модератор',
                        slug: 'moderator'
                    },
                    {
                        id: 3,
                        name: 'Пользователь',
                        slug: 'user'
                    },

                ],
                errorEdit: false
            }
        },
        props: ['user', 'edit'],
        methods: {
            cancelChange () {
                Events.$emit('toggle-popup')
            },
            editUser () {
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
                this.$http.post('/admin/user/create', this.data).then(res => {
                    if (res.status === 201) {
                        location.href = '/admin/users'
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            }
        }
    }
</script>