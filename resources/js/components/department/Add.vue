<template>
    <div class="card-header">
        <h5 class="mb-0">Create Department</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="d-grid gap-2 d-md-block">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#departmentModal">Add New Department</button>
            </div>

            <div class="modal fade" id="departmentModal" tabindex="-1" aria-labelledby="departmentModalLabel" aria-hidden="true" ref="myModalRef">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form @submit.prevent="submit">
                            <div class="modal-header">
                                <h5 class="modal-title" id="departmentModalLabel">Create Department</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-1">
                                    <label for="department" class="col-form-label">Department Name:</label>
                                    <input type="text" v-model="fields.department" class="form-control" id="department" placeholder="Department Name">
                                </div>
                                <div class="mb-1">
                                    <label for="status" class="col-form-label">Status:</label>
                                    <select v-model="fields.status" class="form-control status" id="status">
                                        <option disabled value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">InActive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="clearInput()" id="close" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">{{ ButtonText }}<i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
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
                                        <th>Department Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(department, index) in departments" :key="department.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ department.name }}</td>
                                        <td>{{ department.status == 1 ? 'Active' : 'In-Active' }}</td>
                                        <td>
                                            <button @click="editDepartment(department.id)" class="btn btn-sm btn-info mx-1" data-bs-toggle="modal" data-bs-target="#departmentModal">Edit</button>
                                            <button @click="deleteDepartment(department.id)" class="btn btn-sm btn-danger">Delete</button>
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
    import DepartmentList from '../department/Show.vue'
    export default{
        data() {
            return {
                fields : {
                    status : '',
                },
                errors : {},
                'departments' : [],
                'ButtonText' : 'Insert',
                'submitStatus' : '0',
                'department_id' : '',
            };
        },
        created() {
            this.getDepartment();
        },
        mounted(){

        },
        methods :{

            submit(){
                if(this.submitStatus==0){
                    axios
                    .post("/api/department/create", this.fields)
                    .then((response)=>{
                        this.fields = {};
                        this.errors = {};
                        // $('#departmentModal').modal('hide');
                        document.getElementById('close').click();
                        this.getDepartment();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }else{
                    axios
                    .post("/api/department/update/"+this.department_id, this.fields)
                    .then((response)=>{
                        // $('#departmentModal').modal('hide');
                        document.getElementById('close').click();
                        this.fields = {};
                        this.fields.status = ''
                        this.errors = {};
                        this.ButtonText = 'Insert'
                        this.submitStatus = 0;
                        this.getDepartment();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
            getDepartment(){
                axios
                .get("/api/department")
                .then((response)=>{
                    this.departments = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            editDepartment(id){
                axios
                .get("/api/department/edit/"+id)
                .then((response)=>{
                    this.fields.department = response.data.name
                    this.fields.status = response.data.status
                    this.ButtonText = 'Update'
                    this.submitStatus = 1;
                    this.department_id = response.data.id
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            deleteDepartment(id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/department/delete/"+id)
                    .then((response)=>{
                        this.getDepartment();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
            clearInput(){
                this.fields = {}
                this.fields.status = ''
            },
        },
        components : {
            DepartmentList,
        }
    }
</script>
