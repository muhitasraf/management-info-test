<template>
    <div class="card-header">
        <h5 class="mb-0">Create mowza</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="d-grid gap-2 d-md-block">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mowzaModal">Add New mowza</button>
            </div>

            <div class="modal fade" id="mowzaModal" tabindex="-1" aria-labelledby="mowzaModalLabel" aria-hidden="true" ref="myModalRef">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form @submit.prevent="submit">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mowzaModalLabel">Create mowza</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-1">
                                    <label for="mowza" class="col-form-label">Mowza Name:</label>
                                    <input type="text" v-model="fields.mowza" class="form-control" id="mowza" placeholder="Mowza Name">
                                </div>
                                <div class="mb-1">
                                    <label for="division_id" class="col-form-label">Division:</label>
                                    <select v-model="fields.division_id" @change="getDistrict($event.target.value)" class="form-control division_id" id="division_id">
                                        <option disabled value="">Select Division</option>
                                        <option v-for="division in divisions" v-bind:value="division.id">{{ division.name }}</option>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label for="district_id" class="col-form-label">District:</label>
                                    <select v-model="fields.district_id" @change="getThana($event.target.value)" class="form-control district_id" id="district_id">
                                        <option disabled value="">Select District</option>
                                        <option v-for="district in districts" v-bind:value="district.id">{{ district.name }}</option>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label for="thana_id" class="col-form-label">Thana:</label>
                                    <select v-model="fields.thana_id" @change="getUnion($event.target.value)" class="form-control thana_id" id="thana_id">
                                        <option disabled value="">Select Thana</option>
                                        <option v-for="thana in thanas" v-bind:value="thana.id">{{ thana.name }}</option>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label for="union_id" class="col-form-label">Union:</label>
                                    <select v-model="fields.union_id" class="form-control union_id" id="union_id">
                                        <option disabled value="">Select Union</option>
                                        <option v-for="union in unions" v-bind:value="union.id">{{ union.name }}</option>
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
                                        <th>Mowza</th>
                                        <th>Division</th>
                                        <th>District</th>
                                        <th>Thana</th>
                                        <th>Union</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(mowza, index) in mowzas" :key="mowza.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ mowza.mowza_name }}</td>
                                        <td>{{ mowza.division_name }}</td>
                                        <td>{{ mowza.district_name }}</td>
                                        <td>{{ mowza.thana_name }}</td>
                                        <td>{{ mowza.union_name }}</td>
                                        <td>
                                            <button @click="editMowza(mowza.id, mowza.division_id, mowza.district_id, mowza.thana_id)" class="btn btn-sm btn-info mx-1" data-bs-toggle="modal" data-bs-target="#mowzaModal">Edit</button>
                                            <button @click="deleteMowza(mowza.id)" class="btn btn-sm btn-danger">Delete</button>
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
                    district_id: '',
                    thana_id: '',
                    union_id: '',
                },
                errors : {},
                'mowzas' : [],
                'divisions' : [],
                'districts' : [],
                'thanas' : [],
                'unions' : [],
                'ButtonText' : 'Insert',
                'submitStatus' : '0',
                'mowza_id' : '',
            };
        },
        created() {
            this.getMowza();
            this.getDivision();
        },
        mounted(){
            this.getDivision();
        },
        methods :{

            submit(){
                if(this.submitStatus==0){
                    axios
                    .post("/api/mowza/create", this.fields)
                    .then((response)=>{
                        this.fields = {};
                        this.errors = {};
                        // $('#mowzaModal').modal('hide');
                        document.getElementById('close').click();
                        this.getMowza();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }else{
                    axios
                    .post("/api/mowza/update/"+this.mowza_id, this.fields)
                    .then((response)=>{
                        // $('#mowzaModal').modal('hide');
                        document.getElementById('close').click();
                        this.fields = {};
                        this.fields.district_id = ''
                        this.errors = {};
                        this.ButtonText = 'Insert'
                        this.submitStatus = 0;
                        this.getMowza();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
            getMowza(){
                axios
                .get("/api/mowza")
                .then((response)=>{
                    this.mowzas = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            editMowza(id, division_id, district_id, thana_id){

                this.getDistrict(division_id);
                this.getThana(district_id);
                this.getUnion(thana_id);
                axios
                .get("/api/mowza/edit/"+id)
                .then(response=>{
                    this.fields.mowza = response.data.name
                    this.fields.division_id = response.data.division_id
                    this.fields.district_id = response.data.district_id
                    this.fields.thana_id = response.data.thana_id
                    this.fields.union_id = response.data.union_id
                    this.ButtonText = 'Update'
                    this.submitStatus = 1;
                    this.mowza_id = response.data.id
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            deleteMowza(id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/mowza/delete/"+id)
                    .then((response)=>{
                        this.getmowza();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
            clearInput(){
                this.fields = {}
                this.fields.division_id = ''
                this.fields.district_id = ''
                this.fields.thana_id = ''
                this.fields.union_id = ''
                this.districts = []
                this.thanas = []
                this.unions = []
                this.ButtonText = 'Insert'
            },

            getDivision(){
                axios
                .get("/api/get_data/divisions")
                .then((response)=>{
                    this.divisions = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },

            getDistrict(id){
                axios
                .get("/api/get_data/districts/division_id/"+id)
                .then((response)=>{
                    this.districts = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },

            getThana(id){
                axios
                .get("/api/get_data/thanas/district_id/"+id)
                .then((response)=>{
                    this.thanas = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },

            getUnion(id){
                axios
                .get("/api/get_data/unions/thana_id/"+id)
                .then((response)=>{
                    this.unions = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
        },
    }


</script>
