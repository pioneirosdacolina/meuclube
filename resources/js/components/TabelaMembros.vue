<template>
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Membros Pr&eacute; Inscritos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Nome</th>
                            <th>Unidade</th>
                            <th>Situa&ccedil;&atilde;o</th>
                            <th>Editar</th>
                        </tr>
                        <tr v-for="membro in membros" :key="membro.id" >
                            <td>{{ membro.nome }}</td>
                            <td>{{ membro.unidade }}</td>
                            <td>{{ membro.situacao | situacaoDesbravador }}</td>
                            <td>
                                <a href="#" @click.prevent="editarMembro( membro )">
                                    <i class="fa fa-edit blue"></i>
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
</template>

<script>
    export default {
        name: "Membros",
        data(){
            return{
                membros: {}
            }
        },
        methods:{
            loadMembers(){
                axios.get('api/membro')
                        .then( ({ data }) => ( this.membros = data ) );
            },
            editarMembro( membro ){
                Fire.$emit( 'editarMembro', membro );
            }
        },
        created() {
            this.loadMembers();
            Fire.$on( 'LoadMembers', () =>{
                this.loadMembers();
            } );
        }
    }
</script>

<style scoped>

</style>