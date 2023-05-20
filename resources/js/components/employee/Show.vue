<template>
    <div class="card-header">
        <h5 class="mb-0">Single employee</h5>
    </div>
    <div class="card-body">
        <router-link to="/employee">
            <button class="btn btn-sm btn-info mx-1">employee List</button>
        </router-link>
        <router-link to="/employee/create">
            <button class="btn btn-sm btn-info">Create employee</button>
        </router-link>
        <div class="table-responsive mt-2">
            <p>Name: {{ employee.name }}</p>
            <p>Designation: {{ employee.designation }}</p>
            <p>Department: {{ employee.department }}</p>
            <p>Code: {{ employee.code }}</p>
            <p>Father: {{ employee.father }}</p>
            <p>Mother: {{ employee.mother }}</p>
            <p>Spouse: {{ employee.spouse }}</p>
            <p>No Of Child: {{ employee.no_of_child }}</p>
            <p>Present Address: {{ employee.present_address }}</p>
            <p>Permanent Add: {{ employee.permanent_address }}</p>
            <p>Personal Mobile: {{ employee.personal_mobile }}</p>
            <p>Officce Mobile: {{ employee.office_mobile }}</p>
            <p>Status: {{ employee.status }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                'employee' : [],
            };
        },
        mounted(){
            axios
            .post("/api/employee/view/"+this.$route.params.id)
            .then((response)=>{
                this.employee = response.data
            })
            .catch((error)=>{
                console.log(error);
            });
        },
    }
</script>
