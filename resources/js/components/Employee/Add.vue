<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Employee</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="formSubmit">
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
    name:"add-employee",
    mounted() {
        console.log('Component mounted.')
    },
    data(){
        return {
            employee:{
                f_name:"",
                l_name:"",
                company_id:0,
                email:"",
                phone:"",
                companies: [],
            }
        }
    },
    methods:{
        getCountries: function(){
            axios.get('/api/getCompanies')
                .then(function (response) {
                    this.employee.companies = response.data;
                }.bind(this));

        },
        async formSubmit(e) {
            let self = this
            axios.post('/api/employee', this.employee)
                .then(function (response) {
                    let status = response.data.status
                    if (status) {
                        self.$router.push({name:"employeeList"})
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
    },
    created: function(){
        this.getCountries()
    }
}
</script>
