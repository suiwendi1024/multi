<template>
    <a href="#" class="text-decoration-none" @click.prevent="toggleLike">
        <span :class="like.class">&hearts;</span>
        {{ likesCount }}
    </a>
</template>

<script>
export default {
    name: "LikeButton",
    props: {
        likeable: { type: Object, required: true },
        type: { type: String, required: true },
    },
    data() {
        return {
            user: user,
            isLiked: this.likeable.is_liked,
            likesCount: this.likeable.likes_count,
        }
    },
    computed: {
        like() {
            return this.isLiked ? { class: 'text-danger' } : { class: '' };
        },
    },
    methods: {
        toggleLike() {
            if (user) {
                let url = `/api/${this.type}/${this.likeable.id}/likes`;

                if (!this.isLiked) {
                    axios.post(url).then(() => {
                        this.isLiked = !this.isLiked;
                        this.likesCount++;
                    });
                } else {
                    axios.delete(url).then(() => {
                        this.isLiked = !this.isLiked;
                        this.likesCount--;
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
