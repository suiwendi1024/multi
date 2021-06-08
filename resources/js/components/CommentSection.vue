<template>
    <section>
        <h4>{{ total }}评论</h4>
        <ul class="list-group list-group-flush border-top">
            <!-- 发表评论 -->
            <li class="list-group-item bg-transparent">
                <form action="" @submit.prevent="handleSubmit">
                    <fieldset :disabled="!user">
                        <div class="form-group">
                            <textarea
                                name="body"
                                class="form-control"
                                cols="30"
                                rows="3"
                                :placeholder="user ? '不超过2000字' : '请登录'"
                                required
                                maxlength="2000"
                                v-model="createForm.body"
                            ></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">发表</button>
                    </fieldset>
                </form>
            </li>
            <!-- 评论 -->
            <li
                v-for="(comment, index) in localComments"
                :key="comment.id"
                class="list-group-item bg-transparent"
            >
                <div class="media">
                    <div class="media-body">
                        <h5 class="card-title">{{ comment.user.name }}</h5>
                        <div class="card-subtitle text-muted">
                            <h6>{{ new Date(comment.created_at).toLocaleString() }}</h6>
                            {{ comment.body }}
                        </div>
                        <div class="d-flex justify-content-between">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <like-button :likeable="comment" type="comments"/>
                                </li>
                            </ul>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="">举报</a>
                                    <button v-if="user && user.id == comment.user.id" type="submit" class="dropdown-item" @click="handleDelete(comment.id, index)">删除</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="list-group-item bg-transparent text-center text-muted">
                我是有底线的……
            </li>
        </ul>
    </section>
</template>

<script>
export default {
    name: "CommentSection",

    props: {
        total: Number,
        comments: Object,
    },

    data() {
        return {
            localComments: this.comments.data,
            nextPageUrl: this.comments.next_page_url,
            createForm: { body: '' },
            user: user,
            url: `/api${location.pathname}/comments`,
        };
    },

    mounted() {
        this.onScroll();
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

                    this.localComments.push(...response.data.data);
                    this.onScroll();
                });
            }
        },

        handleSubmit() {
            if (this.createForm.body.length > 0) {
                axios.post(this.url, this.createForm).then(response => {
                    this.createForm.body = '';

                    this.localComments.unshift(Object.assign({ user: this.user }, response.data.data()));
                });
            }
        },

        handleDelete(id, index) {
            if (confirm('您坚持要删除吗？')) {
                axios.delete(`/api/comments/${ id }`).then(() => {
                    this.localComments.splice(index, 1);
                });
            }
        }
    }
}
</script>

<style scoped>
    .profile-picture {
        width: 80px;
    }
</style>
