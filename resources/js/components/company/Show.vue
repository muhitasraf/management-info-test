<template>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Company Name</th>
                    <th>Display Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(company, index) in companies">
                    <td>{{ index + 1 }}</td>
                    <td>{{ company.name }}</td>
                    <td>{{ company.display_name }}</td>
                    <td>{{ company.status == 1 ? 'Active' : 'In-Active' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                'companies' : [],
            };
        },
        mounted(){
            axios
            .get("/api/company")
            .then((response)=>{
                this.companies = response.data
            })
            .catch((error)=>{
                console.log(error);
            });
        },
    }
</script>
