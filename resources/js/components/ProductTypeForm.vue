<template>
    <form action="">
        <div class="form-group row">
            <label for="inputQuantity" class="col-sm-2 col-form-label">数量</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" id="inputQuantity" min="1" max="999" v-model="quantity">
            </div>
        </div>
        <button type="button" class="btn btn-light btn-lg border-danger text-danger" @click="handleBuy('order')">立即购买</button>
        <button type="button" class="btn btn-danger btn-lg" @click="handleBuy('cart')">加入购物车</button>
    </form>
</template>

<script>
export default {
    name: "ProductTypeForm",

    props: {
        product: Object,
    },

    data() {
        return {
            quantity: 1,
        }
    },

    computed: {
        isLoggedIn() {
            return user != null
        }
    },

    methods: {
        handleBuy(type) {
            if (this.isLoggedIn) {
                let data = { product: this.product.id, quantity: this.quantity, type: type }

                axios.post('/api/wares', data).then(() => {
                    if (type === 'order') {
                        location.href = '/orders/create'
                    }
                })
            } else {
                location.href = '/login'
            }
        },
    }
}
</script>

<style scoped>

</style>
