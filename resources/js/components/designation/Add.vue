<template>
    <div class="card-header">
        <h5 class="mb-0">Create Designation</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="d-grid gap-2 d-md-block">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#designationModal">Add New Designation</button>
            </div>

            <div class="modal fade" id="designationModal" tabindex="-1" aria-labelledby="designationModalLabel" aria-hidden="true" ref="myModalRef">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form @submit.prevent="submit">
                            <div class="modal-header">
                                <h5 class="modal-title" id="designationModalLabel">Create Designation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-1">
                                    <label for="designation" class="col-form-label">Designation Name:</label>
                                    <input type="text" v-model="fields.designation" class="form-control" id="designation" placeholder="Designation Name">
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                        <th>designation Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(designation, index) in designations" :key="designation.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ designation.name }}</td>
                                        <td>{{ designation.status == 1 ? 'Active' : 'In-Active' }}</td>
                                        <td>
                                            <button @click="editDesignation(designation.id)" class="btn btn-sm btn-info mx-1" data-bs-toggle="modal" data-bs-target="#designationModal">Edit</button>
                                            <button @click="deleteDesignation(designation.id)" class="btn btn-sm btn-danger">Delete</button>
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
    import DesignationList from '../designation/Show.vue'
    export default{
        data() {
            return {
                fields : {
                    status : '',
                },
                errors : {},
                'designations' : [],
                'ButtonText' : 'Insert',
                'submitStatus' : '0',
                'designation_id' : '',
            };
        },
        created() {
            this.getDesignation();
        },
        mounted(){

        },
        methods :{
            submit(){
                if(this.submitStatus==0){
                    axios
                    .post("/api/designation/create", this.fields)
                    .then((response)=>{
                        this.fields = {};
                        this.errors = {};
                        $('#designationModal').modal('hide');
                        toastr.success('Successfully Created.');
                        this.getDesignation();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }else{
                    axios
                    .post("/api/designation/update/"+this.designation_id, this.fields)
                    .then((response)=>{
                        $('#designationModal').modal('hide');
                        this.fields = {};
                        this.errors = {};
                        this.ButtonText = 'Insert'
                        this.submitStatus = 0;
                        toastr.success('Successfully Updated.');
                        this.getDesignation();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
            getDesignation(){
                axios
                .get("/api/designation")
                .then((response)=>{
                    this.designations = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            editDesignation(id){
                axios
                .get("/api/designation/edit/"+id)
                .then((response)=>{
                    this.fields.designation = response.data.name
                    this.fields.status = response.data.status
                    this.ButtonText = 'Update'
                    this.submitStatus = 1;
                    this.designation_id = response.data.id
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            deleteDesignation(id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/designation/delete/"+id)
                    .then((response)=>{
                        toastr.error('Successfully Deleted.');
                        this.getDesignation();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
        },
        components : {
            DesignationList,
        }
    }
</script>
