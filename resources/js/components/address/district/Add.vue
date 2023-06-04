<template>
    <div class="card-header">
        <h5 class="mb-0">Create District</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="d-grid gap-2 d-md-block">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#districtModal">Add New District</button>
            </div>

            <div class="modal fade" id="districtModal" tabindex="-1" aria-labelledby="districtModalLabel" aria-hidden="true" ref="myModalRef">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form @submit.prevent="submit">
                            <div class="modal-header">
                                <h5 class="modal-title" id="districtModalLabel">Create District</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-1">
                                    <label for="district" class="col-form-label">District Name:</label>
                                    <input type="text" v-model="fields.district" class="form-control" id="district" placeholder="District Name">
                                </div>
                                <div class="mb-1">
                                    <label for="division_id" class="col-form-label">Division:</label>
                                    <select v-model="fields.division_id" class="form-control division_id" id="division_id">
                                        <option disabled value="">Select Division</option>
                                        <option v-for="division in divisions" v-bind:value="division.id">{{ division.name }}</option>
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
                                        <th>District Name</th>
                                        <th>Division Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(district, index) in districts" :key="district.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ district.district_name }}</td>
                                        <td>{{ district.division_name }}</td>
                                        <td>
                                            <button @click="editDistrict(district.id)" class="btn btn-sm btn-info mx-1" data-bs-toggle="modal" data-bs-target="#districtModal">Edit</button>
                                            <button @click="deleteDistrict(district.id)" class="btn btn-sm btn-danger">Delete</button>
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

    export default{
        data() {
            return {
                fields : {
                    division_id: '',
                },
                errors : {},
                'districts' : [],
                'divisions' : [],
                'ButtonText' : 'Insert',
                'submitStatus' : '0',
                'district_id' : '',
            };
        },
        created() {
            this.getDistrict();
            this.getDivisionId();
        },
        mounted(){

        },
        methods :{

            submit(){
                if(this.submitStatus==0){
                    axios
                    .post("/api/district/create", this.fields)
                    .then((response)=>{
                        this.fields = {};
                        this.errors = {};
                        // $('#districtModal').modal('hide');
                        document.getElementById('close').click();
                        toastr.success('Successfully Created.');
                        this.getDistrict();
                    })
                    .catch((error)=>{
                        toastr.error('Something went wrong.');
                        // console.log(error);
                    });
                }else{
                    axios
                    .post("/api/district/update/"+this.district_id, this.fields)
                    .then((response)=>{
                        // $('#districtModal').modal('hide');
                        document.getElementById('close').click();
                        this.fields = {};
                        this.fields.division_id = ''
                        this.errors = {};
                        this.ButtonText = 'Insert'
                        this.submitStatus = 0;
                        toastr.success('Successfully Updated.');
                        this.getDistrict();
                    })
                    .catch((error)=>{
                        toastr.error('Something went wrong.');
                        // console.log(error);
                    });
                }
            },
            getDistrict(){
                axios
                .get("/api/district")
                .then((response)=>{
                    this.districts = response.data
                })
                .catch((error)=>{
                    // console.log(error);
                });
            },
            editDistrict(id){
                axios
                .get("/api/district/edit/"+id)
                .then((response)=>{
                    this.fields.district = response.data.name
                    this.fields.division_id = response.data.division_id
                    this.ButtonText = 'Update'
                    this.submitStatus = 1;
                    this.district_id = response.data.id
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            deleteDistrict(id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/district/delete/"+id)
                    .then((response)=>{
                        toastr.error('Successfully Deleted.');
                        this.getDistrict();
                    })
                    .catch((error)=>{
                        toastr.error('Something went wrong.');
                        // console.log(error);
                    });
                }
            },
            clearInput(){
                this.fields = {}
                this.fields.division_id = ''
            },
            getDivisionId(){
                axios
                .get("/api/get_data/divisions")
                .then((response)=>{
                     this.divisions = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
        },
    }
</script>
