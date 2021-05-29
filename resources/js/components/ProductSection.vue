<template>
    <div class="container">
        <div class="row">
            <div
                v-for="product in items"
                :key="product.id"
                class="col-md-3 mb-3"
            >
                <div class="card">
                    <img class="card-img-top" :src="product.cover_url" alt="">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a :href="product.path" target="_blank">{{ product.name }}</a>
                        </h4>
                        <h6 class="card-subtitle text-danger">￥ {{ product.price }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductSection",
    props: {
        products: { type: Array, required: true },
    },
    data() {
        return {
            items: this.getItems(),
            meta: {},
            url: `/api/products`,
        };
    },
    mounted() {
        this.checkScroll();
    },
    methods: {
        getItems() {
            let items = [];
            for (let product of this.products) {
                items.push(Object.assign({}, product));
            }
            return items;
        },
        fetchProducts() {
            axios.get(this.url, { params: { page: (this.meta.current_page || 1) + 1 } }).then(({ data: { data, meta } }) => {
                this.items.push(...data);
                this.meta = meta;
                this.checkScroll();
            });
        },
        checkScroll() {
            window.addEventListener('scroll', this.handleScroll, true);
        },
        handleScroll() {
            if ($(document).height() - $(window).scrollTop() - $(window).height() < 200) {
                window.removeEventListener('scroll', this.handleScroll, true);
                this.fetchProducts();
            }
        },
    },
}
</script>

<style scoped>

</style>
