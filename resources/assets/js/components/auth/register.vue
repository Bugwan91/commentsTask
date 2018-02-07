<template>

    <div class="modal" :class="activeClass">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Register</p>
                <button @click="close" class="delete" aria-label="close"></button>
            </header>

            <section class="modal-card-body">

                <div class="field">
                    <label for="name" class="label">Name</label>
                    <div class="control has-icons-left">
                        <input id="name" type="text" class="input" required autofocus
                               :class="haveErrors('name')"
                               v-model="form_data.name">
                        <span v-if="haveErrors('name')" class="help is-danger" :class="haveErrors('name')">
                            {{ errorMessage('name') }}
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label for="email" class="label">E-Mail Address</label>
                    <div class="control has-icons-left">
                        <input id="email" type="email" class="input" required autofocus
                               :class="haveErrors('email')"
                               v-model="form_data.email">
                        <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                        </span>
                        <span v-if="haveErrors('email')" class="help is-danger" :class="haveErrors('email')">
                            {{ errorMessage('email') }}
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label for="password" class="label">Password</label>
                    <div class="control">
                        <input id="password" type="password" class="input" required
                               :class="haveErrors('password')"
                               v-model="form_data.password">
                        <span v-if="haveErrors('password')" class="help is-danger" >
                            {{ errorMessage('password') }}
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label for="password_confirmation" class="label">Confirm password</label>
                    <div class="control">
                        <input id="password_confirmation" type="password" class="input" required
                               :class="haveErrors('password_confirmation')"
                               v-model="form_data.password_confirmation">
                        <span v-if="haveErrors('password_confirmation')" class="help is-danger" >
                            {{ errorMessage('password_confirmation') }}
                        </span>
                    </div>
                </div>

            </section>
            <footer class="modal-card-foot">
                <div class="field is-grouped">
                    <div class="control">
                        <button @click="sendRequest" class="button is-primary">
                            Register
                        </button>
                    </div>
                </div>
            </footer>

        </div>
    </div>

</template>

<script>

    import modable from '../contracts/modalable.vue'
    import formable from '../contracts/formable.vue'

    export default {

        mixins: [
            modable,
            formable
        ],

        props: [
        ],

        data() {
            return {
                form_data: {
                    'name': null,
                    'email': null,
                    'password': null,
                    'password_confirmation': null
                }
            }
        },

        created() {
        },

        components: {
        },

        computed: {
        },

        methods: {
            sendRequest() {
                axios.post('/register', this.form_data)
                    .then(response => {
                        this.close();
                        AuthEvent.$emit('logged-in', response.data.user);
                    })
                    .catch(error => {
                        this.errors_data = error.response.data.errors;
                    });
            }
        }
    }
</script>