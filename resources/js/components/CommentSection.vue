<template>
    <section>
        <h4>{{ meta.total }}评论</h4>
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
                v-for="(comment, index) in comments"
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
        </ul>
    </section>
</template>

<script>
export default {
    name: "CommentSection",
    data() {
        return {
            comments: [],
            meta: {},
            createForm: { body: '' },
            user: user,
            url: `/api${location.pathname}/comments`,
        };
    },
    mounted() {
        this.fetchComments();
    },
    methods: {
        fetchComments() {
            if (this.meta.last_page > this.meta.current_page || !this.meta.hasOwnProperty('last_page')) {
                axios.get(this.url, { params: { page: (this.meta.current_page || 0) + 1 } }).then(({ data: { data, meta } }) => {
                    this.comments.push(...data);
                    this.meta = meta;
                    this.checkScroll();
                });
            }
        },
        checkScroll() {
            window.addEventListener('scroll', this.handleScroll, true);
        },
        handleScroll() {
            if ($(document).height() - $(window).scrollTop() - $(window).height() < 200) {
                window.removeEventListener('scroll', this.handleScroll, true);
                this.fetchComments();
            }
        },
        handleSubmit() {
            if (this.createForm.body.length > 0) {
                axios.post(this.url, this.createForm).then(({ data: { data } }) => {
                    this.createForm.body = '';
                    data.user = this.user
                    this.comments.unshift(data);
                });
            }
        },
        handleDelete(id, index) {
            if (confirm('您坚持要删除吗？')) {
                axios.delete(`/api/comments/${ id }`).then(() => {
                    this.comments.splice(index, 1);
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
