<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Show employee</h4>
                </div>
                <div class="card-body">
                    <form>
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
                                    <input type="text" class="form-control" v-model="employee.company_id" required>
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
                                <router-link :to='{name:"employeeList"}' class="btn btn-success">Back</router-link>
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
                company_id:"",
                email:"",
                phone:"",
                _method:"patch"
            }
        }
    },
    mounted(){
        this.showEmployee()
    },
    methods:{
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
    }
}
</script>
