<template>
    <div class="card-header">
        <h5 class="mb-0">Create union</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="d-grid gap-2 d-md-block">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#unionModal">Add New union</button>
            </div>

            <div class="modal fade" id="unionModal" tabindex="-1" aria-labelledby="unionModalLabel" aria-hidden="true" ref="myModalRef">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form @submit.prevent="submit">
                            <div class="modal-header">
                                <h5 class="modal-title" id="unionModalLabel">Create union</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-1">
                                    <label for="union" class="col-form-label">union Name:</label>
                                    <input type="text" v-model="fields.union" class="form-control" id="union" placeholder="union Name">
                                </div>
                                <div class="mb-1">
                                    <label for="thana_id" class="col-form-label">Thana:</label>
                                    <select v-model="fields.thana_id" class="form-control thana_id" id="thana_id">
                                        <option disabled value="">Select District</option>
                                        <option v-for="thana in thanas" v-bind:value="thana.id">{{ thana.name }}</option>
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
                                        <th>Union Name</th>
                                        <th>District Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(union, index) in unions" :key="union.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ union.union_name }}</td>
                                        <td>{{ union.thana_name }}</td>
                                        <td>
                                            <button @click="editUnion(union.id)" class="btn btn-sm btn-info mx-1" data-bs-toggle="modal" data-bs-target="#unionModal">Edit</button>
                                            <button @click="deleteUnion(union.id)" class="btn btn-sm btn-danger">Delete</button>
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
                    thana_id: '',
                },
                errors : {},
                'unions' : [],
                'thanas' : [],
                'ButtonText' : 'Insert',
                'submitStatus' : '0',
                'union_id' : '',
            };
        },
        created() {
            this.getUnion();
            this.getThana();
        },
        mounted(){

        },
        methods :{

            submit(){
                if(this.submitStatus==0){
                    axios
                    .post("/api/union/create", this.fields)
                    .then((response)=>{
                        this.fields = {};
                        this.errors = {};
                        // $('#unionModal').modal('hide');
                        document.getElementById('close').click();
                        toastr.success('Successfully Created.');
                        this.getUnion();
                    })
                    .catch((error)=>{
                        toastr.error('Something went wrong.');
                        // console.log(error);
                    });
                }else{
                    axios
                    .post("/api/union/update/"+this.union_id, this.fields)
                    .then((response)=>{
                        // $('#unionModal').modal('hide');
                        document.getElementById('close').click();
                        this.fields = {};
                        this.fields.thana_id = ''
                        this.errors = {};
                        this.ButtonText = 'Insert'
                        this.submitStatus = 0;
                        toastr.success('Successfully Updated.');
                        this.getUnion();
                    })
                    .catch((error)=>{
                        toastr.error('Something went wrong.');
                        // console.log(error);
                    });
                }
            },
            getUnion(){
                axios
                .get("/api/union")
                .then((response)=>{
                    this.unions = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            editUnion(id){
                axios
                .get("/api/union/edit/"+id)
                .then((response)=>{
                    this.fields.union = response.data.name
                    this.fields.thana_id = response.data.thana_id
                    this.ButtonText = 'Update'
                    this.submitStatus = 1;
                    this.union_id = response.data.id
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            deleteUnion(id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/union/delete/"+id)
                    .then((response)=>{
                        toastr.error('Successfully Deleted.');
                        this.getUnion();
                    })
                    .catch((error)=>{
                        toastr.error('Something went wrong.');
                        // console.log(error);
                    });
                }
            },
            clearInput(){
                this.fields = {}
                this.fields.thana_id = ''
            },
            getThana(){
                axios
                .get("/api/get_data/thanas")
                .then((response)=>{
                    this.thanas = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            // getData(url){
            //     axios
            //     .get(url)
            //     .then((response)=>{
            //         this.data =  response.data;

            //     })
            //     .catch((error)=>{
            //         console.log(error);
            //     });
            //     console.log(this.data)
            //     return  this.data;
            // },
        },
    }
</script>
