<template>
    <div class="modal fade in" id="modal-default" style="display: block; padding-top: 0px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="cancelChange">×</span></button>
                    <h4 class="modal-title">Добавить автошколу</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <label>Информация</label>
                            <div class="form-group">
                                <label>Название</label>
                                <input type="text" class="form-control" v-model="data.title">
                            </div>
                            <div class="form-group">
                                <label>Описание</label>
                                <textarea class="form-control" v-model="data.description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Выберите регион</label>
                                <autocomplete
                                        url="/api/address/get-regions-api"
                                        anchor="name"
                                        label="writer"
                                        :classes="{ wrapper: 'form-wrapper', input: 'form-control', list: 'data-list', item: 'data-list-item' }"
                                        :initValue="checkedRegion ? checkedRegion.name : ''"
                                        :on-select="getData">
                                </autocomplete>
                            </div>
                            <div class="form-group" v-if="checkedRegion">
                                <label>Выберите город</label>
                                <autocomplete
                                        :url="'/api/address/get-cities-api/' + checkedRegion.id"
                                        anchor="name"
                                        label="ru_path"
                                        ref="cityComplete"
                                        :initValue="checkedCity ? checkedCity.name : ''"
                                        :classes="{ wrapper: 'form-wrapper', input: 'form-control', list: 'data-list', item: 'data-list-item' }"
                                        :on-select="getDataCity">
                                </autocomplete>
                            </div>
                            <div class="form-group">
                                <label>Выберите директора</label>
                                <autocomplete
                                        url="/api/get-directors-api"
                                        anchor="email"
                                        label="last_name"
                                        :initValue="checkedDirector ? checkedDirector.name : ''"
                                        :classes="{ wrapper: 'form-wrapper', input: 'form-control', list: 'data-list', item: 'data-list-item' }"
                                        :on-select="getDataDirector">
                                </autocomplete>
                                <a @click="delDirector" style="color: red; cursor: pointer">Удалить</a>
                            </div>
                            <div class="form-group">
                                <label>Выберите инвестора</label>
                                <autocomplete
                                        url="/api/get-investors-api"
                                        anchor="email"
                                        label="last_name"
                                        :classes="{ wrapper: 'form-wrapper', input: 'form-control', list: 'data-list', item: 'data-list-item' }"
                                        :on-select="getDataInvestor">
                                </autocomplete>
                                <a @click="delInvestor" style="color: red; cursor: pointer">Удалить</a>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="body-box custom-height">
                                <label>Контакты</label>
                                <div class="row" v-for="contact in data.contacts">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Тип</label>
                                            <select name="type" class="form-control" v-model="contact.type">
                                                <!--<option value="address" >Адрес</option>-->

                                                <option :value="type.slug" v-for="type in types">{{type.name}}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Значение</label>
                                            <input type="text" class="form-control" v-model="contact.value">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-box">
                                <button class="btn btn-default" @click="addContactsField">Добавить поле</button>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal" @click="cancelChange">Отмена</button>
                    <button type="button" class="btn btn-primary" v-if="edit" @click="editSchool">Сохранить изменения</button>
                    <button type="button" class="btn btn-primary" @click="createSchool" v-else>Добавить автошколу</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<style lang="scss">
    .custom-height{
        height: 250px;
        overflow-y: scroll;
        overflow-x: hidden;
        padding: 0 5px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
</style>

<script>
    import {Events} from "../../app"
    require('vue2-autocomplete-js/dist/style/vue2-autocomplete.css')
    import Autocomplete from 'vue2-autocomplete-js'
    export default {
        data () {
            return {
                data: this.edit ? Object.assign({}, this.user) : {
                    title: '',
                    description: '',
                    city_id: '',
                    contacts: [
                        {
                            value: '',
                            type: '0'
                        }
                    ],
                    director_id: '',
                    investor_id: '',

                },
                types: [
                    {
                        id: 1,
                        name: 'Адрес',
                        slug: 'address'
                    },
                    {
                        id: 2,
                        name: 'Телефон',
                        slug: 'phone'
                    }
                ],
                errorEdit: false,
                checkedRegion: null,
                checkedCity: null,
                checkedInvestor: null,
                checkedDirector: null,
            }
        },
        props: ['school', 'edit'],
        components: {
            Autocomplete
        },
        watch: {
            checkedCity: function (val) {
                if (val) {
                    this.data.city_id = val.id
                }
            },
        },
        methods: {
            cancelChange () {
                Events.$emit('toggle-popup-school')
            },
            getData (val) {
                this.checkedRegion = val
                this.checkedCity = null
                this.$refs.cityComplete ? this.$refs.cityComplete.setValue('') : ''
            },
            getDataCity (val) {
                this.checkedCity = val
            },
            getDataDirector (val) {
                this.data.director_id = val.id
            },
            delDirector(){
                this.data.director_id = ''
            },
            getDataInvestor (val) {
                this.data.investor_id = val.id
                console.log(this.data.investor_id)

            },
            delInvestor(){
                this.data.investor_id = ''
                console.log(this.data.investor_id)
            },
            editSchool () {
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
            createSchool () {
                console.log(this.data)
                this.$http.post('/admin/schools/create', this.data).then(res => {
                    if (res.status === 201) {
                        location.href = '/admin/schools'
                    } else {
                        this.errorEdit = true
                    }
                }, err => {
                    this.errorEdit = true
                })
            },
            addContactsField () {
                this.data.contacts.push({
                    value: '',
                    type: '0'
                })
            },
            spliceContactsField (i) {
                this.data.contacts.splice(i, 1)
            }
        }
    }
</script>