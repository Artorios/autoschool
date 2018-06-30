<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <h3>Статистика купонов:</h3>
            </div>
        </div>
        <div class="numberpeople">
            <div class="info row no-gutters-xs">
                <div class="col-xs-6 col-md-4 col-lg-3">
                    <div class="block">
                        <h3>Продано:</h3>
                        <span class="number">{{coupons.sale}}</span>
                    </div>

                </div>
                <div class="col-xs-6 col-md-4 col-lg-3">
                    <div class="block">
                        <h3>Активировано:</h3>
                        <span class="number">{{coupons.active}}</span>
                    </div>

                </div>
                <div class="col-xs-6 col-md-4 col-lg-3">
                    <div class="block">
                        <h3>Свободных:</h3>
                        <span class="number">{{coupons.free}}</span>
                    </div>

                </div>
                <div class="col-xs-6 col-md-4 col-lg-3">
                    <div class="block">
                        <h3>Аннулировано:</h3>
                        <span class="number">{{coupons.canceled}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "statistics",
        props: ['coupons'],
    }
</script>

<style scoped>

</style>