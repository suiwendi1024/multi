<template>
    <a href="#" class="text-decoration-none" @click.prevent="toggleFavorite">
        <span :class="favorite.class">&starf;</span>
        {{ favoritesCount }}
    </a>
</template>

<script>
export default {
    name: "FavoriteButton",
    props: {
        favoritable: { type: Object, required: true },
        type: { type: String, required: true },
    },
    data() {
        return {
            user: user,
            isFavorited: this.favoritable.is_favorited,
            favoritesCount: this.favoritable.favorites_count,
        }
    },
    computed: {
        favorite() {
            return this.isFavorited ? { class: 'text-danger' } : { class: '' };
        },
    },
    methods: {
        toggleFavorite() {
            if (user) {
                let url = `/api/${this.type}/${ this.favoritable.id }/favorites`;

                if (!this.isFavorited) {
                    axios.post(url).then(() => {
                        this.isFavorited = !this.isFavorited;
                        this.favoritesCount++;
                    });
                } else {
                    axios.delete(url).then(() => {
                        this.isFavorited = !this.isFavorited;
                        this.favoritesCount--;
                    });
                }
            } else {
                alert('请先登录！');
            }
        },
    }
}
</script>

<style scoped>

</style>
