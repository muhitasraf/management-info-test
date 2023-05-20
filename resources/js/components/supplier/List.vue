<template>
    <div class="card-header">
        <h5 class="mb-0">Create Supplier</h5>
    </div>
    <div class="card-body">
        <router-link to="/supplier/create">
            <button class="btn btn-sm btn-info">Create Supplier</button>
        </router-link>
        <div class="table-responsive mt-2">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Supplier Name</th>
                        <th>NID</th>
                        <th>BIN</th>
                        <th>Present Address</th>
                        <th>Permanent Address</th>
                        <th>Mobile Office</th>
                        <th>Mobile Home</th>
                        <th>DOB</th>
                        <th>Father</th>
                        <th>Mother</th>
                        <th>Spouse</th>
                        <th>No of child</th>
                        <th>Occupation</th>
                        <th>Is alive</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(supplier, index) in suppliers" :key="supplier.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ supplier.name }}</td>
                        <td>{{ supplier.nid }}</td>
                        <td>{{ supplier.bin }}</td>
                        <td>{{ supplier.present_address }}</td>
                        <td>{{ supplier.permanent_address }}</td>
                        <td>{{ supplier.mobile }}</td>
                        <td>{{ supplier.mobile_1 }}</td>
                        <td>{{ supplier.DOB }}</td>
                        <td>{{ supplier.father }}</td>
                        <td>{{ supplier.mother }}</td>
                        <td>{{ supplier.spouse }}</td>
                        <td>{{ supplier.no_of_child }}</td>
                        <td>{{ supplier.occupation }}</td>
                        <td>{{ supplier.is_alive == 1 ? "Yes" : "No" }}</td>
                        <td>
                            <router-link :to="'/supplier/view/'+supplier.id">
                                <button class="btn btn-sm btn-info mx-1">View</button>
                            </router-link>
                            <router-link :to="'/supplier/edit/'+supplier.id">
                                <button class="btn btn-sm btn-info mx-1">Edit</button>
                            </router-link>
                            <button @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                'suppliers' : [],
            };
        },
        mounted(){
            this.getSupplier();
        },
        methods : {
            getSupplier(){
                axios
                .get("/api/supplier")
                .then((response)=>{
                    this.suppliers = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            deleteSupplier(supplier_id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/supplier/delete/"+supplier_id)
                    .then((response)=>{
                        this.getSupplier();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
        }
    }
</script>
