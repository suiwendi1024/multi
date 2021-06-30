<template>
    <form action="">
        <ul class="list-group list-group-flush">
            <li
                v-for="(ware, index) in wares"
                :key="ware.id"
                class="list-group-item"
            >
                <div class="row">
                    <div class="col-md-2 d-flex">
                        <div class="custom-control custom-checkbox align-self-center">
                            <input
                                type="checkbox"
                                class="custom-control-input"
                                :id="'customCheck' + index"
                                v-model="items[index].is_selected"
                                @change="handleChange(index)"
                            >
                            <label class="custom-control-label" :for="'customCheck' + index"></label>
                        </div>

                        <img class="img-fluid" :src="ware.product.cover_url" alt="">
                    </div>
                    <div class="col-md">
                        <h3>{{ ware.product.name }}</h3>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input type="hidden" :value="ware.product.id">
                                <input class="form-control-plaintext text-danger" type="text" readonly
                                       :value="'￥' + ware.product.price">
                            </div>
                            <div class="col-md">
                                <input
                                    class="form-control"
                                    type="number"
                                    v-model="items[index].quantity"
                                    min="1"
                                    max="999"
                                    @change="handleChange(index)"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="list-group-item text-right text-danger">￥{{ total }}</li>
        </ul>

        <a class="btn btn-primary" role="button" href="/orders/create">下单</a>
    </form>
</template>

<script>
export default {
    name: "WareForm",

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
                    total += this.wares[index].product.price.replace('.', '') * this.items[index].quantity
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
                    let { id, quantity, is_selected } = this.wares[index]
                    items[index] = { id, quantity, is_selected }
                }
            }

            return items
        },

        handleChange(index) {
            let { quantity, is_selected } = this.items[index]

            axios.patch(`/api/wares/${ this.items[index].id }`, { quantity, is_selected }).then(() => {
                //
            })
        }
    }
}
</script>

<style scoped>

</style>
