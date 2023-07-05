<template>
    <div class="card-header">
        <h5 class="mb-0">Create Sales</h5>
    </div>
    <div class="card-body">
        <router-link to="/sales">
            <button class="btn btn-sm btn-info">Sales List</button>
        </router-link>
        <div class="row">

            <div class="col-md-12 pt-4">

                <!-- Vertical form -->
                <div class="card">

                    <div class="card-body">
                        <form @submit.prevent="submit">

                            <div class="row">
                                <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                    <label class="col-form-label">Employee Name</label>
                                    <select class="form-select" v-model="fields.employee_id">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="employee in employees" v-bind:value="employee.id">{{ employee.name }}</option>
                                    </select>
                                </div>
                                <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                    <label class="col-form-label">Customer Name</label>
                                    <select class="form-select" v-model="fields.customer_id">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="customer in customers" v-bind:value="customer.id">{{ customer.name }}</option>
                                    </select>
                                </div>
                                <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                    <label class="col-form-label">Supplier Name</label>
                                    <select class="form-select" v-model="fields.supplier_id">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="supplier in suppliers" v-bind:value="supplier.id">{{ supplier.name }}</option>
                                    </select>
                                </div>
                                <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                    <label class="col-form-label">Booking No</label>
                                    <select class="form-select" v-model="fields.booking_id">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="booking in bookings" v-bind:value="booking.id">{{ booking.booking_no }}</option>
                                    </select>
                                </div>
                                <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                    <label class="col-form-label">Registration No</label>
                                    <select class="form-select" v-model="fields.registration_id">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="registration in registrations" v-bind:value="registration.id">{{ registration.registration_no }}</option>
                                    </select>
                                </div>
                                <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                    <label class="col-form-label">Sales Date</label>
                                    <input type="date" v-model="fields.sales_date" class="form-control">
                                    <input type="hidden" v-model="fields.tran_id" class="form-control">
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-xl col-lg-3 col-md-4 col-sm-12">

                                    <label class="col-form-label">Units</label>
                                    <select class="form-select" v-model="fields.unit_id" name="unit_id">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="unit in units" v-bind:value="unit.id">{{ unit.name }}</option>
                                    </select>

                                    <label class="col-form-label">JL No</label>
                                    <input type="text" v-model="fields.jl_no" class="form-control" placeholder="JL No">

                                    <label class="col-form-label">JOT No</label>
                                    <input type="text" v-model="fields.jot_no" class="form-control" placeholder="JOT No">

                                    <label class="col-form-label">Dag No</label>
                                    <input type="text" v-model="fields.dag_no" class="form-control" placeholder="Dag No">

                                    <label class="col-form-label">Plot No</label>
                                    <input type="text" v-model="fields.plot_no" class="form-control" placeholder="Plot No">

                                </div>

                                <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                    <label class="col-form-label">Mowja</label>
                                    <select v-model="fields.mowza_id" name="sales_man_id" class="form-select">
                                        <option value="" disabled>Please select one</option>
                                        <option v-for="(mowza, index) in mowzas" v-bind:value="mowza.id">{{ mowza.mowza_name }}</option>
                                    </select>

                                    <label for="division_id" class="col-form-label">Division:</label>
                                    <select v-model="fields.division_id" @change="getDistrict($event.target.value)" class="form-control division_id" id="division_id">
                                        <option disabled value="">Select Division</option>
                                        <option v-for="division in divisions" v-bind:value="division.id">{{ division.name }}</option>
                                    </select>

                                    <label for="district_id" class="col-form-label">District:</label>
                                    <select v-model="fields.district_id" @change="getThana($event.target.value)" class="form-control district_id" id="district_id">
                                        <option disabled value="">Select District</option>
                                        <option v-for="district in districts" v-bind:value="district.id">{{ district.name }}</option>
                                    </select>

                                    <label for="thana_id" class="col-form-label">Thana:</label>
                                    <select v-model="fields.thana_id" @change="getUnion($event.target.value)" class="form-control thana_id" id="thana_id">
                                        <option disabled value="">Select Thana</option>
                                        <option v-for="thana in thanas" v-bind:value="thana.id">{{ thana.name }}</option>
                                    </select>

                                    <label for="union_id" class="col-form-label">Union:</label>
                                    <select v-model="fields.union_id" class="form-control union_id" id="union_id">
                                        <option disabled value="">Select Union</option>
                                        <option v-for="union in unions" v-bind:value="union.id">{{ union.name }}</option>
                                    </select>
                                </div>

                                <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                    <label class="col-form-label">CS</label>
                                    <input type="text" v-model="fields.cs" class="form-control" placeholder="CS No">

                                    <label class="col-form-label">SA No</label>
                                    <input type="text" v-model="fields.sa" class="form-control" placeholder="SA No">

                                    <label class="col-form-label">RS No</label>
                                    <input type="text" v-model="fields.rs" class="form-control" placeholder="RS No">

                                    <label class="col-form-label">BRS No</label>
                                    <input type="text" v-model="fields.brs" class="form-control" placeholder="BRS No">

                                    <label class="col-form-label">Type</label>
                                    <select v-model="fields.type_id" class="form-control union_id" id="union_id">
                                        <option disabled value="">Select Type</option>
                                        <option value="0">Land</option>
                                        <option value="1">Plot</option>
                                    </select>
                                </div>

                                <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                    <label class="col-form-label">East</label>
                                    <input type="text" v-model="fields.east" class="form-control" placeholder="east">

                                    <label class="col-form-label">West</label>
                                    <input type="text" v-model="fields.west" class="form-control" placeholder="west">

                                    <label class="col-form-label">North</label>
                                    <input type="text" v-model="fields.north" class="form-control" placeholder="north">

                                    <label class="col-form-label">South</label>
                                    <input type="text" v-model="fields.south" class="form-control" placeholder="south">
                                </div>

                                <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                    <label class="col-form-label">Qty</label>
                                    <input type="text" v-model="fields.qty" class="form-control" placeholder="qty">

                                    <label class="col-form-label">Unit Price</label>
                                    <input type="text" v-model="fields.unit_price" class="form-control" placeholder="unit price">

                                    <label class="col-form-label">Total Price</label>
                                    <input type="text" v-model="fields.total_price" class="form-control" placeholder="total price">

                                    <label class="col-form-label">Remaining Qty</label>
                                    <input type="text" v-model="fields.remaining_qty" class="form-control" placeholder="remaining qty">
                                </div>
                            </div>

                            <div class="row">
                                <span v-if="errors.supplier_name">{{ errors.supplier_name }}</span>
                                <div class="col-md-12 text-right pt-2">
                                    <button type="submit" class="btn btn-primary float-right">Update</button>
                                </div>
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
                    unit_id : '',
                    division_id: '',
                    district_id: '',
                    thana_id: '',
                    union_id: '',
                    mowza_id : '',
                    type_id : '',
                    employee_id : '',
                    customer_id : '',
                    supplier_id : '',
                    booking_id : '',
                    registration_id : '',
                },
                errors : {},
                bookings : {},
                registrations : {},
                units : {},
                readonly : 'yes',
                years : {},
                mowzas : {},
                'divisions' : {},
                'districts' : {},
                'thanas' : {},
                'unions' : {},
                employees : {},
                customers : {},
                suppliers : {},
            };
        },
        created(){
            this.getUnit();
            this.getMowza();
            this.getDivision();
            this.getEmployee();
            this.getCustomer();
            this.getSupplier();
            this.getBooking();
            this.getRegistration();
            this.getSales();
        },
        mounted(){

        },
        methods :{
            submit(){
                axios
                .post("/api/sales/update/"+this.$route.params.id, this.fields)
                .then((response)=>{
                    this.fields = {};
                    this.errors = {};
                    this.$router.push('/sales');
                    toastr.success('Successfully Updated.');
                })
                .catch((error)=>{
                    toastr.error('Something went wrong.');
                });
            },
            getSales(){
                axios
                .get("/api/sales/edit/"+this.$route.params.id)
                .then((response)=>{
                    this.sales_data = response.data;

                    this.fields.employee_id = this.sales_data.emp_id;
                    this.fields.customer_id = this.sales_data.customer;
                    this.fields.supplier_id = this.sales_data.supplier;
                    this.fields.booking_id = this.sales_data.booking_id;
                    this.fields.registration_id = this.sales_data.registration_id;
                    this.fields.sales_date = this.sales_data.tran_date;
                    this.fields.tran_id = this.sales_data.tran_id;

                    this.fields.unit_id = this.sales_data.unit;
                    this.fields.jl_no = this.sales_data.jl_no;
                    this.fields.jot_no = this.sales_data.jot_no;
                    this.fields.dag_no = this.sales_data.dag_no;
                    this.fields.plot_no = this.sales_data.plot_no;
                    this.fields.mowza_id = this.sales_data.mowja;
                    this.fields.division_id = this.sales_data.division;
                    this.fields.district_id = this.sales_data.district;
                    this.fields.thana_id = this.sales_data.thana;
                    this.fields.union_id = this.sales_data.union;
                    this.fields.cs = this.sales_data.cs;
                    this.fields.sa = this.sales_data.sa;
                    this.fields.rs = this.sales_data.rs;
                    this.fields.brs = this.sales_data.brs;
                    this.fields.type_id = this.sales_data.type;
                    this.fields.east = this.sales_data.east;
                    this.fields.west = this.sales_data.west;
                    this.fields.north = this.sales_data.north;
                    this.fields.south = this.sales_data.south;
                    this.fields.qty = this.sales_data.qty;
                    this.fields.unit_price = this.sales_data.unit_price;
                    this.fields.total_price = this.sales_data.total_price;
                    this.fields.remaining_qty = this.sales_data.remaining_qty;

                    this.getDistrict(this.fields.division_id);
                    this.getThana(this.fields.district_id);
                    this.getUnion(this.fields.thana_id);
                })
                .catch((error)=>{
                    toastr.error('Something went wrong.');
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
            getMowza(){
                axios
                .get("/api/mowza")
                .then((response)=>{
                    this.mowzas = response.data
                    console.log(response.data)
                })
                .catch((error)=>{
                    console.log(error);
                    // toastr.error('Something went wrong.');
                });
            },

            getDivision(){
                axios
                .get("/api/get_data/divisions")
                .then((response)=>{
                    this.divisions = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },

            getDistrict(id){
                axios
                .get("/api/get_data/districts/division_id/"+id)
                .then((response)=>{
                    this.districts = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },

            getThana(id){
                axios
                .get("/api/get_data/thanas/district_id/"+id)
                .then((response)=>{
                    this.thanas = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },

            getUnion(id){
                axios
                .get("/api/get_data/unions/thana_id/"+id)
                .then((response)=>{
                    this.unions = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            getEmployee(){
                // this.loading = true
                axios
                .get("/api/employee")
                .then((response)=>{
                    this.employees = response.data
                })
                .catch((error)=>{
                    console.log(error);
                })
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
            getSupplier(){
                axios
                .get("/api/supplier")
                .then((response)=>{
                    this.suppliers = response.data
                })
                .catch((error)=>{
                    console.log(error);
                });
            },

        },
    }

</script>
