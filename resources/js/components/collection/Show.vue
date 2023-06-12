<template>
    <div class="card-header">
        <h5 class="mb-0">Single Collection</h5>
    </div>
    <div class="card-body">
        <router-link to="/collection">
            <button class="btn btn-sm btn-info mx-1">Collection List</button>
        </router-link>
        <router-link to="/collection/create">
            <button class="btn btn-sm btn-info">Create Collection</button>
        </router-link>
        <div class="table-responsive mt-2">
            <p>Booking No : {{ collection.booking_no }}</p>
            <p>Registration : {{ collection.registration_no }}</p>
            <p>Month : {{ collection.month }}</p>
            <p>Year : {{ collection.year }}</p>
            <p>Financial Year : {{ collection.financial_year }}</p>
            <p>Sales Man : {{ collection.sales_man }}</p>
            <p>Collection By : {{ collection.collection_by }}</p>
            <p>Collection Date : {{ collection.collection_date }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                'collection' : [],
            };
        },
        mounted(){
            axios
            .get("/api/collection/view/"+this.$route.params.id)
            .then((response)=>{
                this.collection = response.data
            })
            .catch((error)=>{
                console.log(error);
            });
        },
    }
</script>
