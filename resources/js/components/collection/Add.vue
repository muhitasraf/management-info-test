<template>
    <div class="card-header">
        <h5 class="mb-0">Create Collection</h5>
    </div>
    <div class="card-body">
        <router-link to="/supplier">
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
                                    <select class="form-select" id='month'>
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
                                <label>Financial Year</label>
                                    <select class="form-select" id="financial_year" v-model="fields.financial_year">
                                        <option value="" disabled>Select Year</option>
                                        <option v-for="year in years" v-bind:value="year">{{ year }}</option>
                                    </select>
                                <div class="col">
                                    <label>Mobile Home</label>
                                    <input type="text" v-model="fields.mobile" class="form-control" placeholder="Mobile Home" aria-label="Mobile Home">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Mobile Office</label>
                                    <input type="text" v-model="fields.mobile_1" class="form-control" placeholder="Mobile Office" aria-label="Mobile Office">
                                </div>
                                <div class="col">
                                    <label>Date of Birth</label>
                                    <input type="date" v-model="fields.DOB" class="form-control" >
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Father</label>
                                    <input type="text" v-model="fields.father" class="form-control" placeholder="Mobile Office" aria-label="Mobile Office">
                                </div>
                                <div class="col">
                                    <label>Mother</label>
                                    <input type="text" v-model="fields.mother" class="form-control" placeholder="Mother" aria-label="Mother">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Spous</label>
                                    <input type="text" v-model="fields.spouse" class="form-control" placeholder="Spouse" aria-label="Spous">
                                </div>
                                <div class="col">
                                    <label>No of child</label>
                                    <input type="text" v-model="fields.no_of_child" class="form-control" placeholder="No Of Child">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Occupation</label>
                                    <input type="text" v-model="fields.occupation" class="form-control" placeholder="Spous" aria-label="Spous">
                                </div>
                                <div class="col">
                                    <label>Is Alive</label>
                                    <select v-model="fields.is_alive" name="is_alive" class="form-select">
                                        <option value="" disabled>Please select one</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
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
                    registration_id : '',
                    year : '',
                    financial_year : ''
                },
                errors : {},
                bookings : [],
                customers : [],
                registrations : [],
                units : [],
                readonly : 'yes',
                years : [],
            };
        },
        mounted(){
            this.getBooking();
            this.getRegistration();
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
                    .post("/api/supplier/create", this.fields)
                    .then((response)=>{
                        this.fields = {};
                        this.errors = {};
                        this.$router.push('/supplier');
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
        },
    }

</script>
