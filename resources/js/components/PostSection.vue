<template>
    <ul class="list-group list-group-flush">
        <li
            v-for="post in localPosts"
            :key="post.id"
            class="list-group-item bg-transparent"
        >
            <div class="d-flex">
                <div class="w-75 d-flex flex-column">
                    <!-- 标题 -->
                    <h4 class="font-weight-bold">
                        <a :href="post.path" target="_blank" v-html="highlight(post.title)"></a>
                    </h4>
                    <!-- 摘要 -->
                    <p class="text-muted flex-grow-1" v-html="highlight(post.summary)"></p>
                    <!-- 属性栏 -->
                    <div class="media small">
                        <!-- 作者头像 -->
                        <img class="mr-3 img-fluid rounded-circle profile-picture" :src="post.user.profile_picture_url"
                             alt="">
                        <div class="media-body align-self-center d-flex justify-content-between">
                            <ul class="list-inline text-muted">
                                <li class="list-inline-item">{{ post.user.name }}</li>
                                <li class="list-inline-item">{{ post.category.name }}</li>
                                <li class="list-inline-item">{{ post.views }}浏览</li>
                                <li class="list-inline-item">{{ post.likes_count }}点赞</li>
                                <li class="list-inline-item">{{ post.favorites_count }}收藏</li>
                                <li class="list-inline-item">{{ post.comments_count }}评论</li>
                            </ul>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                   data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false"></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" target="_blank">举报</a>
                                    <template v-if="isAuthorized(post)">
                                        <!-- 跳转编辑页面 -->
                                        <a class="dropdown-item" :href="post.path + '/edit'" target="_blank">编辑</a>
                                        <!-- 删除帖子按钮 -->
                                        <button class="dropdown-item" @click="handleDelete(post)">删除</button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 封面 -->
                <div class="w-25 ml-3 rounded post-cover" :style="'background-image: url(' + post.cover_url + ')'"></div>
            </div>
        </li>
        <li class="list-group-item bg-transparent text-center text-muted">
            我是有底线的……
        </li>
    </ul>
</template>

<script>
export default {
    name: "PostSection",

    props: {
        posts: Object,
    },

    data() {
        return {
            localPosts: this.posts.data,
            nextPageUrl: this.posts.next_page_url,
        }
    },

    computed: {
        search() {
            return new URLSearchParams(location.search).get('search')
        },
    },

    mounted() {
        this.onScroll()
    },

    methods: {
        onScroll() {
            let scroll = () => {
                if (document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight < 200) {
                    window.removeEventListener('scroll', scroll, true)
                    this.fetchData()
                }
            }

            window.addEventListener('scroll', scroll, true)
        },

        fetchData() {
            if (this.nextPageUrl) {
                axios.get(this.nextPageUrl).then(response => {
                    this.nextPageUrl = response.data.links.next

                    this.localPosts.push(...response.data.data)
                    this.onScroll()
                })
            }
        },

        highlight(text) {
            if (this.search) {
                return text.replace(this.search, `<span class="bg-warning">${ this.search }</span>`)
            }
            return text
        },

        handleDelete(post) {
            if (confirm('您坚持要删除该帖子吗？')) {
                axios.delete(post.path).then(() => {
                    //
                }).catch(error => {
                    console.log(error)
                })
            }
        },

        isAuthorized(post) {
            return user ? post.user.id == user.id : false
        },
    },
}
</script>

<style scoped>
.post-cover {
    height: 8rem;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.profile-picture {
    width: 30px;
}
</style>
