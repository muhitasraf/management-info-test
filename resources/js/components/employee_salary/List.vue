
<template>
    <div class="card-header">
        <h5 class="mb-0">Create Employee Salary</h5>
    </div>
    <div class="card-body">
        <router-link to="/employee">
            <button class="btn btn-sm btn-info">Salary List</button>
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
            axios
            .get("/api/employee_salary")
            .then((response)=>{
                this.employee_salary = response.data;
            })
            .catch((error)=>{
                console.log(error);
            });
        },
        methods :{

        },
    }
</script>
