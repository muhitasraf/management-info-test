<template>
    <div class="card-header">
        <h5 class="mb-0">Create Booking</h5>
    </div>
    <div class="card-body">
        <router-link to="/booking">
            <button class="btn btn-sm btn-info">Booking List</button>
        </router-link>
        <div class="row">

            <div class="col-md-12 pt-4">

                <!-- Vertical form -->
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col text-right">Quantity</th>
                                                <th scope="col text-right">Unit Price</th>
                                                <th scope="col text-right">Total Price</th>
                                                <th scope="col text-right">Booked Amount</th>
                                                <th scope="col text-right">Booked Date</th>
                                                <th scope="col text-right">Remaining Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    {{ all_customers.customer_name }}
                                                </td>
                                                <td style="width: 10%;">
                                                    {{ all_customers.unit_name }}
                                                </td>
                                                <td>
                                                    {{ all_customers.qty }}
                                                </td>
                                                <td>
                                                    {{ all_customers.unit_price }}
                                                </td>
                                                <td>
                                                    {{ all_customers.total_price }}
                                                </td>
                                                <td>
                                                    {{ all_customers.booked_amt }}
                                                </td>
                                                <td>
                                                    {{ all_customers.booked_date }}
                                                </td>
                                                <td>
                                                    {{ all_customers.remaining_amt }}
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
    </div>
</template>

<script>
    export default{
        data() {
            return {
                all_customers : '',
            };
        },
        mounted(){
            this.booking_id = this.$route.params.id ?? ''
            axios
            .get("/api/booking/view/"+this.booking_id)
            .then((response)=>{
                this.all_customers = response.data[0]
            })
            .catch((error)=>{
                console.log(error);
            });
        },
        methods :{

        },
    }
</script>
