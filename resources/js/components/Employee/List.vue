<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"employeeAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Employee</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable2" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody v-if="employees.length > 0">
                            <tr v-for="(employee,key) in employees" :key="key">
                                <td>{{ employee.id }}</td>
                                <td>{{ employee.f_name }}</td>
                                <td>{{ employee.l_name }}</td>
                                <td>{{ employee.email }}</td>
                                <td>{{ employee.companies.name }}</td>
                                <td>{{ employee.phone }}</td>
                                <td>
                                    <router-link :to='{name:"employeeEdit",params:{id:employee.id}}' class="btn btn-success">Edit</router-link>
                                    <router-link :to='{name:"employeeShow",params:{id:employee.id}}' class="btn btn-success">Show</router-link>
                                    <button type="button" @click="deleteCategory(employee.id)" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="6" align="center">No Employee Found.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import 'jquery/dist/jquery.min.js';
import 'bootstrap/dist/css/bootstrap.min.css';
import "datatables.net-dt/js/dataTables.dataTables"
import "datatables.net-dt/css/jquery.dataTables.min.css"
import $ from 'jquery';

export default {
    name:"Employees",
    data(){
        return {
            employees:[],
        }
    },
    mounted(){
        this.getEmployees()
    },
    methods:{

        async getEmployees(){
            await this.axios.get('/api/employee').then(response=>{
                this.employees = response.data
            }).catch(error=>{
                console.log(error)
                this.employees = []
            })
            $('#datatable2').DataTable();
        },
        deleteCategory(id){
            if(confirm("Are you sure to delete this employee ?")){
                this.axios.delete(`/api/employee/${id}`).then(response=>{
                    this.getEmployees()
                }).catch(error=>{
                    this.$router.push({name:"/"})
                })
            }
        }
    }
}
</script>
