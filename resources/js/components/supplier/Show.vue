<template>
    <div class="card-header">
        <h5 class="mb-0">Single Supplier</h5>
    </div>
    <div class="card-body">
        <router-link to="/supplier">
            <button class="btn btn-sm btn-info mx-1">Supplier List</button>
        </router-link>
        <router-link to="/supplier/create">
            <button class="btn btn-sm btn-info">Create Supplier</button>
        </router-link>
        <div class="table-responsive mt-2">
            <p>Name: {{ supplier.name }}</p>
            <p>NID: {{ supplier.nid }}</p>
            <p>BIN: {{ supplier.bin }}</p>
            <p>Present Address: {{ supplier.present_address }}</p>
            <p>Permanent Add: {{ supplier.permanent_address }}</p>
            <p>Mobile: {{ supplier.mobile }}</p>
            <p>Father: {{ supplier.father }}</p>
            <p>Mother: {{ supplier.mother }}</p>
            <p>DOB: {{ supplier.DBO }}</p>
            <p>Spouse: {{ supplier.spouse }}</p>
            <p>No Of Child: {{ supplier.no_of_child }}</p>
            <p>Occupation: {{ supplier.occupation }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                'supplier' : [],
            };
        },
        mounted(){
            axios
            .post("/api/supplier/view/"+this.$route.params.id)
            .then((response)=>{
                this.supplier = response.data
            })
            .catch((error)=>{
                console.log(error);
            });
        },
    }
</script>
