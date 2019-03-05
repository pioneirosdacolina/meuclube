<template>
<div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-6 mt-3 green"v-if="!iniciarCadastro">
                <div class="card-body">
                    <h3><a href="#" @click.prevent="meInscrever"><i class="fas fa-user-edit"></i> Fazer a minha inscri&ccedil;&atilde;o </a href="#" @click></h3>
                    <h3><a href="#" @click.prevent="outraInscricao"><i class="fas fa-user-plus"></i> Fazer inscri&ccedil;&atilde;o de outro membro</a></h3>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="card" v-if="iniciarCadastro">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link" :class="{ active: etapas.dadosBasicos == 'active', disabled: etapas.dadosBasicos == 'disabled'}" href="#dadosBasicos" data-toggle="tab">Dados B&aacute;sicos</a></li>
                            <li class="nav-item"><a class="nav-link" :class="{ active: etapas.documentos == 'active',   disabled: etapas.documentos == 'disabled'}" href="#documentos" data-toggle="tab" disabled>Documentos</a></li>
                            <li class="nav-item"><a class="nav-link" :class="{ active: etapas.escolaridade == 'active', disabled: etapas.escolaridade == 'disabled'}" href="#escolaridade" data-toggle="tab">Escolaridade</a></li>
                            <li class="nav-item"><a class="nav-link" :class="{ active: etapas.contatos == 'active',     disabled: etapas.contatos == 'disabled'}" href="#contatos" data-toggle="tab">Contatos</a></li>
                            <li class="nav-item"><a class="nav-link" :class="{ active: etapas.responsaveis == 'active', disabled: etapas.responsaveis == 'disabled'}" href="#responsaveis" data-toggle="tab">Respons&aacute;veis</a></li>
                            <li class="nav-item"><a class="nav-link" :class="{ active: etapas.fichadesaude == 'active', disabled: etapas.fichadesaude == 'disabled'}" href="#fichadesaude" data-toggle="tab">Ficha de Sa&uacute;de</a></li>
                            <li class="nav-item"><a class="nav-link" :class="{ active: etapas.documentacao == 'active', disabled: etapas.dadosBasicos == 'disabled'}" href="#documentacao" data-toggle="tab">Documenta&ccedil;&atilde;o</a></li>                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="dadosBasicos">
                                <form class="form-horizontal" @submit.prevent=" isCadastroNovo ? createMembro() : updateMembro() ">
                                    <div class="form-group">

                                        <label for="nomeCompleto">Nome Completo</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nomeCompleto"
                                                   placeholder="Nome Completo" v-model="dadosBasicos.nome"
                                                   :class="{ 'is-invalid' : dadosBasicos.errors.has('nome') }">
                                            <has-error :form="dadosBasicos" field="nome"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="dataNascimento">Data de nascimento</label>
                                        <div class="col-sm-10 input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control" placeholder="Data de Nascimento"
                                                   id="dataNascimento" data-inputmask="alias: 'dd/mm/yyyy'" @blur="setIdade"
                                                   pattern="\d{1,2}/\d{1,2}/\d{4}" v-model="dadosBasicos.data_nascimento"
                                                   :class="{ 'is-invalid' : dadosBasicos.errors.has('data_nascimento') }">
                                            <has-error :form="dadosBasicos" field="data_nascimento"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="idade">Idade</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="idade" placeholder="Preenchimento automático" v-model="dadosBasicos.idade"
                                                   :class="{ 'is-invalid' : dadosBasicos.errors.has('idade') }" disabled required>
                                            <has-error :form="dadosBasicos" field="idade"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Sexo</label>
                                        <div class="mx-auto" style="width: 100%">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sexoRadioOptions" id="masculino" value="M" v-model="dadosBasicos.sexo" style="width: 0px" @change="setUnidade">
                                                <label class="btn" :class="{ 'btn-light': dadosBasicos.sexo != 'M', 'btn-dark': dadosBasicos.sexo == 'M', 'is-invalid' : dadosBasicos.errors.has('sexo')}" for="masculino">MASCULINO</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sexoRadioOptions" id="feminino" value="F"  v-model="dadosBasicos.sexo" style="width: 0px" @change="setUnidade">
                                                <label class="btn" :class="{ 'btn-light': dadosBasicos.sexo != 'F', 'btn-dark': dadosBasicos.sexo == 'F', 'is-invalid' : dadosBasicos.errors.has('sexo')}" for="feminino">FEMININO</label>
                                            </div>
                                            <has-error :form="dadosBasicos" field="sexo"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="unidade">Unidade</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="unidade" placeholder="Preenchimento exclusivo da diretoria"
                                                   v-model="dadosBasicos.unidade" :class="{ 'is-invalid' : dadosBasicos.errors.has('unidade') }" disabled required>
                                            <has-error :form="dadosBasicos" field="unidade"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="estadoCivil">Estado Civil</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="estadoCivil" v-model="dadosBasicos.estado_civil"
                                                    :class="{ 'is-invalid' : dadosBasicos.errors.has('estado_civil') }" required>
                                                <has-error :form="dadosBasicos" field="estado_civil"></has-error>
                                                <option value="">Selecione um estado civil</option>
                                                <option value="solteiro">Solteiro(a)</option>
                                                <option value="casado">Casado(a)</option>
                                                <option value="uniao_estavel">Uni&atilde;o Est&aacute;vel</option>
                                                <option value="divorciado">Divorciado(a)</option>
                                                <option value="viuvo">Vi&uacute;vo(a)</option>
                                                <option value="outros">Outros</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button @click.prevent="cancelar" class="btn btn-danger">Cancelar</button>
                                            <button type="submit" class="btn btn-primary float-right">Documentos</button>
                                        </div>
                                        <div class="col-sm-offset-2 col-sm-10">

                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">

                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>
