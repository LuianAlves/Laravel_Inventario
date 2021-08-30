<template>
    <div class="">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            Login
                                        </h1>
                                    </div>
                                    <form class="user" @submit.prevent="login">
                                        <div class="form-group">
                                            <input
                                                type="email"
                                                class="form-control"
                                                placeholder="Enter Email Address"
                                                autocomplete="username"
                                                v-model="form.email"
                                            />
                                        </div>
                                        <div class="form-group">
                                            <input
                                                type="password"
                                                class="form-control"
                                                placeholder="Password"
                                                autocomplete="current-password"
                                                v-model="form.password"
                                            />
                                        </div>
                                        <div class="form-group">
                                            <button
                                                class="btn btn-primary btn-block"
                                                type="submit"
                                            >
                                                Login
                                            </button>
                                        </div>
                                    </form>
                                    <hr />
                                    <div class="text-center">
                                        <router-link
                                            to="/register"
                                            class="font-weight-bold small"
                                            >Create an Account!?</router-link
                                        >
                                    </div>
                                    <div class="text-center">
                                        <router-link
                                            to="/forget"
                                            class="font-weight-bold small"
                                            >Forget Password?</router-link
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        if (User.loggedIn()) {
            this.$router.push({ name: "home" });
        }
    },

    data() {
        return {
            form: {
                email: null,
                password: null
            },

            errors: {}
        };
    },

    methods: {
        login() {
            let url = "/api/auth/login";
            axios
                .post(url, this.form)

                .then(response => {
                    User.responseAfterLogin(response);

                    // Alert Logged
                    Toast.fire({
                        icon: "success",
                        title: "Signed in successfully"
                    });

                    this.$router.push({ name: "home" }); // redirecionar rota
                })

                .catch(error => {
                    this.errors = error.response.data.errors;

                    // Alert Logged
                    Toast.fire({
                        icon: "error",
                        title: "Invalid Email or Password!"
                    });
                });
        }
    }
};
</script>
