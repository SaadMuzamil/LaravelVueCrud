<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Show Company</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="company.name" disabled>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" v-model="company.email" disabled>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="text" class="form-control" v-model="company.logo" disabled>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" class="form-control" v-model="company.website" disabled>
                                </div>
                            </div>
                            <div class="col-12">
                                <router-link :to='{name:"companyList"}' class="btn btn-success">Back</router-link>
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
        }
    }
}
</script>
