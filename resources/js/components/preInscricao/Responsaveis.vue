<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Respons&aacute;veis</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click.prevent="adcionarResponsavel">Adicionar <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>Nome</th>
                                <th>Grau Parentesco</th>
                                <th></th>
                            </tr>
                            <tr v-for="responsavel in responsaveis" :key="responsavel.id" >
                                <td>{{ responsavel.nome }}</td>
                                <td>{{ responsavel.parentesco | descricaoParentesco }}</td>
                                <td>
                                    <a href="#" @click="editarResponsavel( responsavel )">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    |
                                    <a href="#" @click.prevent="apagarResponsavel(responsavel)">
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

        <div class="modal fade" id="adicionaResponsavelModal" tabindex="-1"
             role="dialog" aria-labelledby="adicionaResponsavelModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adicionaResponsavelModalLabel">{{ editMode ? "Editar Respons&aacute;vel" : "Novo Respos&aacute;vel" }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? atualizarResponsavel() : criarResponsavel()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" v-model="responsavel.nome" class="form-control"
                                       name="name" placeholder="Nome"
                                       :class="{ 'is-invalid' : responsavel.errors.has('nome') }">
                                <has-error :form="responsavel" field="parentesco"></has-error>
                            </div>
                            <div class="form-group">
                                <the-mask :mask="['###.###.###-##']" class="form-control" id="cpfResponsavel"
                                          placeholder="CPF" v-model="responsavel.cpf"
                                          :class="{ 'is-invalid' : responsavel.errors.has('cpf') }"/>
                                <has-error :form="responsavel" field="cpf"></has-error>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="rgResponsavel"
                                       placeholder="RG" v-model="responsavel.rg"
                                       :class="{ 'is-invalid' : responsavel.errors.has('rg') }">
                                <has-error :form="responsavel" field="rg"></has-error>
                            </div>
                            <div class="form-group">
                                <select name="type" id="type" v-model="responsavel.parentesco" class="form-control"
                                        :class="{ 'is-invalide': responsavel.errors.has('parentesco')}">
                                    <option value="">Parentesco</option>
                                    <option value="pai">Pai</option>
                                    <option value="mae">M&atilde;e</option>
                                    <option value="a_avo">Av&oacute;</option>
                                    <option value="o_avo">Av&ocirc;</option>
                                    <option value="tio">Tio</option>
                                    <option value="tia">Tia</option>
                                    <option value="padastro">Padastro</option>
                                    <option value="madastra">Madastra</option>
                                    <option value="outros">Outros</option>
                                </select>
                                <has-error :form="responsavel" field="parentesco"></has-error>
                            </div>
                            <contatos title="Telefones" tipo="telefone" origem="responsavel"
                                      ref="telefonesResponsavel"></contatos>
                            <contatos title="E-mails" tipo="email" origem="responsavel"
                                      ref="emailsResponsavel"></contatos>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" v-if="editMode" class="btn btn-success">Atualizar</button>
                            <button type="submit" v-if="!editMode" class="btn btn-primary">Salvar</button>
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
                membro : {},
                responsaveis: [],
                editMode: false,
                responsavel: new Form({
                    id: '',
                    responsavels_id: 0,
                    membros_id: null,
                    parentesco: '',
                    nome: '',
                    cpf: null,
                    rg: ''
                })
            };
        },
        mounted() {
            console.log('Component mounted.')
            Fire.$on( 'carregarResponsaveis', ( membro ) =>{
                this.carregarResponsaveis( membro );
            } );
        },
        methods:{
            carregarResponsaveis( membro ){
                this.membro = membro;
                axios.get('/api/responsavel/' + membro.id)
                    .then( ( response, data ) => {
                        console.log( { action: 'carregarResponsaveis', dados: response });
                        this.responsaveis = response.data.data;
                    });
            },
            adcionarResponsavel(){
                console.log('Abre popup para adicionar novo responavel do desbravador');

                this.editMode = false;
                this.responsavel.clear();
                this.responsavel.reset();

                this.responsavel.membros_id = this.membro.id;
                this.carregarContatos();

                $( '#adicionaResponsavelModal' ).modal( 'show' );
            },
            editarResponsavel( responsavel ){
                console.log('Abre popup para editar responavel do desbravador');
                this.responsavel.clear();
                this.responsavel.reset();
                this.editMode = true;

                this.responsavel.fill( responsavel );
                this.carregarContatos();
                $( '#adicionaResponsavelModal' ).modal( 'show' );
            },

            carregarContatos(){
                this.$refs.telefonesResponsavel.alterarOrigemId( this.responsavel.id );
                this.$refs.emailsResponsavel.alterarOrigemId(  this.responsavel.id );

                this.$refs.telefonesResponsavel.carregarContatos();
                this.$refs.emailsResponsavel.carregarContatos();
            },

            apagarResponsavel( responsavel ){
                console.log('TODO mensagem de alerta antes de apagar o responsável.');
                this.responsavel.delete( '/api/responsavel/'+ responsavel.id )
                    .then( (response) =>{

                        toast.fire(
                            'Apagado!',
                            'Respons\u00E1vel apagado com sucesso!',
                            'success'
                        );

                        this.carregarResponsaveis( this.membro );
                    } )
                    .catch( (e) => {
                        console.log(e);

                        toast.fire(
                            'Erro!',
                            'Ocorreu um erro apagar o respons\u00E1vel.',
                            'warning'
                        );

                    } );
            },

            atualizarResponsavel(){
                console.log('Atualizar responavel do desbravador');
                this.$Progress.start();
                this.responsavel.put('/api/responsavel/' + this.responsavel.id )
                    .then( ( data ) => {
                        this.$refs.telefonesResponsavel.saveAllContatos();
                        this.$refs.emailsResponsavel.saveAllContatos();

                        this.sucessoNaGravacao( data );
                    })
                    .catch( ({ e }) => {
                        console.log(e);
                        this.erroNaGravacao();
                    } );
            },

            criarResponsavel(){
                console.log('Criar responavel do desbravador');

                this.$Progress.start();
                this.responsavel.post('/api/responsavel')
                    .then( ( data ) => {
                        console.log( 'Criado com sucesso.' );

                        this.responsavel.fill( data.data );
                        this.$refs.telefonesResponsavel.alterarOrigemId( this.responsavel.id );
                        this.$refs.emailsResponsavel.alterarOrigemId( this.responsavel.id );

                        this.$refs.telefonesResponsavel.saveAllContatos();
                        this.$refs.emailsResponsavel.saveAllContatos();

                        this.sucessoNaGravacao( data );
                    } )
                    .catch( ( { e } ) => {
                        console.log(e);
                        this.erroNaGravacao();
                    } );
            },

            erroNaGravacao(){
                toast.fire(
                    'Erro!',
                    'Ocorreu um erro na gravação dos dados do respons\u00E1vel. Tente novamente',
                    'warning'
                );
                this.$Progress.fail();
            },

            sucessoNaGravacao( responsavel ){
                console.log( responsavel );
                this.responsavel.fill( responsavel );

                toast.fire(
                    this.editMode ? "Atualizar respons\u00E1vel!" : 'Novo respons\u00E1vel!',
                    'Dados do respons\u00E1vel salvos com sucesso.',
                    'success'
                );
                this.carregarResponsaveis( this.membro );

                this.$Progress.finish();

                $( '#adicionaResponsavelModal' ).modal( 'hide' );
            }
        },
        created() {

        }

    }
</script>
