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

                                                        <select class="form-control" v-model="booking.customer" id="unit">
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
                                                        <input class="form-control text-right" type="number" v-model="booking.booked_amt" @keyup="getRemaningAmt(booking)">
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
                                    <button type='button' class="btn btn-info" @click="addNewRow">
                                        <i class="fas fa-plus-circle"></i>
                                        Add
                                    </button>
                                </div>
                                <div class="col mb-4 text-center">
                                    <button type='button' class="btn btn-success submit_btn invoice-save-bottom" @click="submit">
                                        <i class="far fa-save"></i>
                                        Save
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
                }],
                all_units : [],
                customers : [],
                errors : {},
            };
        },
        mounted(){
            this.getUnit();
            this.getCustomer();
        },
        methods :{
            submit(){
                axios
                .post("/api/booking/create",this.bookings)
                .then((response)=>{
                    this.$router.push('/booking');
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            getTotalPrice(booking){
                booking.total_price = booking.unit_price * booking.qty
            },
            getRemaningAmt(booking){
                booking.remaining_amt = booking.total_price - booking.booked_amt
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
                    this.customers = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            addNewRow() {
                console.log('addRow')
                this.bookings.push({
                    customer : '',
                    unit : '',
                    qty : '',
                    unit_price : '',
                    total_price : '',
                    booked_amt : '',
                    booked_date : '',
                    remaining_amt : '',
                });
            },
            deleteRow(index, booking) {
                var idx = this.bookings.indexOf(booking);
                console.log(idx, index);
                if (idx > -1) {
                    this.bookings.splice(idx, 1);
                }
            },
        },
    }
</script>
