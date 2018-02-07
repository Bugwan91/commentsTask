<template>

    <div>
        <div class="field is-grouped">
            <p class="control">
                <strong>You should be logged in for this action</strong>
            </p>
            <p class="control">
                <a @click="loginOpen" class="button is-primary">
                    Login
                </a>
            </p>
            <p class="control">
                <a @click="registerOpen" class="button is-light">
                    Register
                </a>
            </p>
        </div>
        <login :modal-active="login_active" @modal-close="loginClose"></login>
        <register :modal-active="register_active" @modal-close="registerClose"></register>
    </div>

</template>

<script>

    import login from './login.vue';
    import register from './register.vue';

    export default {

        props: [
        ],

        data() {
            return {
                login_active: false,
                register_active: false,
            }
        },

        created() {
        },

        components: {
            login,
            register
        },

        computed: {
        },

        methods: {
            loginOpen() {
                this.login_active = true;
            },
            loginClose() {
                this.login_active = false;
            },
            registerOpen() {
                this.register_active = true;
            },
            registerClose() {
                this.register_active = false;
            }
        }
    }
</script>