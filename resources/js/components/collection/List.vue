<template>
    <div class="card-header">
        <h5 class="mb-0">Create collection</h5>
    </div>
    <div class="card-body">
        <router-link to="/collection/create">
            <button class="btn btn-sm btn-info">Create collection</button>
        </router-link>
        <div class="table-responsive mt-2">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Booking No</th>
                        <th>Registration No</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Financial Year</th>
                        <th>Sales Man</th>
                        <th>Collection By</th>
                        <th>Collection Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(collection, index) in collections" :key="collection.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ collection.booking_no }}</td>
                        <td>{{ collection.registration_no }}</td>
                        <td>{{ $getMonthName(collection.month) }}</td>
                        <td>{{ collection.year }}</td>
                        <td>{{ collection.financial_year }}</td>
                        <td>{{ collection.sales_man }}</td>
                        <td>{{ collection.collection_by }}</td>
                        <td>{{ collection.collection_date }}</td>
                        <td class="text-center">
                            <router-link :to="'/collection/view/'+collection.id">
                                <button class="btn btn-sm btn-info mx-1 my-1"><i class="ph ph-eye"></i></button>
                            </router-link>
                            <router-link :to="'/collection/edit/'+collection.id">
                                <button class="btn btn-sm btn-info mx-1 my-1"><i class="ph ph-pencil"></i></button>
                            </router-link>
                            <button @click="deleteCollection(collection.id)" class="btn btn-sm btn-danger"><i class="ph ph-trash"></i></button>
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
                'collections' : [],
            };
        },
        mounted(){
            this.getCollection();
        },
        methods : {
            getCollection(){
                axios
                .get("/api/collection")
                .then((response)=>{
                    this.collections = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            deleteCollection(collection_id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/collection/delete/"+collection_id)
                    .then((response)=>{
                        this.getCollection();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
        }
    }
</script>
