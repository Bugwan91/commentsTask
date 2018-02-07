<template>

    <div>
        <add_form :post-id="post_id" :reply-active="true" @comment-added="addComment"></add_form>
        <comments :post-id="post_id" :comments-data="comments"></comments>
    </div>


</template>
<script>

    import add_form from './add_form.vue';
    import comments from './comments.vue';

    export default {

        props: [
            'postId',
        ],

        data() {
            return {
                comments: [],
                post_id: this.postId,
            }
        },

        created() {
            this.fetchComments();
        },

        components: {
            add_form,
            comments
        },

        computed: {
        },

        methods: {
            fetchComments() {
                axios.post('/post/' + this.post_id + '/comments', {
                })
                    .then(response => {
                        this.comments = response.data.comments;
                    })
                    .catch(error => {
                        console.log(error);
                        console.error(error.response.data.message);
                    });
            },
            addComment(comment) {
                this.comments.unshift(comment)
            },
        }
    }
</script>