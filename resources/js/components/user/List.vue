<template>
    <div class="card-header">
        <h5 class="mb-0">Create User</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="d-grid gap-2 d-md-block">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">Add New User</button>
            </div>

            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true" ref="myModalRef">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form @submit.prevent="submit">
                            <div class="modal-header">
                                <h5 class="modal-title" id="userModalLabel">Create user</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-1">
                                    <label for="name" class="col-form-label">Full Name:</label>
                                    <input type="text" v-model="fields.name" class="form-control" id="name" placeholder="Full Name">
                                    <span class="text-warning" v-if="errors.name">{{ errors.name[0] }}</span>
                                </div>
                                <div class="mb-1">
                                    <label for="user_name" class="col-form-label">User Name:</label>
                                    <input type="text" v-model="fields.user_name" class="form-control" id="user_name" placeholder="User Name">
                                    <span class="text-warning" v-if="errors.user_name">{{ errors.user_name[0] }}</span>
                                </div>
                                <div class="mb-1">
                                    <label for="email" class="col-form-label">Email:</label>
                                    <input type="text" v-model="fields.email" class="form-control" id="email" placeholder="Email">
                                    <span class="text-warning" v-if="errors.email">{{ errors.email[0] }}</span>
                                </div>

                                <div class="mb-1">
                                    <label for="password" class="col-form-label">Password:</label>
                                    <input type="text" v-model="fields.password" class="form-control" id="password" placeholder="Password">
                                    <span class="text-warning" v-if="errors.password">{{ errors.password[0] }}</span>
                                </div>

                                <div class="mb-1">
                                    <label for="password_confirmation" class="col-form-label">Confirm Password:</label>
                                    <input type="text" v-model="fields.password_confirmation" class="form-control" id="password_confirmation" placeholder="Password">
                                    <span class="text-warning" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="clearInput()" id="close" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">{{ ButtonText }}<i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 pt-2">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-secondary mb-1 mx-1" @click="$export_pdf(this.$refs.dataTable.outerHTML, 'P', 'User List')">
                            <i class="fa-solid fa-file-pdf"></i>
                        </button>
                        <button type="button" class="btn btn-secondary mb-1 mx-1" @click="$export_excel(this.$refs.dataTable.outerHTML)">
                            <i class="fa-solid fa-file-excel"></i>
                        </button>
                        <button type="button" class="btn btn-secondary mb-1" @click="$print_html('landscape')">
                            <i class="fa-solid fa-print"></i>
                        </button>
                        <h3 class="title text-center">User List</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table_content" ref="dataTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, index) in users" :key="user.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.user_name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td class="text-center">
                                            <button @click="editUser(user.id)" class="btn btn-sm btn-info mx-1 hide-btn" data-bs-toggle="modal" data-bs-target="#userModal">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button @click="deleteUser(user.id)" class="btn btn-sm btn-danger hide-btn">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
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
</template>

<style>
    @media print {
        .hide-btn{
            visibility: hidden;
        }
    }
</style>
<script>

    export default{
        data() {
            return {
                fields : {
                },
                errors : {},
                'users' : [],
                'ButtonText' : 'Insert',
                'submitStatus' : '0',
                'user_id' : '',
                'table_contant' : '',
            };
        },
        created() {
            this.getUser();
        },
        mounted(){
            this.getUser();
        },
        methods :{

            submit(){
                if(this.submitStatus==0){
                    console.log(this.fields)
                    axios
                    .post("/api/resister", this.fields)
                    .then((response)=>{
                        this.fields = {};
                        this.errors = {};
                        document.getElementById('close').click();
                        toastr.success('Successfully Created.');
                        this.getUser();
                    })
                    .catch((error)=>{
                        this.errors = error.response.data.errors;
                        toastr.error('Something went wrong.');
                    });
                }else{
                    axios
                    .post("/api/user/update/"+this.user_id, this.fields)
                    .then((response)=>{
                        // $('#userModal').modal('hide');
                        document.getElementById('close').click();
                        toastr.success('Successfully Updated.');
                        this.fields = {};
                        this.fields.user_id = ''
                        this.errors = {};
                        this.ButtonText = 'Insert'
                        this.submitStatus = 0;
                        this.getUser();
                    })
                    .catch((error)=>{
                        this.errors = error.response.data.errors;
                        toastr.error('Something went wrong.');
                    });
                }
            },
            getUser(){
                axios
                .get("/api/user/list")
                .then((response)=>{
                    this.users = response.data
                    this.$nextTick(() => {
                        $("#dataTable").DataTable({
                            "destroy": true,
                            dom: 'Bfrtip',
                            buttons: [
                                'excel', 'pdf', 'print'
                            ],
                        });
                    });
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            editUser(id){
                axios
                .get("/api/user/edit/"+id)
                .then((response)=>{
                    this.fields.name = response.data.name
                    this.fields.user_name = response.data.user_name
                    this.fields.email = response.data.email
                    this.ButtonText = 'Update'
                    this.submitStatus = 1;
                    this.user_id = response.data.id
                })
                .catch((error)=>{
                    console.log(error);
                });
            },
            deleteUser(id){
                if(confirm("Do you really want to delete?")){
                    axios
                    .post("/api/user/delete/"+id)
                    .then((response)=>{
                        toastr.warning('Successfully Deleted.');
                        this.getUser();
                    })
                    .catch((error)=>{
                        // console.log(error);
                        toastr.error('Something went wrong.');
                    });
                }
            },
            clearInput(){
                this.fields = {}
            },
        },
    }
</script>
