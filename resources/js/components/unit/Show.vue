<template>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Unit Name</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(unit, index) in units" :key="unit.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ unit.name }}</td>
                    <td>{{ unit.status == 1 ? 'Active' : 'In-Active' }}</td>
                    <td>{{ unit.remarks }}</td>
                    <td>
                        <button class="btn btn-sm btn-info mx-1">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                'units' : [],
            };
        },
        mounted(){
            axios
            .get("/api/unit")
            .then((response)=>{
                this.units = response.data
            })
            .catch((error)=>{
                console.log(error);
            });
        },
    }
</script>
