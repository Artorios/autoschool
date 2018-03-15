<template>
    <div class="modal fade in" id="modal-default" style="display: block; padding-top: 50px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cancelChange">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Подтвердите удаление</h4>
                </div>
                <div class="modal-body">
                    <p>Вы уверены что хотите удалить урок {{lesson.title}}?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal" @click="cancelChange">Отмена</button>
                    <button type="button" class="btn btn-primary" @click="delLesson">Удалить</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script type="text/babel">
    import {Events} from "../../app"
    export default {
        data () {
            return {}
        },
        props: ['lesson'],
        methods: {
            delLesson () {
                this.$http.delete('/admin/lessons/' + this.lesson.id).then(res => {
                    if (res.status === 202) {
                        location.reload()
                    }
                })
            },
            cancelChange () {
                Events.$emit('toggle-popup')
            }
        }
    }
</script>