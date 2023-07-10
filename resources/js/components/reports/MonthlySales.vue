<template>
    <div class="card-header">
        <h5 class="mb-0">Monthly sales</h5>
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
                                    <tr v-for="(sales, index) in sales_data" :key="sales.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ sales.unit_name }}</td>
                                        <td>{{ sales.jl_no }}</td>
                                        <td>{{ sales.jot_no }}</td>
                                        <td>{{ sales.dag_no }}</td>
                                        <td>{{ sales.plot_no }}</td>
                                        <td>{{ sales.mowza_name }}</td>
                                        <td>{{ sales.division_name }}</td>
                                        <td>{{ sales.district_name }}</td>
                                        <td>{{ sales.thana_name }}</td>
                                        <td>{{ sales.union_name }}</td>
                                        <td>{{ sales.cs }}</td>
                                        <td>{{ sales.sa }}</td>
                                        <td>{{ sales.rs }}</td>
                                        <td>{{ sales.brs }}</td>
                                        <td>{{ sales.type==0 ? 'Plot' : 'Land' }}</td>
                                        <td>{{ sales.east }}</td>
                                        <td>{{ sales.west }}</td>
                                        <td>{{ sales.north }}</td>
                                        <td>{{ sales.south }}</td>
                                        <td>{{ sales.qty }}</td>
                                        <td>{{ sales.unit_price }}</td>
                                        <td>{{ sales.total_price }}</td>
                                        <td>{{ sales.remaining_qty }}</td>

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
                sales_data : {},
            };
        },
        mounted(){

        },
        methods :{
            submit(){
                axios
                .post("/api/monthly_sales", this.fields)
                .then((response)=>{
                    this.sales_data = response.data;
                    console.log(this.sales_data);
                })
                .catch((error)=>{
                    toastr.error('Something went wrong.');
                });
            },
        },
    }

</script>
