<template>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Customer Name</th>
                    <th>NID</th>
                    <th>BIN</th>
                    <th>present_address</th>
                    <th>permanent_address</th>
                    <th>mobile</th>
                    <th>mobile_1</th>
                    <th>DOB</th>
                    <th>father</th>
                    <th>mother</th>
                    <th>spouse</th>
                    <th>no_of_child</th>
                    <th>occupation</th>
                    <th>is_alive</th>
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
                    <td>{{ customer.is_alive }}</td>
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
                'customers' : [],
            };
        },
        mounted(){
            axios
            .get("/api/customer")
            .then((response)=>{
                this.customers = response.data
            })
            .catch((error)=>{
                console.log(error);
            });
        },
    }
</script>
