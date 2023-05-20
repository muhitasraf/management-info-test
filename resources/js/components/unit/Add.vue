<template>
    <div class="card-header">
        <h5 class="mb-0">Create Unit</h5>
    </div>
    <div class="card-body">
        <div class="row">

            <div class="col-md-6 pt-4">

                <!-- Vertical form -->
                <div class="card">

                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="form-group">
                                <label>Unit Name</label>
                                <input v-model="field.unit_name" type="text" class="form-control unit_name">
                                <input v-model="unit_id" type="hidden">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select v-model="field.status" class="form-control status">
                                    <option disabled value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Remarks</label>
                                <input v-model="field.remarks" type="text" class="form-control remarks">
                            </div>

                            <span v-if="errors.unit_name">{{ errors.unit_name }}</span>
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
                                        <th>Unit Name</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(unit, index) in units" :key="unit.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ unit.name }}</td>
                                        <td>{{ unit.status == 1 ? 'Active' : 'In-Active' }}</td>
                                        <td>{{ unit.remarks }}</td>
                                        <td>
                                            <button @click="editUnit(unit.id)" class="btn btn-sm btn-info mx-1">Edit</button>
                                            <button @click="deleteUnit(unit.id)" class="btn btn-sm btn-danger">Delete</button>
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
    import UnitList from '../unit/Show.vue'
    export default{
        data() {
            return {
                field : {
                    status : '',
                },
                errors : {},
                'units' : [],
                'ButtonText' : 'Insert',
                'submitStatus' : '0',
                'unit_id' : '',
            };
        },
        created() {
            this.getUnit();
        },
        methods :{
            submit(){
                if(this.submitStatus==0){
                    axios
                    .post("/api/unit/create", this.field)
                    .then((response)=>{
                        this.field = {};
                        this.errors = {};
                        this.getUnit();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }else{
                    axios
                    .post("/api/unit/update/"+this.unit_id, this.field)
                    .then((response)=>{
                        this.field = {};
                        this.errors = {};
                        this.ButtonText = 'Insert'
                        this.submitStatus = 0;
                        this.getUnit();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
            getUnit(){
                axios
                .get("/api/unit")
                .then((response)=>{
                    this.units = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            editUnit(id){
                axios
                .get("/api/unit/edit/"+id)
                .then((response)=>{
                    this.field.unit_name = response.data.name
                    this.field.remarks = response.data.remarks
                    this.field.status = response.data.status
                    this.ButtonText = 'Update'
                    this.submitStatus = 1;
                    this.unit_id = response.data.id
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            deleteUnit(id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/unit/delete/"+id)
                    .then((response)=>{
                        this.getUnit();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
        },
        components : {
            UnitList,
        }
    }
</script>
