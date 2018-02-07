<template>

    <div>
        <a class="icon" :class="{'has-text-success': !canVoteUp}" @click="voteUp">
            <i class="fas fa-chevron-up"></i>
        </a>
        <span>{{ rating }}</span>
        <a class="icon" :class="{'has-text-danger': !canVoteDown}" @click="voteDown">
            <i class="fas fa-chevron-down"></i>
        </a>
    </div>


</template>
<script>

    export default {

        props: [
            'votableType',
            'votableId',
            'votableRating',
            'votedValue'
        ],

        data() {
            return {
                is_loading: 0,
                rating: this.votableRating,
                user: user,
                voted: this.votedValue
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
        },

        computed: {
            canVoteUp() {
                return this.voted < 1;
            },
            canVoteDown() {
                return this.voted > -1;
            }
        },

        methods: {
            voteUp() {
                if (this.canVoteUp) {
                    this.vote(1);
                }
            },
            voteDown() {
                if (this.canVoteDown) {
                    this.vote(-1);
                }
            },
            vote(value) {
                axios.post('/comments/vote', {
                    votable_type: this.votableType,
                    votable_id: this.votableId,
                    vote_value: value
                })
                    .then(response => {
                        this.rating+=value;
                        this.voted = this.voted + value;
                    })
                    .catch(error => {
                        console.log(error);
                        console.error(error.response.data.message);
                    });
            }
        }
    }
</script>