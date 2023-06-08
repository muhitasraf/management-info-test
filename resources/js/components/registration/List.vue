<template>
    <div class="card-header">
        <h5 class="mb-0">Registration List</h5>
    </div>
    <div class="card-body">
        <router-link to="/registration/create">
            <button class="btn btn-sm btn-info">Create registration</button>
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
                                            <th scope="col">Booking ID</th>
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
                                            <th scope="col text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(registration, k) in registrations" :key="k">
                                            <td scope="row" class="trashIconContainer">
                                                {{ ++k }}
                                            </td>
                                            <td>
                                                {{ registration.customer }}
                                            </td>
                                            <td>
                                                {{ registration.booking_id }}
                                            </td>
                                            <td style="width: 10%;">
                                                {{ registration.unit }}
                                            </td>
                                            <td>
                                                {{ registration.qty }}
                                            </td>
                                            <td>
                                                {{ registration.unit_price }}
                                            </td>
                                            <td>
                                                {{ registration.total_price }}
                                            </td>
                                            <td>
                                                {{ registration.booked_amt }}
                                            </td>
                                            <td>
                                                {{ registration.down_payment }}
                                            </td>
                                            <td>
                                                {{ registration.remaining_amt }}
                                            </td>
                                            <td>
                                                {{ registration.installment }}
                                            </td>
                                            <td>
                                                {{ registration.no_of_install }}
                                            </td>
                                            <td>
                                                {{ registration.per_month_install }}
                                            </td>
                                            <td class="text-center">
                                                <router-link :to="'/registration/view/'+registration.id">
                                                    <button class="btn btn-sm btn-info mx-1 my-1"><i class="ph ph-eye"></i></button>
                                                </router-link>
                                                <router-link :to="'/registration/edit/'+registration.id">
                                                    <button class="btn btn-sm btn-info mx-1 my-1"><i class="ph ph-pencil"></i></button>
                                                </router-link>
                                                <button @click="deleteRegistration(registration.id)" class="btn btn-sm btn-danger"><i class="ph ph-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr v-show="registrations.length === 0">
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
                registrations : [],
                customers : [],
                errors : {},
                loading: false
            };
        },
        mounted(){
            this.getRegistration();
        },
        methods :{
            getRegistration(){
                this.loading = true
                axios
                .get("/api/registration")
                .then((response)=>{
                    this.registrations = response.data
                })
                .catch((error)=>{
                    console.log(error);
                }).finally(() => (this.loading = false));
            },
            deleteRegistration(registration_id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/registration/delete/"+registration_id)
                    .then((response)=>{
                        toastr.error('Successfully Deleted.');
                        this.getRegistration();
                    })
                    .catch((error)=>{
                        // console.log(error);
                        toastr.error('Something went wrong.');
                    });
                }
            },
        },
    }
</script>
