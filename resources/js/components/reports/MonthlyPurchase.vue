<template>
    <div class="card-header">
        <h5 class="mb-0">Monthly Purchase</h5>
    </div>
    <div class="card-body">
        <form @submit.prevent="submit">
            <div class="row">
                <div class="col-md-2">
                    <label class="col-form-label">From Date</label>
                    <input type="date" v-model="fields.from_date" class="form-control from_date">
                </div>
                <div class="col-md-2">
                    <label class="col-form-label">To Date</label>
                    <input type="date" v-model="fields.to_date" class="form-control to_date">
                </div>
                <div class="col-md-2">
                    <input type="submit" value="Search" style="margin-top: 40px;" class="btn btn-info search">
                </div>
            </div>
        </form>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(purchase, index) in purchase_data" :key="purchase.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ purchase.unit_name }}</td>
                                        <td>{{ purchase.jl_no }}</td>
                                        <td>{{ purchase.jot_no }}</td>
                                        <td>{{ purchase.dag_no }}</td>
                                        <td>{{ purchase.plot_no }}</td>
                                        <td>{{ purchase.mowza_name }}</td>
                                        <td>{{ purchase.division_name }}</td>
                                        <td>{{ purchase.district_name }}</td>
                                        <td>{{ purchase.thana_name }}</td>
                                        <td>{{ purchase.union_name }}</td>
                                        <td>{{ purchase.cs }}</td>
                                        <td>{{ purchase.sa }}</td>
                                        <td>{{ purchase.rs }}</td>
                                        <td>{{ purchase.brs }}</td>
                                        <td>{{ purchase.type==0 ? 'Plot' : 'Land' }}</td>
                                        <td>{{ purchase.east }}</td>
                                        <td>{{ purchase.west }}</td>
                                        <td>{{ purchase.north }}</td>
                                        <td>{{ purchase.south }}</td>
                                        <td>{{ purchase.qty }}</td>
                                        <td>{{ purchase.unit_price }}</td>
                                        <td>{{ purchase.total_price }}</td>
                                        <td>{{ purchase.remaining_qty }}</td>

                                    </tr>
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
                    from_date : '',
                    to_date : '',
                },
                purchase_data : {},
            };
        },
        mounted(){

        },
        methods :{
            submit(){
                axios
                .post("/api/monthly_purchase", this.fields)
                .then((response)=>{
                    this.purchase_data = response.data;
                    console.log(this.purchase_data);
                })
                .catch((error)=>{
                    toastr.error('Something went wrong.');
                });
            },
        },
    }

</script>
