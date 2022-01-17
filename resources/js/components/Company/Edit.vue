<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Company</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="formSubmit">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="company.name" required>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" v-model="company.email">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" class="form-control" v-on:change="onImageChange">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" class="form-control" v-model="company.website">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import $ from 'jquery';
export default {
    name:"update-company",
    data(){
        return {
            company:{
                name:"",
                email:"",
                logo:"",
                website:"",
                _method:"patch"
            }
        }
    },
    mounted(){
        this.showCompany()
    },

    methods:{
        onImageChange(e){
            console.log(e.target.files[0]);
            this.company.logo = e.target.files[0];
        },
        async showCompany(){
            await this.axios.get(`/api/company/${this.$route.params.id}`).then(response=>{
                const { name, email,logo,website } = response.data
                this.company.name = name
                this.company.email = email
                this.company.logo = logo
                this.company.website = website
            }).catch(error=>{
                console.log(error)
            })
        },
        async formSubmit(e) {
            e.preventDefault();
            let currentObj = this;

            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('logo', this.company.logo);
            formData.append('name', this.company.name);
            formData.append('email', this.company.email);
            formData.append('website', this.company.website);
            formData.append('_method', this.company._method);
            let self = this
            axios.post(`/api/company/${this.$route.params.id}`, formData, config)
                .then(function (response) {
                    let status = response.data.status
                    if (status) {
                        self.$router.push({name:"companyList"})

                    }
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
        },
    }
}
</script>
