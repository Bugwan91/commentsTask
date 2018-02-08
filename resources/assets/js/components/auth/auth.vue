<template>

    <div>
        <div v-if="isAuth" class="navbar-item has-dropdown is-hoverable">
            <a @click="logout" class="navbar-item">
                <strong>
                    {{ user.name }}
                </strong>
                <span class="padding_left_small">Logout</span>
            </a>
        </div>
        <div v-else="isAuth" class="navbar-menu">
            <a @click="loginOpen" class="navbar-item">
                Log in
            </a>
            <a @click="registerOpen" class="navbar-item">
                Register
            </a>
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
            'userData'
        ],

        data() {
            return {
                login_active: false,
                register_active: false,
                user: this.userData
            }
        },

        created() {
            AuthEvent.$on('logged-in', (user) => {
                this.user = user;
            })
        },

        components: {
            login,
            register
        },

        computed: {
            isAuth() {
                return typeof this.user !== 'undefined'
                        && this.user !== null
                        && Object.keys(this.user).length !== 0;
            },
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
            },
            logout() {
                axios.post('/logout')
                    .then(response => {
                        this.user = {};
                        AuthEvent.$emit('log-out');
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>