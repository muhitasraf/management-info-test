<template>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Division Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(division, index) in divisions" :key="division.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ division.name }}</td>
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
                'divisions' : [],
            };
        },
        mounted(){
            axios
            .get("/api/division")
            .then((response)=>{
                this.divisions = response.data
            })
            .catch((error)=>{
                console.log(error);
            });
        },
    }
</script>
