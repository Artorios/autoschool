<template>
    <table class="table manage-grid">
        <thead>
        <tr class="visible-md visible-lg">
            <th>№</th>
            <th>Дата</th>
            <th>Вид операции</th>
            <th>Комментарий</th>
        </tr>
        </thead>
        <tbody class="main">
        <tr data-id="1" class="visible-md visible-lg" v-for="item in list">
            <td>{{ item.id }}</td>
            <td>{{ item.updated_at }}</td>
            <td>{{ item.auto_school_id }}</td>
            <td>{{ item.comment }}</td>
        </tr>
        </tbody>
        <tfoot class="finance-line-height">
        <tr>
            <td colspan="9">
                <div class="row nero">
                    <div class="col-md-2 margin-12">
                        <input type="checkbox"> Для всех
                    </div>
                    <div class="col-md-2 margin-12 margin-y-10">
                        Отмечено 1 из 12
                    </div>

                    <div class="col-xs-12 col-md-2 margin-y-10"><a type="text" class="btn-grey">Анулировать</a></div>
                    <div class="col-xs-12 col-md-2 margin-y-10"><a type="text" class="btn-grey">Удалить</a></div>
                    <div class="col-xs-12 col-md-4 margin-y-10">
                        <select class="select">
                            <option selected disabled>Виберите действие</option>
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>
                </div>
            </td>
        </tr>
        </tfoot>
    </table>
</template>

<script>
    export default {
        data() {
            return {
                list: []
            }
        },
        mounted() {
            window.axios.get('/investor/history/list')
                .then((response) => {
                    this.list = response.data
                })
        }
    }
</script>