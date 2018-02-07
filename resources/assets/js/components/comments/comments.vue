<template>

    <div>
        <comment v-for="comment in comments" :key="comment.id" :comment-data="comment" :post-id="post_id" @remove-comment="removeComment"></comment>
    </div>


</template>
<script>

    import add_form from './add_form.vue';
    import comment from './comment.vue';

    export default {

        props: [
            'postId',
            'commentsData'
        ],

        data() {
            return {
                comments: this.commentsData,
                post_id: this.postId,
            }
        },

        watch: {
            commentsData: function(new_comments) {
                this.comments = new_comments;
            }
        },

        created() {
        },

        components: {
            add_form,
            comment
        },

        computed: {
        },

        methods: {
            addComment(comment) {
                this.comments.unshift(comment)
            },
            removeComment(comment) {
                this.comments.splice(this.comments.indexOf(comment), 1);
            }
        }
    }
</script>