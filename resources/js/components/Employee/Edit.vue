<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Company</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" v-model="employee.f_name" required>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" v-model="employee.l_name" required>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Company</label>
                                    <select class='form-control' v-model='employee.company_id' >
                                        <option value='0' >Select company</option>
                                        <option v-for='data in employee.companies' :value='data.id'>{{ data.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" v-model="employee.email">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" class="form-control" v-model="employee.phone">
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
export default {
    name:"update-employee",
    data(){
        return {
            employee:{
                f_name:"",
                l_name:"",
                company_id:0,
                email:"",
                phone:"",
                _method:"patch",
                companies:[]
            }
        }
    },
    mounted(){
        this.showEmployee()
    },
    methods:{
        getCountries: function(){
            axios.get('/api/getCompanies')
                .then(function (response) {
                    this.employee.companies = response.data;
                }.bind(this));

        },
        async showEmployee(){
            await this.axios.get(`/api/employee/${this.$route.params.id}`).then(response=>{
                const { f_name, l_name,company_id, email,phone } = response.data
                this.employee.f_name = f_name
                this.employee.l_name = l_name
                this.employee.email = email
                this.employee.company_id = company_id
                this.employee.phone = phone
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            let self = this
            await this.axios.post(`/api/employee/${this.$route.params.id}`,this.employee).then(response=>{
                let status = response.data.status
                if (status) {
                    self.$router.push({name:"employeeList"})
                }
            }).catch(error=>{
                console.log(error)
            })
        }
    },
    created: function(){
        this.getCountries()
    }
}
</script>
