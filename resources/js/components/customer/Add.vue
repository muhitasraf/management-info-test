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
                                    <input type="text" v-model="field.customer_name" class="form-control" placeholder="Customer Name" aria-label="Customer Name">
                                </div>
                                <div class="col">
                                    <label>NID</label>
                                    <input type="text" v-model="field.nid" class="form-control" placeholder="NID" aria-label="NID">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col">
                                    <label>BIN</label>
                                    <input type="text" v-model="field.bin" class="form-control" placeholder="BIN" aria-label="NID">
                                </div>
                                <div class="col">
                                    <label>Present Address</label>
                                    <input type="text" v-model="field.present_address" class="form-control" placeholder="Present Address" aria-label="Present Address">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Permanent Address</label>
                                    <input type="text" v-model="field.permanent_address" class="form-control" placeholder="Permanent Address" aria-label="Permanent Address">
                                </div>
                                <div class="col">
                                    <label>Mobile Home</label>
                                    <input type="text" v-model="field.mobile" class="form-control" placeholder="Mobile Home" aria-label="Mobile Home">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Mobile Office</label>
                                    <input type="text" v-model="field.mobile_1" class="form-control" placeholder="Mobile Office" aria-label="Mobile Office">
                                </div>
                                <div class="col">
                                    <label>Date of Birth</label>
                                    <input type="date" v-model="field.DOB" class="form-control" >
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Father</label>
                                    <input type="text" v-model="field.father" class="form-control" placeholder="Mobile Office" aria-label="Mobile Office">
                                </div>
                                <div class="col">
                                    <label>Mother</label>
                                    <input type="text" v-model="field.mother" class="form-control" placeholder="Mother" aria-label="Mother">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Spous</label>
                                    <input type="text" v-model="field.spous" class="form-control" placeholder="Spous" aria-label="Spous">
                                </div>
                                <div class="col">
                                    <label>No of child</label>
                                    <input type="text" v-model="field.no_of_child" class="form-control" placeholder="No Of Child">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Occupation</label>
                                    <input type="text" v-model="field.occupation" class="form-control" placeholder="Spous" aria-label="Spous">
                                </div>
                                <div class="col">
                                    <label>Is Alive</label>
                                    <select v-model="field.is_alive" name="is_alive" class="form-select">
                                        <option value="" disabled>Please select one</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <span v-if="errors.company_name">{{ errors.company_name }}</span>
                            <div class="text-right pt-1">
                                <button type="submit" class="btn btn-primary">{{ buttonText }}<i class="icon-paperplane ml-2"></i></button>
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
                field : {},
                errors : {},
                buttonText : '',
                id : '',
            };
        },
        mounted(){
            this.id = this.$route.params.id ?? ''
            console.log('id m='+this.id)
            this.buttonText = this.id == '' ? 'Insert' : 'Update'
            // if(this.id==''){
            //     this.buttonText = 'Insert'
            // }else{
            //     this.buttonText = 'Update'
            // }
            axios
            .post("/api/customer/edit/"+this.id)
            .then((response)=>{
                console.log(response.data)
                this.field.customer_name = response.data.name
            })
            .catch((error)=>{
                console.log(error);
            });
        },
        methods :{
            submit(){
                this.id != '' ? this.createUpdate("/api/customer/update/"+this.id, this.field)
                : this.createUpdate("/api/customer/create", this.field);
                // if(this.id){
                //     this.createUpdate("/api/customer/update/"+this.id, this.field);
                // }else{
                //     this.createUpdate("/api/customer/create", this.field);
                // }

            },
            createUpdate(url, params){

            },
        },
    }
</script>
