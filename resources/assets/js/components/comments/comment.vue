<template>

    <div class="comment-wrapper" :class="{'comment-wrapper_first-level': isFirstLevel}">
        <article v-if="hasData" class="media comment">
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong>{{ comment.user.name }}</strong> <small>{{ comment.created_at }}</small>
                        <br>
                        <edit_form v-if="editingActive" :comment-id="comment.id" :comment-content="comment.content" @comment-edited="edited"></edit_form>
                        <span v-else="editingActive">{{ comment.content }}</span>
                    </p>
                </div>
                <nav class="level is-mobile">
                    <div class="level-left">
                        <votes v-if="!isAuthor" :votable-type="'Comment'" :votable-id="comment.id" :votableRating="comment.rating" :voted-value="comment.voted"></votes>
                        <a class="level-item padding_left_small" @click="replySwitch()">
                            <span class="icon is-small"><i class="fas fa-reply"></i></span> Reply
                        </a>
                        <a v-if="isAuthor" class="level-item padding_left_small" @click="editSwitch()">
                            <span class="icon is-small"><i class="fas fa-edit"></i></span> Edit
                        </a>
                    </div>
                </nav>
                <add_form :post-id="post_id" :comment-id="comment.id" :reply-active="reply_active" @comment-added="replyComment"></add_form>
            </div>
            <div class="media-right">
                <a v-if="canRemove" class="level-item">
                    <span @click="remove" class="icon is-small"><i class="fas fa-trash-alt"></i></span>
                </a>
            </div>
        </article>

        <comments v-if="hasReplies" :comments-data="comment.replies" :post-id="post_id"></comments>
    </div>


</template>
<script>

    import votes from './votes.vue';
    import add_form from './add_form.vue';
    import edit_form from './edit_form.vue';

    export default {

        props: [
            'commentData',
            'postId',
            'treeLevel'
        ],

        data() {
            return {
                comment: this.commentData,
                post_id: this.postId,
                reply_active: false,
                edit_active: false,
                user: user,
            }
        },

        beforeCreate: function () {
            this.$options.components.comments = require('./comments.vue');
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
            votes,
            add_form,
            edit_form
        },

        computed: {
            hasData() {
                return typeof this.comment.user !== 'undefined';
            },
            isAuthor() {
                return this.isAuth && (this.user.id == this.comment.user.id);
            },
            hasReplies() {
                return this.comment.replies.length > 0;
            },
            isAuth() {
                return typeof this.user !== 'undefined' && Object.keys(this.user).length !== 0;
            },
            isFirstLevel() {
                return typeof this.comment !== 'undefined' && this.comment.reply_to_id === null;
            },
            canRemove() {
                return this.isAuthor && !this.hasReplies
            },
            editingActive() {
                return this.isAuthor && this.edit_active;
            }

        },

        methods: {
            replySwitch() {
                this.reply_active = !this.reply_active;
            },
            replyComment(comment) {
                this.reply_active = false;
                this.comment.replies.unshift(comment);
            },
            remove() {
                axios.post('/comments/remove', {
                    comment_id: this.comment.id
                })
                    .then(response => {
                        this.$emit('remove-comment', this.comment)
                    })
                    .catch(error => {
                        console.log(error);
                        console.error(error.response.data.message);
                    });
            },
            editSwitch() {
                this.edit_active = !this.edit_active;
            },
            edited(new_content) {
                this.edit_active = false;
                this.comment.content = new_content;
            }
        }
    }
</script>