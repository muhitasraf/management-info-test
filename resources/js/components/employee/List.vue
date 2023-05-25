<template>
    <div class="card-header">
        <h5 class="mb-0">Employee List</h5>
    </div>
    <div class="card-body">
        <router-link to="/employee/create">
            <button class="btn btn-sm btn-info">Create Employee</button>
        </router-link>
        <div class="table-responsive mt-2">
            <div v-if="loading" class="text-center">
                <div style="width: 50px;height: 50px;" class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div v-else>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Employee Name</th>
                            <th>Designation</th>
                            <th>Department</th>
                            <th>Code</th>
                            <th>Father</th>
                            <th>Mother</th>
                            <th>Spouse</th>
                            <th>No of child</th>
                            <th>Present Address</th>
                            <th>Permanent Address</th>
                            <th>Mobile Office</th>
                            <th>Mobile Home</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(employee, index) in employees" :key="employee.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ employee.name }}</td>
                            <td>{{ employee.designation }}</td>
                            <td>{{ employee.department }}</td>
                            <td>{{ employee.code }}</td>
                            <td>{{ employee.father }}</td>
                            <td>{{ employee.mother }}</td>
                            <td>{{ employee.spouse }}</td>
                            <td>{{ employee.no_of_child }}</td>
                            <td>{{ employee.present_address }}</td>
                            <td>{{ employee.permanent_address }}</td>
                            <td>{{ employee.personal_mobile }}</td>
                            <td>{{ employee.office_mobile }}</td>
                            <td>{{ employee.status == 1 ? "Active" : "In-Active" }}</td>
                            <td class="text-center">
                                <router-link :to="'/employee/view/'+employee.id">
                                    <button class="btn btn-sm btn-info mx-1 my-1"><i class="ph ph-eye"></i></button>
                                </router-link>
                                <router-link :to="'/employee/edit/'+employee.id">
                                    <button class="btn btn-sm btn-info mx-1 my-1"><i class="ph ph-pencil"></i></button>
                                </router-link>
                                <button @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger"><i class="ph ph-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                'employees' : [],
                loading: false
            };
        },
        mounted(){
            this.getEmployee();
        },
        methods : {
            getEmployee(){
                this.loading = true
                axios
                .get("/api/employee")
                .then((response)=>{
                    this.employees = response.data
                    console.log(this.employees)
                })
                .catch((error)=>{
                    console.log(error);
                })
                .finally(() => (this.loading = false));
            },
            deleteEmployee(employee_id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/employee/delete/"+employee_id)
                    .then((response)=>{
                        this.getEmployee();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
        }
    }
</script>
