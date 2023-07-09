<template>
    <div class="card-header">
        <h5 class="mb-0">Monthly Purchase</h5>
    </div>
    <div class="card-body">
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
                <label class="col-form-label">Purchase Date</label>
                <input type="text" class="form-control from_month">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-2">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Unit</th>
                                        <th>JL No</th>
                                        <th>Jot No</th>
                                        <th>Dag No</th>
                                        <th>Plot No</th>
                                        <th>Mowza</th>
                                        <th>Division</th>
                                        <th>District</th>
                                        <th>Thana</th>
                                        <th>Union</th>
                                        <th>CS</th>
                                        <th>SA</th>
                                        <th>RS</th>
                                        <th>BRS</th>
                                        <th>Type</th>
                                        <th>East</th>
                                        <th>West</th>
                                        <th>North</th>
                                        <th>South</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                        <th>Remaining Qty</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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
                fields : {

                },
            };
        },
        mounted(){

        },
        methods :{
            submit(){
                axios
                .post("/api/monthly_purchase", this.fields)
                .then((response)=>{

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
                        // console.log(error);
                    });
            },
            getRegistration(){
                axios
                .get("/api/registration")
                .then((response)=>{
                    this.registrations = response.data;
                })
                .catch((error)=>{
                    // console.log(error);
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
                    // console.log(error);
                })
            },
            getCustomer(){
                axios
                .get("/api/customer")
                .then((response)=>{
                    this.customers = response.data
                })
                .catch((error)=>{
                    // console.log(error);
                });
            },
            getSupplier(){
                axios
                .get("/api/supplier")
                .then((response)=>{
                    this.suppliers = response.data
                })
                .catch((error)=>{
                    // console.log(error);
                });
            },

        },
    }

</script>
