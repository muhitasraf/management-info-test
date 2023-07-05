<template>
    <div class="card-header">
        <h5 class="mb-0">Create Collection</h5>
    </div>
    <div class="card-body">
        <router-link to="/collection">
            <button class="btn btn-sm btn-info">Collection List</button>
        </router-link>
        <div class="row">

            <div class="col-md-6 pt-4">

                <!-- Vertical form -->
                <div class="card">

                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="row g-3">
                                <div class="col">
                                    <label>Booking No</label>
                                    <select v-model="fields.booking_id" name="booking_id" class="form-select">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="booking in bookings" v-bind:value="booking.id">{{ booking.booking_no }}</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Registration No</label>
                                    <select v-model="fields.registration_id" name="booking_id" class="form-select">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="registration in registrations" v-bind:value="registration.id">{{ registration.registration_no }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col">
                                    <label>Month</label>
                                    <select class="form-select" v-model="fields.month">
                                        <option value='' disabled>--Select Month--</option>
                                        <option selected value='1'>Janaury</option>
                                        <option value='2'>February</option>
                                        <option value='3'>March</option>
                                        <option value='4'>April</option>
                                        <option value='5'>May</option>
                                        <option value='6'>June</option>
                                        <option value='7'>July</option>
                                        <option value='8'>August</option>
                                        <option value='9'>September</option>
                                        <option value='10'>October</option>
                                        <option value='11'>November</option>
                                        <option value='12'>December</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Year</label>
                                    <select class="form-select" id="year" v-model="fields.year">
                                        <option value="" disabled>Select Year</option>
                                        <option v-for="year in years" v-bind:value="year">{{ year }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Financial Year</label>
                                    <select class="form-select" id="financial_year" v-model="fields.financial_year">
                                        <option value="" disabled>Select Year</option>
                                        <option v-for="year in years" v-bind:value="year">{{ year }}</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Sales Man</label>
                                    <select v-model="fields.sales_man_id" name="sales_man_id" class="form-select">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="(sales_man, index) in all_sales_man" v-bind:value="sales_man.id">{{ sales_man.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Collection By</label>
                                    <select v-model="fields.collection_by" name="sales_man_id" class="form-select">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="(sales_man, index) in all_sales_man" v-bind:value="sales_man.id">{{ sales_man.name }}</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Collection Date</label>
                                    <input type="date" v-model="fields.collection_date" class="form-control" >
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
                    sales_man_id : '',
                    registration_id : '',
                    year : '',
                    financial_year : '',
                    month : '',
                    collection_by : '',
                },
                errors : {},
                bookings : [],
                all_sales_man : [],
                registrations : [],
                units : [],
                readonly : 'yes',
                years : [],
            };
        },
        mounted(){
            this.getBooking();
            this.getRegistration();
            this.getSalesMan();
            let currentYear = new Date().getFullYear();
            let earliestYear = 2002;
            let i = 0;
            while (currentYear >= earliestYear) {
                this.years[i] = currentYear;
                currentYear -= 1;
                i++;
            }
        },
        methods :{
            submit(){
                axios
                    .post("/api/collection/create", this.fields)
                    .then((response)=>{
                        this.fields = {};
                        this.errors = {};
                        this.$router.push('/collection');
                        toastr.success('Successfully Created.');
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
            getRegistration(){
                axios
                .get("/api/registration")
                .then((response)=>{
                    this.registrations = response.data;
                })
                .catch((error)=>{
                    console.log(error);
                });
            },

            getSalesMan(){
                axios
                    .get("/api/get_data/employee_info")
                    .then((response)=>{
                        this.all_sales_man = response.data;
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
            },

        },
    }

</script>
