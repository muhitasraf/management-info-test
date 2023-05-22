<template>
    <div class="card-header">
        <h5 class="mb-0">Create Division</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="d-grid gap-2 d-md-block">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#divisionModal">Add New Division</button>
            </div>

            <div class="modal fade" id="divisionModal" tabindex="-1" aria-labelledby="divisionModalLabel" aria-hidden="true" ref="myModalRef">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form @submit.prevent="submit">
                            <div class="modal-header">
                                <h5 class="modal-title" id="divisionModalLabel">Create Division</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-1">
                                    <label for="division" class="col-form-label">Division Name:</label>
                                    <input type="text" v-model="fields.division" class="form-control" id="division" placeholder="Division Name">
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
                                        <th>Division Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(division, index) in divisions" :key="division.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ division.name }}</td>
                                        <td>
                                            <button @click="editDivision(division.id)" class="btn btn-sm btn-info mx-1" data-bs-toggle="modal" data-bs-target="#divisionModal">Edit</button>
                                            <button @click="deleteDivision(division.id)" class="btn btn-sm btn-danger">Delete</button>
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
                    status : '',
                },
                errors : {},
                'divisions' : [],
                'ButtonText' : 'Insert',
                'submitStatus' : '0',
                'division_id' : '',
            };
        },
        created() {
            this.getDivision();
        },
        mounted(){

        },
        methods :{

            submit(){
                if(this.submitStatus==0){
                    axios
                    .post("/api/division/create", this.fields)
                    .then((response)=>{
                        this.fields = {};
                        this.errors = {};
                        // $('#divisionModal').modal('hide');
                        document.getElementById('close').click();
                        this.getDivision();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }else{
                    axios
                    .post("/api/division/update/"+this.division_id, this.fields)
                    .then((response)=>{
                        // $('#divisionModal').modal('hide');
                        document.getElementById('close').click();
                        this.fields = {};
                        this.fields.status = ''
                        this.errors = {};
                        this.ButtonText = 'Insert'
                        this.submitStatus = 0;
                        this.getDivision();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
            getDivision(){
                axios
                .get("/api/division")
                .then((response)=>{
                    this.divisions = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            editDivision(id){
                axios
                .get("/api/division/edit/"+id)
                .then((response)=>{
                    this.fields.division = response.data.name
                    this.ButtonText = 'Update'
                    this.submitStatus = 1;
                    this.division_id = response.data.id
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            deleteDivision(id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/division/delete/"+id)
                    .then((response)=>{
                        this.getDivision();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
            clearInput(){
                this.fields = {}
                this.ButtonText = 'Insert'
            },
        },
    }
</script>
