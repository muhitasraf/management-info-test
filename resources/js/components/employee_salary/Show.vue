<template>
    <div class="card-header">
        <h5 class="mb-0">Update Employee Salary</h5>
    </div>
    <div class="card-body">
        <router-link to="/employee_salary">
            <button class="btn btn-sm btn-info">Salary List</button>
        </router-link>
        <router-link to="/employee_salary/create">
            <button class="btn btn-sm btn-info mx-1">Salary Create</button>
        </router-link>
        <div class="row">
            <div class="col-md-12 pt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="width: 120px;font-weight: bold;">Employee Code</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ employee_data.code }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 120px;font-weight: bold;">Employee Name</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ employee_data.name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 120px;font-weight: bold;">Gross</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ employee_data.gross }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 120px;font-weight: bold;">Basic</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ employee_data.basic }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 120px;font-weight: bold;">House Rent</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ employee_data.house_rent }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 120px;font-weight: bold;">Medical</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ employee_data.medical }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 120px;font-weight: bold;">Conveyance</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ employee_data.conveyance }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 120px;font-weight: bold;">Allowance</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ employee_data.allowance }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 120px;font-weight: bold;">TA</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ employee_data.TA }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 120px;font-weight: bold;">Mobile</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ employee_data.mobile }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                employee_data : {},
            };
        },
        mounted(){
            this.emp_id = this.$route.params.id ?? ''
            this.getEmployee(this.emp_id);
        },
        methods :{
            getEmployee(id){
                axios
                .get("/api/employee_salary/view/"+id)
                .then((response)=>{
                    this.employee_data = response.data;
                    console.log(this.employee_data)
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
        },
    }
</script>
