<script>

    export default {

        props: [
        ],

        data() {
            return {
                form_data: {},
                errors_data: {}
            }
        },

        watch: {
        },

        computed: {
        },

        methods: {
            checkErrors(field_name) {
                return Object.keys(this.errors_data).length !== 0
                    && this.errors_data.hasOwnProperty(field_name);
            },
            haveErrors(field_name) {
                return {
                    'is-danger': this.checkErrors(field_name)
                }
            },
            errorMessage(field_name) {
                if (this.checkErrors(field_name)) {
                    return this.errors_data[field_name][0];
                } else {
                    return '';
                }
            },
            sendRequest() {}
        }
    }
</script>