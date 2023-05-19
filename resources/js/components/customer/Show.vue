<template>
    <div class="card-header">
        <h5 class="mb-0">Single Customer</h5>
    </div>
    <div class="card-body">
        <router-link to="/customer">
            <button class="btn btn-sm btn-info">Customer List</button>
        </router-link>
        <div class="table-responsive mt-2">
            <p>Name: {{ customers.name }}</p>
            <p>NID: {{ customers.nid }}</p>
            <p>BIN: {{ customers.bin }}</p>
            <p>Present Address: {{ customers.present_address }}</p>
            <p>Permanent Add: {{ customers.permanent_address }}</p>
            <p>Mobile: {{ customers.mobile }}</p>
            <p>Father: {{ customers.father }}</p>
            <p>Mother: {{ customers.mother }}</p>
            <p>DOB: {{ customers.DBO }}</p>
            <p>Spouse: {{ customers.spouse }}</p>
            <p>No Of Child: {{ customers.no_of_child }}</p>
            <p>Occupation: {{ customers.occupation }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                'customers' : [],
            };
        },
        mounted(){
            axios
            .post("/api/customer/view/"+this.$route.params.id)
            .then((response)=>{
                this.customers = response.data
            })
            .catch((error)=>{
                console.log(error);
            });
        },
    }
</script>
