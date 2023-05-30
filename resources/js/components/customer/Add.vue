<template>
    <div class="card-header">
        <h5 class="mb-0">Create Customer</h5>
    </div>
    <div class="card-body">
        <router-link to="/customer">
            <button class="btn btn-sm btn-info">Customer List</button>
        </router-link>
        <div class="row">

            <div class="col-md-12 pt-4">

                <!-- Vertical form -->
                <div class="card">

                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="row g-3">
                                <div class="col">
                                    <label>Customer Name</label>
                                    <input type="text" v-model="fields.customer_name" class="form-control" placeholder="Customer Name">
                                    <span class="text-warning" v-if="errors.name">{{ errors.name[0] }}</span>
                                </div>
                                <div class="col">
                                    <label>NID</label>
                                    <input type="text" v-model="fields.nid" class="form-control" placeholder="NID">
                                    <span class="text-warning" v-if="errors.nid">{{ errors.nid[0] }}</span>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col">
                                    <label>BIN</label>
                                    <input type="text" v-model="fields.bin" class="form-control" placeholder="BIN">
                                    <span class="text-warning" v-if="errors.bin">{{ errors.bin[0] }}</span>
                                </div>
                                <div class="col">
                                    <label>Present Address</label>
                                    <input type="text" v-model="fields.present_address" class="form-control" placeholder="Present Address">
                                    <span class="text-warning" v-if="errors.present_address">{{ errors.present_address[0] }}</span>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Permanent Address</label>
                                    <input type="text" v-model="fields.permanent_address" class="form-control" placeholder="Permanent Address">
                                    <span class="text-warning" v-if="errors.permanent_address">{{ errors.permanent_address[0] }}</span>
                                </div>
                                <div class="col">
                                    <label>Mobile Home</label>
                                    <input type="text" v-model="fields.mobile" class="form-control" placeholder="Mobile Home">
                                    <span class="text-warning" v-if="errors.mobile">{{ errors.mobile[0] }}</span>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Mobile Office</label>
                                    <input type="text" v-model="fields.mobile_1" class="form-control" placeholder="Mobile Office">
                                    <span class="text-warning" v-if="errors.mobile_1">{{ errors.mobile_1[0] }}</span>
                                </div>
                                <div class="col">
                                    <label>Date of Birth</label>
                                    <input type="date" v-model="fields.DOB" class="form-control" >
                                    <span class="text-warning" v-if="errors.DOB">{{ errors.DOB[0] }}</span>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Father</label>
                                    <input type="text" v-model="fields.father" class="form-control" placeholder="Mobile Office">
                                    <span class="text-warning" v-if="errors.father">{{ errors.father[0] }}</span>
                                </div>
                                <div class="col">
                                    <label>Mother</label>
                                    <input type="text" v-model="fields.mother" class="form-control" placeholder="Mother">
                                    <span class="text-warning" v-if="errors.mother">{{ errors.mother[0] }}</span>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Spous</label>
                                    <input type="text" v-model="fields.spouse" class="form-control" placeholder="Spouse">
                                    <span class="text-warning" v-if="errors.spouse">{{ errors.spouse[0] }}</span>
                                </div>
                                <div class="col">
                                    <label>No of child</label>
                                    <input type="text" v-model="fields.no_of_child" class="form-control" placeholder="No Of Child">
                                    <span class="text-warning" v-if="errors.no_of_child">{{ errors.no_of_child[0] }}</span>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Occupation</label>
                                    <input type="text" v-model="fields.occupation" class="form-control" placeholder="Spous">
                                    <span class="text-warning" v-if="errors.occupation">{{ errors.occupation[0] }}</span>
                                </div>
                                <div class="col">
                                    <label>Is Alive</label>
                                    <select v-model="fields.is_alive" name="is_alive" class="form-select">
                                        <option value="" disabled>Please select one</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    <span class="text-warning" v-if="errors.is_alive">{{ errors.is_alive[0] }}</span>
                                </div>
                            </div>
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
                console.log(this.fields)
                axios
                .post("/api/customer/create", this.fields)
                .then((response)=>{
                    this.fields = {};
                    this.errors = {};
                    this.$router.push('/customer');
                    toastr.success('Successfully Created.');
                })
                .catch((error)=>{

                    this.errors = error.response.data.errors;
                    console.log(this.errors);
                });
            }
        },
    }
</script>
