<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="formSubmit">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" v-model="user.email" required>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" v-model="user.password" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"login",
    mounted() {
        console.log('Component mounted.')
    },
    data(){
        return {
            user:{
                email:"",
                password:"",
            }
        }
    },
    methods:{
        async formSubmit(e) {
            let self = this;
            axios.post('/api/login', this.user)
                .then(function (response) {
                   let email = response.data.email
                    if (email) {
                        self.$router.push({path: '/home'});
                    }
                })
                .catch(function (error) {
                  console.log(error)
                });
        },
    }
}
</script>
