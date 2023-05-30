<template>

    <!-- Content area -->
    <div class="content d-flex justify-content-center align-items-center">

        <!-- Login form -->
        <form class="login-form" @submit.prevent="submit">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                            <img src="/global_assets/images/demo/logos/3.svg" class="h-48px" alt="">
                        </div>
                        <h5 class="mb-0">Login to your account</h5>
                        <span class="d-block text-muted">Enter your credentials below</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="text" v-model="fields.email" class="form-control" placeholder="example@email.com">
                            <span v-if="errors.email">{{ errors.email[0] }}</span>
                            <div class="form-control-feedback-icon">
                                <i class="ph-user-circle text-muted"></i>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="password" v-model="fields.password" class="form-control" placeholder="•••••••••••">
                            <span v-if="errors.password">{{ errors.password[0] }}</span>
                            <div class="form-control-feedback-icon">
                                <i class="ph-lock text-muted"></i>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Sign in</button>
                    </div>

                    <div class="text-center">
                        <a href="">Forgot password?</a>
                    </div>
                </div>
            </div>
        </form>
        <!-- /login form -->

    </div>
    <!-- /content area -->

</template>

<script>
    export default{
        data() {
            return {
                fields : {},
                errors : {},
            };
        },
        mounted(){

        },
        methods :{
            submit(){
                axios
                .post("/api/login", this.fields)
                .then((response)=>{
                    console.log(response)
                    this.$router.push({name : 'Login'});
                    localStorage.setItem('authenticated','true');
                    location.reload();
                })
                .catch((error)=>{
                    this.errors = error.response.data.errors;
                });
            },
        },
    }
</script>
