<template>
    <div class="card-header">
        <h5 class="mb-0">Create Company</h5>
    </div>
    <div class="card-body">
        <div class="row">

            <div class="col-md-6 pt-4">

                <!-- Vertical form -->
                <div class="card">

                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="form-group">
                                <label>Comapany Name</label>
                                <input v-model="field.company_name" type="text" class="form-control company_name">
                                <input v-model="company_id" type="hidden">
                            </div>

                            <div class="form-group">
                                <label>Display Name</label>
                                <input v-model="field.display_name" type="text" class="form-control display_name">
                            </div>

                            <div class="form-group">
                                <label>Company Status</label>
                                <select v-model="field.status" class="form-control status">
                                    <option disabled value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>
                            </div>
                            <span v-if="errors.company_name">{{ errors.company_name }}</span>
                            <div class="text-right pt-1">
                                <input type="hidden" v-model="submitStatus">
                                <button type="submit" class="btn btn-primary">{{ ButtonText }}<i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /vertical form -->

            </div>

        </div>

        <div class="row">
            <div class="col-md-12 pt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Company Name</th>
                                        <th>Display Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(company, index) in companies" :key="company.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ company.name }}</td>
                                        <td>{{ company.display_name }}</td>
                                        <td>{{ company.status == 1 ? 'Active' : 'In-Active' }}</td>
                                        <td>
                                            <button @click="editCompany(company.id)" class="btn btn-sm btn-info mx-1">Edit</button>
                                            <button @click="deleteCompany(company.id)" class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CompanyList from '../company/Show.vue'
    export default{
        data() {
            return {
                field : {
                    status : '',
                },
                errors : {},
                'companies' : [],
                'ButtonText' : 'Insert',
                'submitStatus' : '0',
                'company_id' : '',
            };
        },
        created() {
            this.getCompany();
        },
        methods :{
            submit(){
                if(this.submitStatus==0){
                    axios
                    .post("/api/company/create", this.field)
                    .then((response)=>{
                        this.field = {};
                        this.errors = {};
                        this.getCompany();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }else{
                    axios
                    .post("/api/company/update/"+this.company_id, this.field)
                    .then((response)=>{
                        this.field = {};
                        this.errors = {};
                        this.ButtonText = 'Insert'
                        this.submitStatus = 0;
                        this.getCompany();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
            getCompany(){
                axios
                .get("/api/company")
                .then((response)=>{
                    this.companies = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            editCompany(id){
                axios
                .post("/api/company/edit/"+id)
                .then((response)=>{
                    this.field.company_name = response.data.name
                    this.field.display_name = response.data.display_name
                    this.field.status = response.data.status
                    this.ButtonText = 'Update'
                    this.submitStatus = 1;
                    this.company_id = response.data.id
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            deleteCompany(id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/company/delete/"+id)
                    .then((response)=>{
                        this.getCompany();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
        },
        components : {
            CompanyList,
        }
    }
</script>
