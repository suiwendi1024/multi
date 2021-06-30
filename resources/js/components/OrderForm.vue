<template>
    <form action="" method="post" @submit.prevent="handleSubmit">
        <ul class="list-group list-group-flush">
            <li
                v-for="(ware, index) in wares"
                :key="ware.id"
                class="list-group-item"
            >
                <div class="row">
                    <div class="col-md-2">
                        <img class="img-fluid" :src="ware.product.cover_url" alt="">
                    </div>
                    <div class="col-md">
                        <h4>{{ ware.product.name }}</h4>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input type="hidden" :value="ware.product.id">
                                <input class="form-control-plaintext text-danger" type="text" readonly
                                       :value="'￥' + ware.product.price">
                            </div>
                            <div class="col-md-4">
                                <input
                                    class="form-control-plaintext"
                                    type="text"
                                    :value="'x' + items[index].quantity"
                                    min="1"
                                    max="999"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="list-group-item text-right text-danger">￥{{ total }}</li>
        </ul>

        <button class="btn btn-primary" type="submit">结算</button>
    </form>
</template>

<script>
export default {
    name: "OrderForm",

    props: {
        wares: { type: Array, required: true },
    },

    data() {
        return {
            items: this.getItems()
        }
    },

    computed: {
        total() {
            let total = 0

            for (let index in this.wares) {
                if (this.wares.hasOwnProperty(index)) {
                    total += this.wares[index].product.price.replace('.', '') * this.wares[index].quantity
                }
            }

            return total / 100
        }
    },

    methods: {
        getItems() {
            let items = []

            for (let index in this.wares) {
                if (this.wares.hasOwnProperty(index)) {
                    items[index] = { id: this.wares[index].id, quantity: this.wares[index].quantity }
                }
            }

            return items
        },

        handleSubmit() {
            axios.post('/api/orders/', { wares: this.items }).then(() => {
                location.href = '/orders'
            })
        },
    }
}
</script>

<style scoped>

</style>
