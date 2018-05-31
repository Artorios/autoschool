<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blank page

                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Настройки уроков</h3>
                </div>
                <div class="box-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="">

                                </div>
                                <div v-for="setting in lessonsSettings">
                                    <label>{{setting.title}}</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" v-model="setting.value">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-flat" @click="changeValue(setting)"><i class="fa fa-edit"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
</template>

<script type="text/babel">
    export default {
        data () {
            return {}
        },
        props: ['lessonsSettings'],
        methods: {
            changeValue (setting) {
                this.$http.put('/admin/lessons-settings/' + setting.id, setting)
            }
        }
    }
</script>