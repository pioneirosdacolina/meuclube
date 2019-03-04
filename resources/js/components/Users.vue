<template>
    <div class="container"  v-if="$gate.isDiretoria()">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="addUser">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Type</th>
                                <th>Registered At</th>
                                <th v-if="$gate.isDiretoria()">Modify</th>
                            </tr>
                            <tr v-for="user in users" :key="user.id" >
                                <td>{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.role | upText }}</td>
                                <td>{{ user.created_at | myDate }}</td>
                                <td v-if="$gate.isDiretoria()">
                                    <a href="#" @click="editUser( user )">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    |
                                    <a href="#" @click.prevent="deleteUser(user.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewModalLabel">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" v-model="form.name" class="form-control"
                                       name="name" placeholder="Name"
                                       :class="{ 'is-invalid' : form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <input type="email" v-model="form.email" class="form-control"
                                       name="email" placeholder="E-mail address"
                                       :class="{ 'is-invalid' : form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <textarea v-model="form.bio" class="form-control"
                                       name="bio" id="bio" placeholder="Short bio for user (Optional)"
                                       :class="{ 'is-invalid' : form.errors.has('bio') }"></textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>
                            <div class="form-group">
                                <select name="type" id="type" v-model="form.type" class="form-control"
                                :class="{ 'is-invalide': form.errors.has('type')}">
                                    <option value="">Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <option value="author">Author</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                            <div class="form-group">
                                <input type="password" v-model="form.password" class="form-control"
                                       name="password" id="password" placeholder="E-mail address"
                                       :class="{ 'is-invalid' : form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" v-if="editMode" class="btn btn-success">Update</button>
                            <button type="submit" v-if="!editMode" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                users: {},
                editMode: true,
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        methods:{
            deleteUser( id ){
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    if( result.value ){
                        this.form.delete('api/user/' + id)
                            .then(()=>{
                                Fire.$emit( 'AfterCreate' );
                                swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            })
                            .catch(()=>{
                                swal.fire(
                                    'Failed!',
                                    'There was something wronge.',
                                    'warning'
                                )
                            });
                    }
                })
            },
            editUser( user ){
                this.editMode = true;
                this.form.clear();
                this.form.reset();
                this.form.fill( user );
                $( '#addNewModal' ).modal( 'show' );
            },
            addUser(){
                this.editMode = false;
                this.form.clear();
                this.form.reset();

                $( '#addNewModal' ).modal( 'show' );
            },
            loadUsers(){
                if( this.$gate.isDiretoria() ){
                    axios.get('api/user')
                        .then( ({ data }) => ( this.users = data.data ) );
                }else{
                    this.$router.push('/boasVindas');
                }
            },
            updateUser(){
                this.form.put( 'api/user/' + this.form.id )
                    .then(()=>{
                        $( '#addNewModal' ).modal( 'hide' );

                        swal.fire(
                            'Updated!',
                            'Information has been updated.',
                            'success'
                        );
                        this.$Progress.finish();
                        Fire.$emit( 'AfterCreate' );
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                    })
                ;
            },
            createUser(){
                this.$Progress.start();
                this.form.post('api/user')
                    .then(()=>{
                        Fire.$emit( 'AfterCreate' );

                        $( '#addNewModal' ).modal( 'hide' );

                        toast.fire({
                            type: 'success',
                            title: 'User created in successfully'
                        });
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                    })
                ;
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this.loadUsers();
            Fire.$on( 'AfterCreate', () =>{
                this.loadUsers();
            } );
        }
    }
</script>
