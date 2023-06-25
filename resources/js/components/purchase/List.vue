<template>
    <div class="row">
        <div class="col-md-12 pt-2">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>JL No</th>
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
                                    <td>{{ mowza.jl_no }}</td>
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
                        toastr.success('Successfully Created.');
                        this.getMowza();
                    })
                    .catch((error)=>{
                        toastr.error('Something went wrong.');
                        // console.log(error);
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
                        toastr.success('Successfully Updated.');
                        this.getMowza();
                    })
                    .catch((error)=>{
                        toastr.error('Something went wrong.');
                        // console.log(error);
                    });
                }
            },
            getMowza(){
                axios
                .get("/api/purchase")
                .then((response)=>{
                    this.mowzas = response.data
                })
                .catch((error)=>{
                    // console.log(error);
                    toastr.error('Something went wrong.');
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
                    toastr.error('Something went wrong.');
                    // console.log(error);
                });
            },
            deleteMowza(id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/mowza/delete/"+id)
                    .then((response)=>{
                        toastr.error('Successfully Deleted.');
                        this.getmowza();
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
