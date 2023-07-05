<template>
    <div class="card-header">
        <h5 class="mb-0">Create employee</h5>
    </div>
    <div class="card-body">
        <router-link to="/employee">
            <button class="btn btn-sm btn-info">employee List</button>
        </router-link>
        <div class="row">

            <div class="col-md-12 pt-4">

                <!-- Vertical form -->
                <div class="card">

                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="row g-3">
                                <div class="col">
                                    <label>Employee Name</label>
                                    <input type="text" v-model="fields.employee_name" class="form-control" placeholder="Employee Name" aria-label="Employee Name">
                                </div>
                                <div class="col">
                                    <label>Designation</label>
                                    <select v-model="fields.designation_id" name="designation_id" class="form-select designation_id">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="designation in designations" v-bind:value="designation.id">{{ designation.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col">
                                    <label>Department</label>
                                    <select v-model="fields.department_id" name="department_id" class="form-select department_id">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="department in departments" v-bind:value="department.id">{{ department.name }}</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Code</label>
                                    <input type="text" v-model="fields.code" class="form-control" placeholder="Code" aria-label="Code">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Father</label>
                                    <input type="text" v-model="fields.father" class="form-control" placeholder="Father" aria-label="Father">
                                </div>
                                <div class="col">
                                    <label>Mother</label>
                                    <input type="text" v-model="fields.mother" class="form-control" placeholder="Mother" aria-label="Mother">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Spouse</label>
                                    <input type="text" v-model="fields.spouse" class="form-control" placeholder="Spouse" aria-label="Spouse">
                                </div>
                                <div class="col">
                                    <label>No of child</label>
                                    <input type="text" v-model="fields.no_of_child" class="form-control" placeholder="No Of Child">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Present Address</label>
                                    <input type="text" v-model="fields.present_address" class="form-control" placeholder="Present Address" aria-label="Present Address">
                                </div>
                                <div class="col">
                                    <label>Permanent Address</label>
                                    <input type="text" v-model="fields.permanent_address" class="form-control" placeholder="Permanent Address" aria-label="Permanent Address">
                                </div>
                            </div>

                            <div class="row g-3">

                                <div class="col">
                                    <label>Personal Mobile</label>
                                    <input type="text" v-model="fields.personal_mobile" class="form-control" placeholder="Personal Mobile" aria-label="Personal Mobile">
                                </div>
                                <div class="col">
                                    <label>Office Mobile</label>
                                    <input type="text" v-model="fields.office_mobile" class="form-control" placeholder="Office Mobile" aria-label="Office Mobile">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col">
                                    <label>Status</label>
                                    <select v-model="fields.status" name="status" class="form-select">
                                        <option value="" disabled>Please select one</option>
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                </div>
                                <div class="col">

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
                fields : {
                    status : '',
                    designation_id : '',
                    department_id : '',
                },
                errors : {},
                departments : [] ,
                designations : [],
            };
        },
        mounted(){
            this.getDepartment();
            this.getDesignation();
        },
        methods :{
            submit(){
                axios
                .post("/api/employee/create", this.fields)
                .then((response)=>{
                    this.fields = {};
                    this.errors = {};
                    toastr.success('Successfully Created.');
                    this.$router.push('/employee');
                })
                .catch((error)=>{
                    toastr.error('Something went wrong.');
                });
            },
            getDepartment(){
                axios
                .get("/api/department")
                .then((response)=>{
                    this.departments = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            getDesignation(){
                axios
                .get("/api/designation")
                .then((response)=>{
                    this.designations = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
        },
    }
</script>
