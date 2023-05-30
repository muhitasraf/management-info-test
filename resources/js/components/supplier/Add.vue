<template>
    <div class="card-header">
        <h5 class="mb-0">Create Supplier</h5>
    </div>
    <div class="card-body">
        <router-link to="/supplier">
            <button class="btn btn-sm btn-info">Supplier List</button>
        </router-link>
        <div class="row">

            <div class="col-md-12 pt-4">

                <!-- Vertical form -->
                <div class="card">

                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="row g-3">
                                <div class="col">
                                    <label>Supplier Name</label>
                                    <input type="text" v-model="fields.supplier_name" class="form-control" placeholder="Supplier Name" aria-label="supplier Name">
                                </div>
                                <div class="col">
                                    <label>NID</label>
                                    <input type="text" v-model="fields.nid" class="form-control" placeholder="NID" aria-label="NID">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col">
                                    <label>BIN</label>
                                    <input type="text" v-model="fields.bin" class="form-control" placeholder="BIN" aria-label="NID">
                                </div>
                                <div class="col">
                                    <label>Present Address</label>
                                    <input type="text" v-model="fields.present_address" class="form-control" placeholder="Present Address" aria-label="Present Address">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Permanent Address</label>
                                    <input type="text" v-model="fields.permanent_address" class="form-control" placeholder="Permanent Address" aria-label="Permanent Address">
                                </div>
                                <div class="col">
                                    <label>Mobile Home</label>
                                    <input type="text" v-model="fields.mobile" class="form-control" placeholder="Mobile Home" aria-label="Mobile Home">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Mobile Office</label>
                                    <input type="text" v-model="fields.mobile_1" class="form-control" placeholder="Mobile Office" aria-label="Mobile Office">
                                </div>
                                <div class="col">
                                    <label>Date of Birth</label>
                                    <input type="date" v-model="fields.DOB" class="form-control" >
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Father</label>
                                    <input type="text" v-model="fields.father" class="form-control" placeholder="Mobile Office" aria-label="Mobile Office">
                                </div>
                                <div class="col">
                                    <label>Mother</label>
                                    <input type="text" v-model="fields.mother" class="form-control" placeholder="Mother" aria-label="Mother">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Spous</label>
                                    <input type="text" v-model="fields.spouse" class="form-control" placeholder="Spouse" aria-label="Spous">
                                </div>
                                <div class="col">
                                    <label>No of child</label>
                                    <input type="text" v-model="fields.no_of_child" class="form-control" placeholder="No Of Child">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Occupation</label>
                                    <input type="text" v-model="fields.occupation" class="form-control" placeholder="Spous" aria-label="Spous">
                                </div>
                                <div class="col">
                                    <label>Is Alive</label>
                                    <select v-model="fields.is_alive" name="is_alive" class="form-select">
                                        <option value="" disabled>Please select one</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <span v-if="errors.supplier_name">{{ errors.supplier_name }}</span>
                            <div class="text-right pt-1">
                                <button type="submit" class="btn btn-primary">Insert<i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /vertical form -->

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</template>

<style>

</style>

<script>
    export default{
        data() {
            return {
                fields : {
                    is_alive : '',
                },
                errors : {},
            };
        },
        mounted(){

        },
        methods :{
            submit(){
                axios
                    .post("/api/supplier/create", this.fields)
                    .then((response)=>{
                        this.fields = {};
                        this.errors = {};
                        this.$router.push('/supplier');
                        toastr.success('Successfully Deleted.');
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
            }
        },
    }
</script>
