<script>

    export default {

        props: [
            'modalActive'
        ],

        data() {
            return {
                is_active: this.modalActive
            }
        },

        watch: {
            modalActive: function(new_status) {
                this.is_active = new_status;
            }
        },

        computed: {
            activeClass: function() {
                return {
                    'is-active': this.is_active
                };
            }
        },

        methods: {
            open() {
                this.is_active = true;
                this.$emit('modal-open');
            },
            close() {
                this.is_active = false;
                this.$emit('modal-close');
            }
        }
    }
</script>