</template>

<script>
// TODO quebrar o componente em vários
// TODO Arrumar o inputmask

    import Inputmask from 'inputmask';
    export default {
        components:{
          Inputmask
        },
        data(){
            return {
                etapas :{
                    dadosBasicos: 'active',
                    documentos: 'disabled',
                    escolaridade: 'disabled',
                    contatos: 'disabled',
                    responsaveis: 'disabled',
                    fichadesaude: 'disabled',
                    documentacao: 'disabled'
                },
                isCadastroNovo: false,
                inscricaoPropria: false,
                iniciarCadastro: false,
                possuiUnidade: false,
                dadosBasicos: new Form({
                    id: '',
                    nome:'',
                    data_nascimento: '',
                    idade:'',
                    sexo:'',
                    unidade:'',
                    estado_civil:'',
                    user_create: '',
                    user_id:''
                })
            }
        },
        methods: {
            meInscrever(){
                this.dadosBasicos.reset();
                this.iniciarCadastro = true;
                this.inscricaoPropria = true;
                this.isCadastroNovo = true;

                this.etapas ={
                    dadosBasicos: 'active',
                    documentos: 'disabled',
                    escolaridade: 'disabled',
                    contatos: 'disabled',
                    responsaveis: 'disabled',
                    fichadesaude: 'disabled',
                    documentacao: 'disabled'
                };

                this.dadosBasicos.fill( {
                    nome: this.$gate.getNome(),
                    user_id: this.$gate.getId()
                } );

            },
            outraInscricao(){
                this.dadosBasicos.reset();
                this.iniciarCadastro = true;
                this.inscricaoPropria = false;
                this.isCadastroNovo = true;
                this.dadosBasicos.fill( {
                    user_create: this.$gate.getId()
                } );
            },
            cancelar(){
                this.dadosBasicos.reset();
                this.iniciarCadastro = false;
                this.inscricaoPropria = false;
            },
            setUnidade(){
                if( this.possuiUnidade ) return;

                const{idade, sexo} = this.dadosBasicos;

                if( !idade || !sexo){
                    return;
                }

                if( idade >15 ){
                    this.dadosBasicos.unidade = 'Diretoria';
                }else{
                    this.dadosBasicos.unidade = unidades[sexo][idade];
                }
            },
            setIdade( e ){
                var today = new Date('07/01/2019');
                var birthDate = new Date( e.target.value );

                var idade = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate()))
                {
                    idade--;
                }

                this.dadosBasicos.idade = idade;
                this.setUnidade();
            },
            createMembro( e ){
                console.log('adicionar membro');
                this.dadosBasicos.post('api/membro')
                    .then( ( data ) => {
                        this.dadosBasicos.fill(data.data);
                        this.isCadastroNovo = false;
                    } )
            },
            updateMembro( e ){

            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
