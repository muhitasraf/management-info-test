<template>
    <div class="card-header">
        <h5 class="mb-0">Update Employee Salary</h5>
    </div>
    <div class="card-body">
        <router-link to="/employee_salary">
            <button class="btn btn-sm btn-info">Salary List</button>
        </router-link>
        <div class="row">

            <div class="col-md-12 pt-4">

                <!-- Vertical form -->
                <div class="card">

                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="row g-3">
                                <div class="col">
                                    <label>Employee Code</label>
                                    <input type="text" v-model="fields.emp_code" class="form-control" placeholder="Employee Code">
                                    <input type="hidden" v-model="fields.emp_id">
                                </div>
                                <div class="col">
                                    <label>Employee Name</label>
                                    <input type="text" v-model="fields.employee_name" class="form-control" placeholder="Employee Name">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col">
                                    <label>Gross</label>
                                    <input type="text" v-model="fields.gross" class="form-control" placeholder="Gross">
                                </div>
                                <div class="col">
                                    <label>Basic</label>
                                    <input type="text" v-model="fields.basic" class="form-control" placeholder="Basic">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>House Rent</label>
                                    <input type="text" v-model="fields.house_rent" class="form-control" placeholder="House Rent">
                                </div>
                                <div class="col">
                                    <label>medical</label>
                                    <input type="text" v-model="fields.medical" class="form-control" placeholder="Medical">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Conveyance</label>
                                    <input type="text" v-model="fields.conveyance" class="form-control" placeholder="Conveyance">
                                </div>
                                <div class="col">
                                    <label>Allowance</label>
                                    <input type="text" v-model="fields.allowance" class="form-control" placeholder="allowance">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>TA</label>
                                    <input type="text" v-model="fields.TA" class="form-control" placeholder="TA">
                                </div>
                                <div class="col">
                                    <label>Mobile</label>
                                    <input type="text" v-model="fields.mobile" class="form-control" placeholder="Mobile">
                                </div>
                            </div>

                            <span v-if="errors.employee_name">{{ errors.employee_name }}</span>
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
                fields : {},
                errors : {},
                employee_name : '',
                emp_id : '',
            };
        },
        mounted(){
            this.emp_id = this.$route.params.id ?? ''
            this.getEmployee(this.emp_id);
        },
        methods :{
            submit(){
                console.log(this.fields);
                axios
                .post("/api/employee_salary/create", this.fields)
                .then((response)=>{
                    this.fields = {};
                    this.errors = {};
                    toastr.success('Successfully Created.');
                    this.$router.push('/employee_salary');
                })
                .catch((error)=>{
                    // console.log(error);
                    toastr.error('Something went wrong.');
                });
            },
            getEmployee(id){
                axios
                .get("/api/get_data/employee_info/id/"+id)
                .then((response)=>{
                    this.fields.employee_name = response.data[0]['name'];
                    this.fields.employee_name = response.data[0]['code'];
                    this.fields.emp_id = response.data[0]['id'];
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
        },
    }
</script>
