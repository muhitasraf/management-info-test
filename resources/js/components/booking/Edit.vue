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
                        <form @submit.prevent="submit">
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
                                                        <select class="form-control" v-model="bookings.customer" id="customer">
                                                            <option value="">Select Unit</option>
                                                            <option v-for="customers in all_customers" v-bind:value="customers.id">{{ customers.name }}</option>
                                                        </select>
                                                    </td>
                                                    <td style="width: 10%;">
                                                        <select class="form-control" v-model="bookings.unit" id="unit">
                                                            <option value="">Select Unit</option>
                                                            <option v-for="units in all_units" v-bind:value="units.id">{{ units.name }}</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input class="form-control text-right" type="number" v-model="bookings.qty" @keyup="getTotalPrice($event.target.value)">
                                                    </td>
                                                    <td>
                                                        <input class="form-control text-right" type="number" v-model="bookings.unit_price" @keyup="getTotalPrice($event.target.value)">
                                                    </td>
                                                    <td>
                                                        <input readonly class="form-control text-right" type="number" v-model="bookings.total_price" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control text-right" type="number" v-model="bookings.booked_amt" @keyup="getRemaningAmt($event.target.value)">
                                                    </td>
                                                    <td>
                                                        <input class="form-control text-right" type="date" v-model="bookings.booked_date">
                                                    </td>
                                                    <td>
                                                        <input readonly class="form-control text-right" type="number" v-model="bookings.remaining_amt" >
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="col mb-4 text-center pt-3">
                                    <button type='button' class="btn btn-success submit_btn invoice-save-bottom" @click="submit">
                                        <i class="far fa-save"></i> Update
                                    </button>
                                </div>
                            </div>
                        </form>
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
                bookings : {
                    customer : '',
                    unit : '',
                    // qty : '',
                    // unit_price : '',
                    // total_price : '',
                    // booked_amt : '',
                    // booked_date : '',
                    // remaining_amt : '',
                },
                all_units : [],
                all_customers : [],
                errors : {},
            };
        },
        mounted(){
            this.getUnit();
            this.getCustomer();
            this.booking_id = this.$route.params.id ?? ''
            axios
            .get("/api/booking/edit/"+this.booking_id)
            .then((response)=>{

                this.bookings.customer = response.data.customer
                this.bookings.unit = response.data.unit
                this.bookings.qty = response.data.qty
                this.bookings.unit_price = response.data.unit_price
                this.bookings.total_price = response.data.total_price
                this.bookings.booked_amt = response.data.booked_amt
                this.bookings.booked_date = response.data.booked_date
                this.bookings.remaining_amt = response.data.remaining_amt

            })
            .catch((error)=>{
                console.log(error);
            });
        },
        methods :{
            submit(){
                console.log(this.bookings);
                this.booking_id = this.$route.params.id ?? ''
                axios
                .post("/api/booking/update/"+this.booking_id,this.bookings)
                .then((response)=>{
                    this.$router.push('/booking');
                    toastr.success('Successfully Updated.');
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            getTotalPrice(){
                this.bookings.total_price = this.bookings.unit_price * this.bookings.qty
            },
            getRemaningAmt(){
                this.bookings.remaining_amt = this.bookings.total_price - this.bookings.booked_amt
            },
            getUnit(){
                axios
                .get("/api/unit")
                .then((response)=>{
                    this.all_units = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            getCustomer(){
                axios
                .get("/api/customer")
                .then((response)=>{
                    this.all_customers = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
        },
    }
</script>
