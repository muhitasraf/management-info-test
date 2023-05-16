<template>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 pt-4">

            <!-- Vertical form -->
            <div class="card">

                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="form-group">
                            <label>Comapany Name</label>
                            <input v-model="field.company_name" type="text" class="form-control company_name">
                        </div>

                        <div class="form-group">
                            <label>Display Name</label>
                            <input v-model="field.display_name" type="text" class="form-control display_name">
                        </div>

                        <div class="form-group">
                            <label>Company Status</label>
                            <select v-model="field.status" class="form-control status">
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                        </div>
                        <span v-if="errors.company_name">{{ errors.company_name }}</span>
                        <div class="text-right pt-1">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /vertical form -->

        </div>
        <div class="col-md-2"></div>
    </div>
</template>

<script>
    export default{
        data() {
            return {
                field : {},
                errors : {},
            };
        },
        methods :{
            submit(){
                axios
                .post("/api/company/create", this.field)
                .then((response)=>{
                    this.field = {};
                    this.errors = {};
                    this.$router.push({name: "Company"});
                })
                .catch((error)=>{
                    console.log(error);
                });

            },
        },
    }
</script>
