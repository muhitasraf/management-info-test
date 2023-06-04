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
                                                    <th scope="col">#</th>
                                                    <th scope="col">Bookimg No</th>
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
                                                <tr v-for="(booking, k) in bookings" :key="k">
                                                    <td scope="row" class="trashIconContainer">
                                                        <i class="ph ph-trash" @click="deleteRow(k, booking)"></i>
                                                    </td>
                                                    <td>
                                                        <input class="form-control text-right" type="text" v-bind:value="bookings.booking_no">
                                                    </td>
                                                    <td>
                                                        <select class="form-control" v-model="booking.customer" id="customer">
                                                            <option value="">Select Unit</option>
                                                            <option v-for="customer in customers" v-bind:value="customer.id">{{ customer.name }}</option>
                                                        </select>
                                                    </td>
                                                    <td style="width: 10%;">
                                                        <select class="form-control" v-model="booking.unit" id="unit">
                                                            <option value="">Select Unit</option>
                                                            <option v-for="units in all_units" v-bind:value="units.id">{{ units.name }}</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input class="form-control text-right" type="number" v-model="booking.qty" @keyup="getTotalPrice(booking)">
                                                    </td>
                                                    <td>
                                                        <input class="form-control text-right" type="number" v-model="booking.unit_price" @keyup="getTotalPrice(booking)">
                                                    </td>
                                                    <td>
                                                        <input readonly class="form-control text-right" type="number" v-model="booking.total_price" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control text-right" type="number" v-model="booking.booked_amt" @keyup="getTotalPrice(booking)" :readonly="readonly === 'yes'">
                                                    </td>
                                                    <td>
                                                        <input class="form-control text-right" type="date" v-model="booking.booked_date">
                                                    </td>
                                                    <td>
                                                        <input readonly class="form-control text-right" type="number" v-model="booking.remaining_amt" >
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12 mb-2 mt-2">
                                    <button type='button' class="btn btn-info" @click="addNewRow()">
                                        <i class="fas fa-plus-circle"></i> Add
                                    </button>
                                </div>
                                <div class="col mb-4 text-center">
                                    <button type='button' class="btn btn-success submit_btn invoice-save-bottom" @click="submit">
                                        <i class="far fa-save"></i> Save
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
                bookings : [{
                    customer : '',
                    unit : '',
                    qty : '',
                    unit_price : '',
                    total_price : '',
                    booked_amt : '',
                    booked_date : '',
                    remaining_amt : '',
                    booking_no : '',
                }],
                all_units : [],
                customers : [],
                errors : {},
                readonly : 'yes',
            };
        },
        mounted(){
            this.getUnit();
            this.getCustomer();
            this.getBookingNo();
        },
        methods :{
            submit(){
                axios
                .post("/api/booking/create",this.bookings.array)
                .then((response)=>{
                    this.$router.push('/booking');
                    toastr.success('Successfully Created.');
                })
                .catch((error)=>{
                    // console.log(error);
                    toastr.error('Something went wrong.');
                });
            },
            getTotalPrice(booking){
                booking.total_price = booking.unit_price * booking.qty;
                if(booking.qty != '' && booking.unit_price != ''){
                    booking.remaining_amt = booking.booked_amt == '' ? booking.total_price : ( booking.total_price - booking.booked_amt);
                    this.readonly = 'no';
                }else{
                    booking.remaining_amt  = '';
                    this.readonly = 'yes';
                }
            },

            getUnit(){
                axios
                .get("/api/unit")
                .then((response)=>{
                    this.all_units = response.data;
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            getCustomer(){
                axios
                .get("/api/customer")
                .then((response)=>{
                    this.customers = response.data;
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            addNewRow() {
                // let book_first_str = this.bookings.booking_no.substring(0, 9);
                // let book_second_str =  this.bookings.booking_no.substring(10, 17);
                // let booking_num = book_first_str+book_second_str;
                // this.bookings.booking_no = parseFloat(this.bookings.booking_no) +1;

                this.bookings.push({
                    customer : '',
                    unit : '',
                    qty : '',
                    unit_price : '',
                    total_price : '',
                    booked_amt : '',
                    booked_date : '',
                    remaining_amt : '',
                    booking_no : '',
                });
            },
            deleteRow(index, booking) {
                var idx = this.bookings.indexOf(booking);
                if (idx > -1) {
                    this.bookings.splice(idx, 1);
                }
            },

            getBookingNo(){
                axios
                .get("/api/booking_no")
                .then((response)=>{
                    this.bookings.booking_no = response.data;
                    console.log(this.bookings.booking_no);
                })
                .catch((error)=>{
                    console.log(error);
                });
            },

        },
    }
</script>
