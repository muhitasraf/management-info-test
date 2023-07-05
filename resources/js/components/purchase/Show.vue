<template>
    <div class="card-header">
        <h5 class="mb-0">Create Purchase</h5>
    </div>
    <div class="card-body">
        <router-link to="/purchase">
            <button class="btn btn-sm btn-info">Purchase List</button>
        </router-link>
        <router-link to="/purchase/create">
            <button class="btn btn-sm btn-info  mx-1">Purchase Create</button>
        </router-link>
        <div class="row">

            <div class="col-md-12 pt-4">

                <!-- Vertical form -->
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">Units</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.unit_name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">JL No</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.jl_no }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">JOT No</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.jot_no }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">Dag No</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.dag_no }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">Plot No</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.plot_no }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">Mowja</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.mowza_name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">Division</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.division_name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">District</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.district_name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">Thana</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.thana_name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">Union</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.union_name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">CS</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.cs }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">SA</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.sa }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">RS</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.rs }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">BRS</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.brs }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">Type</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.type ==0 ? 'Plot' : 'Land' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">East</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.east }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">West</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.west }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">North</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.north }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 95px;font-weight: bold;">South</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.south }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-xl col-lg-3 col-md-4 col-sm-12">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="width: 120px;font-weight: bold;">Qty</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.qty }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 120px;font-weight: bold;">Unit Price</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.unit_price }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 120px;font-weight: bold;">Total Price</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.total_price }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 120px;font-weight: bold;">Remaining Qty</td>
                                            <td style="width: 10px;">:</td>
                                            <td>{{ purchase_data.remaining_qty }}</td>
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

<style>

</style>

<script>
    export default{
        data() {
            return {
                'purchase_data' : [],
            };
        },
        created() {
            this.getPurchase();
        },
        mounted(){

        },
        methods :{
            getPurchase(){
                axios
                .get("/api/purchase/view/"+this.$route.params.id)
                .then((response)=>{
                    this.purchase_data = response.data
                })
                .catch((error)=>{
                    toastr.error('Something went wrong.');
                });
            },
        },
    }

</script>
