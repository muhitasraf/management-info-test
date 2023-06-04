<template>
    <div class="card-header">
        <h5 class="mb-0">Create Company</h5>
    </div>
    <div class="card-body">
        <router-link to="/customer/create">
            <button class="btn btn-sm btn-info">Create Customer</button>
        </router-link>
        <div class="table-responsive mt-2">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Customer Name</th>
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
                    <tr v-for="(customer, index) in customers" :key="customer.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ customer.name }}</td>
                        <td>{{ customer.nid }}</td>
                        <td>{{ customer.bin }}</td>
                        <td>{{ customer.present_address }}</td>
                        <td>{{ customer.permanent_address }}</td>
                        <td>{{ customer.mobile }}</td>
                        <td>{{ customer.mobile_1 }}</td>
                        <td>{{ customer.DOB }}</td>
                        <td>{{ customer.father }}</td>
                        <td>{{ customer.mother }}</td>
                        <td>{{ customer.spouse }}</td>
                        <td>{{ customer.no_of_child }}</td>
                        <td>{{ customer.occupation }}</td>
                        <td>{{ customer.is_alive == 1 ? "Yes" : "No" }}</td>
                        <td class="text-center">
                            <router-link :to="'/customer/view/'+customer.id">
                                <button class="btn btn-sm btn-info mx-1 my-1"><i class="ph ph-eye"></i></button>
                            </router-link>
                            <router-link :to="'/customer/edit/'+customer.id">
                                <button class="btn btn-sm btn-info mx-1 my-1"><i class="ph ph-pencil"></i></button>
                            </router-link>
                            <button @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger"><i class="ph ph-trash"></i></button>
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
                'customers' : [],
            };
        },
        mounted(){
            this.getCustomer();
        },
        methods : {
            getCustomer(){
                axios
                .get("/api/customer")
                .then((response)=>{
                    this.customers = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            deleteCustomer(customer_id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/customer/delete/"+customer_id)
                    .then((response)=>{
                        toastr.error('Successfully Deleted.');
                        this.getCustomer();
                    })
                    .catch((error)=>{
                        // console.log(error);
                        toastr.error('Something went wrong.');
                    });
                }
            },
        }
    }
</script>
