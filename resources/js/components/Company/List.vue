<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"companyAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Company</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Logo</th>
                                <th>Website</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody v-if="companies.length > 0">
                            <tr v-for="(company,key) in companies" :key="key">
                                <td>{{ company.id }}</td>
                                <td>{{ company.name }}</td>
                                <td>{{ company.email }}</td>
                                <td><img style="width: 300px; height: 300px" v-bind:src="company.logo"></td>
                                <td>{{ company.website }}</td>
                                <td>
                                    <router-link :to='{name:"companyEdit",params:{id:company.id}}' class="btn btn-success">Edit</router-link>
                                    <router-link :to='{name:"companyShow",params:{id:company.id}}' class="btn btn-success">Show</router-link>
                                    <button type="button" @click="deleteCategory(company.id)" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="6" align="center">No Company Found.</td>
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
    name:"companies",
    data(){
        return {
            companies:[],
        }
    },
    mounted(){
        this.getCompanies()
    },
    methods:{
        async getCompanies(){
            await this.axios.get('/api/company').then(response=>{
                this.companies = response.data
            }).catch(error=>{
                console.log(error)
                this.companies = []
            })
            $('#datatable').DataTable();
        },
        deleteCategory(id){
            if(confirm("Are you sure to delete this company ?")){
                this.axios.delete(`/api/company/${id}`).then(response=>{
                    this.getCompanies()
                }).catch(error=>{
                    this.$router.push({name:"/"})
                })
            }
        }
    }
}
</script>
