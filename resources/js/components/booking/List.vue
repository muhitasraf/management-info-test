<template>
    <div class="card-header">
        <h5 class="mb-0">Booking List</h5>
    </div>
    <div class="card-body">
        <router-link to="/booking/create">
            <button class="btn btn-sm btn-info">Create Booking</button>
        </router-link>
        <div class="row">

            <div class="col-md-12 pt-4">

                <!-- Vertical form -->
                <div class="card">

                    <div class="card-body">
                        <div v-if="loading" class="text-center">
                            <div style="width: 50px;height: 50px;" class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div v-else>
                            <div class="table-responsive">
                                <table class="table table-success table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col text-right">Quantity</th>
                                            <th scope="col text-right">Unit Price</th>
                                            <th scope="col text-right">Total Price</th>
                                            <th scope="col text-right">Booked Amount</th>
                                            <th scope="col text-right">Booked Date</th>
                                            <th scope="col text-right">Remaining Amount</th>
                                            <th scope="col text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(booking, k) in all_booking" :key="k">
                                            <td scope="row" class="trashIconContainer">
                                                {{ ++k }}
                                            </td>
                                            <td>
                                                {{ booking.customer_name }}
                                            </td>
                                            <td style="width: 10%;">
                                                {{ booking.unit_name }}
                                            </td>
                                            <td>
                                                {{ booking.qty }}
                                            </td>
                                            <td>
                                                {{ booking.unit_price }}
                                            </td>
                                            <td>
                                                {{ booking.total_price }}
                                            </td>
                                            <td>
                                                {{ booking.booked_amt }}
                                            </td>
                                            <td>
                                                {{ booking.booked_date }}
                                            </td>
                                            <td>
                                                {{ booking.remaining_amt }}
                                            </td>
                                            <td>
                                                <td class="text-center">
                                                    <router-link :to="'/booking/view/'+booking.id">
                                                        <button class="btn btn-sm btn-info mx-1 my-1"><i class="ph ph-eye"></i></button>
                                                    </router-link>
                                                    <router-link :to="'/booking/edit/'+booking.id">
                                                        <button class="btn btn-sm btn-info mx-1 my-1"><i class="ph ph-pencil"></i></button>
                                                    </router-link>
                                                    <button @click="deleteBooking(booking.id)" class="btn btn-sm btn-danger"><i class="ph ph-trash"></i></button>
                                                </td>
                                            </td>
                                        </tr>
                                        <tr v-show="all_booking.length === 0">
                                            <td colspan="9">
                                                <p class="text-center alert alert-danger">
                                                    <span style="font-size: 20px;"><b> No data available.</b></span>
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data() {
            return {
                all_booking : [],
                customers : [],
                errors : {},
                loading: false
            };
        },
        mounted(){
            this.getBooking();
        },
        methods :{
            getBooking(){
                this.loading = true
                axios
                .get("/api/booking")
                .then((response)=>{
                    this.all_booking = response.data
                })
                .catch((error)=>{
                    console.log(error);
                }).finally(() => (this.loading = false));
            },
            deleteBooking(booking_id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/booking/delete/"+booking_id)
                    .then((response)=>{
                        this.getBooking();
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
        },
    }
</script>
