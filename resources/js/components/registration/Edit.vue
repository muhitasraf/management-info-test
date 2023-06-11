<template>
    <div class="card-header">
        <h5 class="mb-0">Create Registration</h5>
    </div>
    <div class="card-body">
        <router-link to="/registration">
            <button class="btn btn-sm btn-info">Registration List</button>
        </router-link>
        <div class="row">

            <div class="col-md-12 pt-4">

                <!-- Vertical form -->
                <div class="card">

                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="row mb-3">
                                <div class="col">
                                    <label>Booking ID</label>
                                    <select v-model="fields.booking_id" name="booking_id" class="form-select">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="booking in bookings" v-bind:value="booking.id">{{ booking.booking_no }}</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Customer</label>
                                    <select v-model="fields.customer_id" name="customer_id" class="form-select">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="customer in customers" v-bind:value="customer.id">{{ customer.name }}</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Registration Date</label>
                                    <input type="date" v-model="fields.registration_date" class="form-control" placeholder="registration date">
                                </div>
                                <div class="col">
                                    <label>Pay install date</label>
                                    <input type="date" v-model="fields.pay_install_date" class="form-control" placeholder="Pay install date">
                                </div>

                            </div>

                            <div class="row gy-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col text-right">Booked Amount</th>
                                                <th scope="col text-right">Down Payment</th>
                                                <th scope="col text-right">Remaining Amount</th>
                                                <th scope="col text-right">Installment</th>
                                                <th scope="col text-right">No of install</th>
                                                <th scope="col text-right">Per month install</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select v-model="fields.unit_id" name="unit_id" class="form-select" style="width: 105px !important;">
                                                        <option value="" disabled>Please select one</option>
                                                        <option v-for="unit in units" v-bind:value="unit.id">{{ unit.name }}</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control text-right" style="width: 105px !important;" v-model="fields.qty" @keyup="getTotalPrice()">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control text-right" style="width: 105px !important;" v-model="fields.unit_price" @keyup="getTotalPrice()">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control text-right" style="width: 105px !important;" v-model="fields.total_price" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control text-right" style="width: 105px !important;" v-model="fields.booked_amt" @keyup="getTotalPrice()" :readonly="readonly === 'yes'">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" style="width: 105px !important;" v-model="fields.down_payment" @keyup="getTotalPrice()">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" style="width: 105px !important;" v-model="fields.remaining_amt" placeholder="remaining amt" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" style="width: 105px !important;" v-model="fields.installment" placeholder="Installment">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" style="width: 105px !important;" v-model="fields.no_of_install" placeholder="No Of install" @keyup="getTotalPrice()">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" style="width: 105px !important;" v-model="fields.per_month_install" placeholder="Per month install">
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <span v-if="errors.supplier_name">{{ errors.supplier_name }}</span>
                            <div class="text-right pt-1">
                                <button type="submit" class="btn btn-primary">Insert<i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /vertical form -->

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</template>

<style>

</style>

<script>
    export default{
        data() {
            return {
                fields : {
                    booking_id : '',
                    customer_id : '',
                    unit_id : '',
                    qty : '',
                    unit_price : '',
                    total_price : '',
                    booked_amt : '',
                    remaining_amt : '',
                    down_payment : '',
                    installment : '',
                    per_month_install : '',
                    no_of_install : '',
                    registration_date : '',
                    pay_install_date : '',
                },
                errors : {},
                bookings : [],
                customers : [],
                units : [],
                readonly : 'yes',
            };
        },
        mounted(){
            this.getBooking();
            this.getCustomer();
            this.getUnit();
            axios
            .get("/api/registration/edit/"+this.$route.params.id)
            .then((response)=>{

                this.fields.customer_id = response.data.customer
                this.fields.booking_id = response.data.booking_id
                this.fields.unit_id = response.data.unit
                this.fields.qty = response.data.qty
                this.fields.unit_price = response.data.unit_price
                this.fields.total_price = response.data.total_price
                this.fields.booked_amt = response.data.booked_amt
                this.fields.down_payment = response.data.down_payment
                this.fields.remaining_amt = response.data.remaining_amt
                this.fields.installment = response.data.installment
                this.fields.no_of_install = response.data.no_of_install
                this.fields.registration_date = response.data.registration_date
                this.fields.pay_install_date = response.data.pay_install_date
                this.fields.per_month_install = response.data.per_month_install
            })
            .catch((error)=>{
                console.log(error);
            });
        },
        methods :{
            submit(){
                axios
                    .post("/api/registration/update/"+this.$route.params.id, this.fields)
                    .then((response)=>{
                        this.fields = {};
                        this.errors = {};
                        this.$router.push('/registration');
                        toastr.success('Successfully Deleted.');
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
            },

            getBooking(){
                axios
                    .get("/api/booking")
                    .then((response)=>{
                        this.bookings = response.data;
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

            getUnit(){
                axios
                    .get("/api/unit")
                    .then((response)=>{
                        this.units = response.data;
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
            },

            getTotalPrice(){
                console.log('here');
                this.fields.total_price = this.fields.unit_price * this.fields.qty;
                if(this.fields.qty != '' && this.fields.unit_price != ''){
                    this.fields.remaining_amt = this.fields.booked_amt == '' ? (this.fields.total_price - this.fields.down_payment) : ( this.fields.total_price - (this.fields.booked_amt + this.fields.down_payment));
                    this.fields.installment = this.fields.total_price - this.fields.booked_amt;
                    // console.log("installment="+this.fields.installment +"= no_of_install="+ this.fields.no_of_install);
                    this.fields.per_month_install = this.fields.no_of_install > 0 ? (this.fields.installment / this.fields.no_of_install) : '';
                    this.readonly = 'no';
                }else{
                    this.fields.remaining_amt  = '';
                    this.readonly = 'yes';
                }
            },

        },
    }
</script>
