
<template>
    <div class="card-header">
        <h5 class="mb-0">Create Employee Salary</h5>
    </div>
    <div class="card-body">
        <router-link to="/employee_salary/create">
            <button class="btn btn-sm btn-info">Salary Create</button>
        </router-link>
        <div class="row">

            <div class="col-md-12 pt-4">

                <!-- Vertical form -->
                <div class="card">

                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Emp Name</th>
                                                <th scope="col">Gross</th>
                                                <th scope="col text-right">Basic</th>
                                                <th scope="col text-right">Houserent</th>
                                                <th scope="col text-right">conveyance</th>
                                                <th scope="col text-right">allowance</th>
                                                <th scope="col text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="employee_sal in employee_salary">
                                                <td>
                                                    {{ employee_sal.name }}
                                                </td>
                                                <td style="width: 10%;">
                                                    {{ employee_sal.gross }}
                                                </td>
                                                <td>
                                                    {{ employee_sal.basic }}
                                                </td>
                                                <td>
                                                    {{ employee_sal.house_rent }}
                                                </td>
                                                <td>
                                                    {{ employee_sal.conveyance }}
                                                </td>
                                                <td>
                                                    {{ employee_sal.allowance }}
                                                </td>

                                                <td class="text-center">
                                                    <router-link :to="'/employee_salary/view/'+employee_sal.id">
                                                        <button class="btn btn-sm btn-info mx-1 my-1"><i class="ph ph-eye"></i></button>
                                                    </router-link>
                                                    <router-link :to="'/employee_salary/edit/'+employee_sal.id">
                                                        <button class="btn btn-sm btn-info mx-1 my-1"><i class="ph ph-pencil"></i></button>
                                                    </router-link>
                                                    <button @click="deleteEmployee(employee_sal.id)" class="btn btn-sm btn-danger"><i class="ph ph-trash"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                employee_salary : '',
            };
        },
        mounted(){
            this.getEmployeeSalary();
        },
        methods :{
            deleteEmployee(employee_id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/employee_salary/delete/"+employee_id)
                    .then((response)=>{
                        this.getEmployeeSalary();
                        toastr.error('Successfully Deleted.');
                    })
                    .catch((error)=>{
                        // console.log(error);
                        toastr.error('Something went wrong.');
                    });
                }
            },
            getEmployeeSalary(){
                axios
                .get("/api/employee_salary")
                .then((response)=>{
                    this.employee_salary = response.data;
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
        },
    }
</script>
