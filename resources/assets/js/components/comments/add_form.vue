<template>

    <article v-if="active" class="media content">
        <div v-if="isAuth" class="media-content">
            <div class="field">
                <p class="control">
                    <textarea v-model="text" class="textarea" placeholder="Add a comment..."></textarea>
                </p>
            </div>
            <nav class="level">
                <div class="level-left">
                    <div class="level-item">
                        <a @click="addComment" class="button is-info">Send</a>
                    </div>
                </div>
            </nav>
        </div>
        <div v-else="isAuth" class="media-content">
            <auth></auth>
        </div>
    </article>

</template>
<script>

    import auth from '../auth/auth-needle.vue';

    export default {

        props: [
            'postId',
            'commentId',
            'replyActive',
        ],

        data() {
            return {
                active: this.replyActive,
                user: user,
                text: ''
            }
        },

        watch: {
            replyActive: function(new_value) {
                this.active = new_value;
            }
        },

        created() {
            AuthEvent.$on('logged-in', (user) => {
                this.user = user;
            });
            AuthEvent.$on('log-out', () => {
                this.user = {};
            });
        },

        components: {
            auth
        },

        computed: {
            isAuth() {
                return typeof this.user !== 'undefined' && Object.keys(this.user).length !== 0;
            },
        },

        methods: {
            addComment() {
                axios.post('/comments/add', {
                    post_id: this.postId,
                    comment_id: this.commentId,
                    text: this.text
                })
                    .then(response => {
                        this.text = '';
                        this.$emit('comment-added', response.data.comment);
                    })
                    .catch(error => {
                        console.log(error);
                        console.error(error.response.data.message);
                    });
            }
        }
    }
</script>