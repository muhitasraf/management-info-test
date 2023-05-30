<template>
    <div class="card-header">
        <h5 class="mb-0">Edit Supplier</h5>
    </div>
    <div class="card-body">
        <router-link to="/supplier">
            <button class="btn btn-sm btn-info mx-1">Supplier List</button>
        </router-link>
        <router-link to="/supplier/create">
            <button class="btn btn-sm btn-info">Create Supplier</button>
        </router-link>
        <div class="row">

            <div class="col-md-12 pt-4">

                <!-- Vertical form -->
                <div class="card">

                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="row g-3">
                                <div class="col">
                                    <label>supplier Name</label>
                                    <input type="text" v-model="fields.supplier_name" class="form-control" placeholder="supplier Name" aria-label="supplier Name">
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
                                    <input type="text" v-model="fields.spouse" class="form-control" placeholder="Spous" aria-label="Spous">
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
                                <button type="submit" class="btn btn-primary">Update<i class="icon-paperplane ml-2"></i></button>
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
                fields : {},
                errors : {},
                supplier_id : '',
            };
        },
        mounted(){
            this.supplier_id = this.$route.params.id ?? ''
            axios
            .post("/api/supplier/edit/"+this.supplier_id)
            .then((response)=>{
                console.log(response.data)
                this.fields.supplier_name = response.data.name
                this.fields.nid = response.data.nid
                this.fields.bin = response.data.bin
                this.fields.present_address = response.data.present_address
                this.fields.permanent_address = response.data.permanent_address
                this.fields.mobile = response.data.mobile
                this.fields.mobile_1 = response.data.mobile_1
                this.fields.DOB = response.data.DOB
                this.fields.father = response.data.father
                this.fields.mother = response.data.mother
                this.fields.spouse = response.data.spouse
                this.fields.no_of_child = response.data.no_of_child
                this.fields.occupation = response.data.occupation
                this.fields.is_alive = response.data.is_alive
            })
            .catch((error)=>{
                console.log(error);
            });
        },
        methods :{
            submit(){
                axios
                    .post("/api/supplier/update/"+this.supplier_id, this.fields)
                    .then((response)=>{
                        this.fields = {};
                        this.errors = {};
                        this.$router.push('/supplier');
                        toastr.success('Successfully Updated.');
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
            },
        },
    }
</script>
