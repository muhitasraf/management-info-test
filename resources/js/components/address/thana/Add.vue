<template>
    <div class="card-header">
        <h5 class="mb-0">Create Thana</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="d-grid gap-2 d-md-block">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#thanaModal">Add New Thana</button>
            </div>

            <div class="modal fade" id="thanaModal" tabindex="-1" aria-labelledby="thanaModalLabel" aria-hidden="true" ref="myModalRef">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form @submit.prevent="submit">
                            <div class="modal-header">
                                <h5 class="modal-title" id="thanaModalLabel">Create thana</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-1">
                                    <label for="thana" class="col-form-label">thana Name:</label>
                                    <input type="text" v-model="fields.thana" class="form-control" id="thana" placeholder="thana Name">
                                </div>
                                <div class="mb-1">
                                    <label for="district_id" class="col-form-label">District:</label>
                                    <select v-model="fields.district_id" class="form-control district_id" id="district_id">
                                        <option disabled value="">Select District</option>
                                        <option v-for="district in districts" v-bind:value="district.id">{{ district.name }}</option>
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
                                        <th>thana Name</th>
                                        <th>district Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(thana, index) in thanas" :key="thana.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ thana.thana_name }}</td>
                                        <td>{{ thana.district_name }}</td>
                                        <td>
                                            <button @click="editThana(thana.id)" class="btn btn-sm btn-info mx-1" data-bs-toggle="modal" data-bs-target="#thanaModal">Edit</button>
                                            <button @click="deleteThana(thana.id)" class="btn btn-sm btn-danger">Delete</button>
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
                    district_id: '',
                },
                errors : {},
                'thanas' : [],
                'districts' : [],
                'ButtonText' : 'Insert',
                'submitStatus' : '0',
                'thana_id' : '',
            };
        },
        created() {
            this.getThana();
            this.getDistrict();
        },
        mounted(){

        },
        methods :{

            submit(){
                if(this.submitStatus==0){
                    axios
                    .post("/api/thana/create", this.fields)
                    .then((response)=>{
                        this.fields = {};
                        this.errors = {};
                        // $('#thanaModal').modal('hide');
                        document.getElementById('close').click();
                        toastr.success('Successfully Created.');
                        this.getThana();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }else{
                    axios
                    .post("/api/thana/update/"+this.thana_id, this.fields)
                    .then((response)=>{
                        // $('#thanaModal').modal('hide');
                        document.getElementById('close').click();
                        this.fields = {};
                        this.fields.district_id = ''
                        this.errors = {};
                        this.ButtonText = 'Insert'
                        this.submitStatus = 0;
                        toastr.success('Successfully Updated.');
                        this.getThana();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
            getThana(){
                axios
                .get("/api/thana")
                .then((response)=>{
                    this.thanas = response.data
                    console.log(this.thanas)
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            editThana(id){
                axios
                .get("/api/thana/edit/"+id)
                .then((response)=>{
                    this.fields.thana = response.data.name
                    this.fields.district_id = response.data.district_id
                    this.ButtonText = 'Update'
                    this.submitStatus = 1;
                    this.thana_id = response.data.id
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            deleteThana(id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/thana/delete/"+id)
                    .then((response)=>{
                        toastr.error('Successfully Deleted.');
                        this.getThana();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
            clearInput(){
                this.fields = {}
                this.fields.district_id = ''
            },
            getDistrict(){
                axios
                .get("/api/get_data/districts")
                .then((response)=>{
                    this.districts = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
        },
    }
</script>
