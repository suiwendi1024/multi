<template>
    <form action="/orders" method="post" @submit.prevent="handleSubmit">
        <ul class="list-group list-group-flush">
            <li
                v-for="(product, index) in products"
                :key="product.id"
                class="list-group-item"
            >
                <div class="row">
                    <div class="col-md-2">
                        <img class="img-fluid" :src="product.cover_url" alt="">
                    </div>
                    <div class="col-md">
                        <h3>{{ product.name }}</h3>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input name="product[][id]" type="hidden" :value="product.id">
                                <input class="form-control-plaintext text-danger" type="text" readonly :value="'￥' + product.price">
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="number" name="product[][quantity]" v-model="items[index].quantity">
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="list-group-item text-right">{{ total }}</li>
        </ul>

        <button class="btn btn-primary" type="submit">结算</button>
    </form>
</template>

<script>
export default {
    name: "OrderForm",
    props: {
        products: { type: Array, required: true },
    },
    data() {
        return {
            items: this.getItems(),
        };
    },
    computed: {
        total() {
            let total = 0;

            for (let index in this.items) {
                if (this.items.hasOwnProperty(index)) {
                    let product = this.items[index];
                    let price = this.products[index].price.replace('.', '');
                    total += price * product.quantity / 100;
                }
            }

            return total;
        }
    },
    methods: {
        getItems() {
            let items = [];
            for (let product of this.products) {
                items.push({ id: product.id, quantity: product.quantity })
            }
            return items;
        },
        handleSubmit() {
            axios.post('/api/orders', { items: this.items }).then(() => {
                console.log(location.hostname + '/products');
                location.href = location.hostname + '/products';
            });
        },
    }
}
</script>

<style scoped>

</style>
