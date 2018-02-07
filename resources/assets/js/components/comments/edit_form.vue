<template>

    <article class="media content">
        <div class="media-content">
            <div class="field">
                <p class="control">
                    <textarea v-model="text" class="textarea" placeholder="Edit the comment..."></textarea>
                </p>
            </div>
            <nav class="level">
                <div class="level-left">
                    <div class="level-item">
                        <a @click="editComment" class="button is-info">Save</a>
                    </div>
                </div>
            </nav>
        </div>
    </article>

</template>
<script>

    export default {

        props: [
            'commentId',
            'commentContent'
        ],

        data() {
            return {
                text: this.commentContent
            }
        },

        watch: {
        },

        created() {
        },

        components: {
        },

        computed: {
        },

        methods: {
            editComment() {
                axios.post('/comments/edit', {
                    comment_id: this.commentId,
                    text: this.text
                })
                    .then(response => {
                        this.$emit('comment-edited', this.text);
                    })
                    .catch(error => {
                        console.log(error);
                        console.error(error.response.data.message);
                    });
            }
        }
    }
</script>