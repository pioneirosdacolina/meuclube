<template>
<div class="container">
        <div class="row justify-content-center" v-if="!iniciarCadastro">
            <div class="card col-md-6 mt-3 green">
                <div class="card-body">
                    <h4><a href="#" @click.prevent="meInscrever"><i class="fas fa-user-edit"></i> Fazer a minha inscri&ccedil;&atilde;o </a href="#" @click></h4>
                    <h4><a href="#" @click.prevent="outraInscricao"><i class="fas fa-user-plus"></i> Fazer inscri&ccedil;&atilde;o de outro membro</a></h4>
                </div>
            </div>
        </div>
        <tabela-membros v-if="!iniciarCadastro"></tabela-membros>

        <div class="row justify-content-center" v-if="iniciarCadastro">

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a @click="etapa = 'dadosBasicos'" class="nav-link" id="navDadosBasicos" :class="{ active: etapa=== 'dadosBasicos', disabled: !etapas.dadosBasicos }" href="#dadosBasicos" data-toggle="tab">Dados B&aacute;sicos</a></li>
                            <li class="nav-item"><a @click="etapa = 'documentos'" class="nav-link" id="navDocumentos" :class="{ active: etapa === 'documentos', disabled: !etapas.documentos }" href="#documentos" data-toggle="tab" disabled>Documentos</a></li>
                            <li class="nav-item"><a @click="etapa = 'escolaridade'" class="nav-link" id="navEscolaridade" :class="{ active: etapa === 'escolaridade', disabled: !etapas.escolaridade }" href="#escolaridade" data-toggle="tab">Escolaridade</a></li>
                            <li class="nav-item"><a @click="etapa = 'contatos'" class="nav-link" id="navContatos" :class="{ active: etapa === 'contatos', disabled: !etapas.contatos }" href="#contatos" data-toggle="tab">Contatos</a></li>
                            <li class="nav-item"><a @click="carregarResponsavel" class="nav-link" id="navResponsaveis" :class="{ active: etapa === 'responsaveis', disabled: !etapas.responsaveis }" href="#responsaveis" data-toggle="tab">Respons&aacute;veis</a></li>
                            <li class="nav-item"><a @click="carregarInformacoesAdicionais" class="nav-link" id="navInformacoesAdicionais" :class="{ active: etapa === 'informacoesAdicionais', disabled: !etapas.informacoesAdicionais }" href="#informacoesAdicionais" data-toggle="tab">Informa&ccedil;&otilde;es Adicionais</a></li>
                            <li class="nav-item"><a @click="etapa = 'fichadesaude'" class="nav-link" id="navFichadesaude" :class="{ active: etapa === 'fichadesaude', disabled: !etapas.fichadesaude }" href="#fichadesaude" data-toggle="tab">Ficha de Sa&uacute;de</a></li>
                            <li class="nav-item"><a @click="etapa = 'documentacao'" class="nav-link" id="navDocumentacao" :class="{ active: etapa === 'documentacao', disabled: !etapas.documentacao }" href="#documentacao" data-toggle="tab">Documenta&ccedil;&atilde;o</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" :class="{ active: etapa === 'dadosBasicos' }" id="dadosBasicos" v-show="etapa == 'dadosBasicos'">
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
                                            <button @click.prevent="cancelar" class="btn btn-danger">Sair</button>
                                            <button type="submit" v-if="!isCadastroNovo" class="btn btn-success float-right">Salvar</button>
                                            <button type="submit" v-if="isCadastroNovo" class="btn btn-primary float-right">Documentos</button>
                                        </div>
                                        <div class="col-sm-offset-2 col-sm-10">

                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="documentos" v-show="etapa == 'documentos'" :class="{ active: etapa === 'documentos' }">
                                <form class="form-horizontal" @submit.prevent="updateMembro() ">
                                    <div class="form-group">

                                        <label for="cpf">CPF</label>
                                        <div class="col-sm-10">
                                            <the-mask :mask="['###.###.###-##']" class="form-control" id="cpf"
                                                      placeholder="CPF" v-model="dadosBasicos.cpf"
                                                      :class="{ 'is-invalid' : dadosBasicos.errors.has('cpf') }"/>

                                            <has-error :form="dadosBasicos" field="cpf"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="rg">RG</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="rg"
                                                   placeholder="RG" v-model="dadosBasicos.rg"
                                                   :class="{ 'is-invalid' : dadosBasicos.errors.has('rg') }">
                                            <has-error :form="dadosBasicos" field="rg"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="dataNascimento">Certid&atilde;o de Nascimento</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="certidao"
                                                   placeholder="Número da Certidão" v-model="dadosBasicos.certidao"
                                                   :class="{ 'is-invalid' : dadosBasicos.errors.has('certidao') }">
                                            <has-error :form="dadosBasicos" field="certidao"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button @click.prevent="cancelar" class="btn btn-danger">Sair</button>
                                            <button type="submit" v-if="!isCadastroNovo" class="btn btn-success float-right">Salvar</button>
                                            <button type="submit" v-if="isCadastroNovo" class="btn btn-primary float-right">Escolaridade</button>
                                        </div>
                                        <div class="col-sm-offset-2 col-sm-10">

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" :class="{ active: etapa === 'escolaridade' }" id="escolaridade" v-show="etapa == 'escolaridade'">
                                <form class="form-horizontal" @submit.prevent="saveEscolaridade() ">
                                    <div class="form-group">

                                        <label for="cpf">Escola</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nome_escola"
                                                   placeholder="Nome da Escola" v-model="escolaridade.nome_escola"
                                                   :class="{ 'is-invalid' : escolaridade.errors.has('nome_escola') }">
                                            <has-error :form="escolaridade" field="nome_escola"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="dataNascimento">Série</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="serie"
                                                   placeholder="Série Escolar" v-model="escolaridade.serie"
                                                   :class="{ 'is-invalid' : escolaridade.errors.has('serie') }">
                                            <has-error :form="escolaridade" field="nome_escola"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Per&iacute;odo</label>
                                        <div class="mx-auto" style="width: 100%">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="periodoRadioOptions" id="manha" value="MANHA" v-model="escolaridade.periodo" style="width: 0px">
                                                <label class="btn" :class="{ 'btn-light': escolaridade.periodo != 'MANHA', 'btn-dark': escolaridade.periodo == 'MANHA', 'is-invalid' : escolaridade.errors.has('periodo')}" for="manha">MANHÃ</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="periodoRadioOptions" id="tarde" value="TARDE"  v-model="escolaridade.periodo" style="width: 0px">
                                                <label class="btn" :class="{ 'btn-light': escolaridade.periodo != 'TARDE', 'btn-dark': escolaridade.periodo == 'TARDE', 'is-invalid' : escolaridade.errors.has('periodo')}" for="tarde">TARDE</label>
                                            </div>
                                            <has-error :form="escolaridade" field="periodo"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button @click.prevent="cancelar" class="btn btn-danger">Sair</button>
                                            <button type="submit" v-if="!isCadastroNovo" class="btn btn-success float-right">Salvar</button>
                                            <button type="submit" v-if="isCadastroNovo" class="btn btn-primary float-right">Contatos</button>
                                        </div>
                                        <div class="col-sm-offset-2 col-sm-10">

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" :class="{ active: etapa === 'contatos' }" id="contatos"v-show="etapa == 'contatos'">
                                <form class="form-horizontal" @submit.prevent="saveContatosMembro() ">
                                    <h3>Endereço</h3>
                                    <div class="form-group">

                                        <label for="cep">CEP</label>
                                        <div class="col-sm-10">
                                            <the-mask class="form-control" id="cep" mask="#####-###"
                                                   placeholder="CEP" v-model="endereco.cep" @change.native="buscarCep"
                                                   :class="{ 'is-invalid' : endereco.errors.has('cep') }" />
                                            <has-error :form="endereco" field="cep"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="logradouro">Logradouro</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="logradouro"
                                                   placeholder="Logradouro" v-model="endereco.logradouro"
                                                   :class="{ 'is-invalid' : endereco.errors.has('logradouro') }">
                                            <has-error :form="endereco" field="`logradouro"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="numeroLogradouro">Número</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="numeroLogradouro"
                                                   placeholder="Número" v-model="endereco.numero"
                                                   :class="{ 'is-invalid' : endereco.errors.has('numero') }">
                                            <has-error :form="endereco" field="`numero"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="complemento">Complemento</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="complemento"
                                                   placeholder="Complemento" v-model="endereco.complemento"
                                                   :class="{ 'is-invalid' : endereco.errors.has('complemento') }">
                                            <has-error :form="endereco" field="`complemento"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="bairro">Bairro</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="bairro"
                                                   placeholder="Bairro" v-model="endereco.bairro"
                                                   :class="{ 'is-invalid' : endereco.errors.has('bairro') }">
                                            <has-error :form="endereco" field="`bairro"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="localidade">Cidade</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="localidade"
                                                   placeholder="Cidade" v-model="endereco.localidade"
                                                   :class="{ 'is-invalid' : endereco.errors.has('localidade') }">
                                            <has-error :form="endereco" field="`localidade"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="uf">Estado</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="uf"
                                                   placeholder="UF" v-model="endereco.uf"
                                                   :class="{ 'is-invalid' : endereco.errors.has('uf') }" disabled>
                                            <has-error :form="endereco" field="`uf"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="referencia">Ponto de Referência</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="referencia"
                                                   placeholder="Ponto de Referência" v-model="endereco.referencia"
                                                   :class="{ 'is-invalid' : endereco.errors.has('referencia') }">
                                            <has-error :form="endereco" field="`referencia"></has-error>
                                        </div>
                                    </div>
                                    <contatos title="Telefones" tipo="telefone" origem="membro" v-bind:origemId="dadosBasicos.id"></contatos>
                                    <contatos title="E-mails" tipo="email" origem="membro" v-bind:origemId="dadosBasicos.id"></contatos>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button @click.prevent="cancelar" class="btn btn-danger">Sair</button>
                                            <button type="submit" v-if="!isCadastroNovo" class="btn btn-success float-right">Salvar</button>
                                            <button type="submit" v-if="isCadastroNovo" class="btn btn-primary float-right">Contatos</button>
                                        </div>
                                        <div class="col-sm-offset-2 col-sm-10">

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" :class="{ active: etapa === 'responsaveis' }" id="responsaveis"v-show="etapa == 'responsaveis'">
                                <inscricao-responsaveis></inscricao-responsaveis>
                            </div>
                            <!-- /.tab-pane -->

                            <!-- /.tab-pane -->
                            <div class="tab-pane" :class="{ active: etapa === 'informacoesAdicionais' }" id="informacoesAdicionais"v-show="etapa == 'informacoesAdicionais'">
                                <informacoes-adicionais></informacoes-adicionais>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" :class="{ active: etapa === 'fichadesaude' }" id="fichadesaude"v-show="etapa == 'fichadesaude'">
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" :class="{ active: etapa === 'documentacao' }" id="documentacao"v-show="etapa == 'documentacao'">
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
// TODO validar o CPF


    // Local Directive
    import {TheMask} from 'vue-the-mask'
    export default {
        components:{ TheMask },
        data(){
            return {
                etapas :{
                    dadosBasicos: true,
                    documentos: false,
                    escolaridade: false,
                    contatos: false,
                    responsaveis: false,
                    informacoesAdicionais: false,
                    fichadesaude: false,
                    documentacao: false
                },
                membro:{},
                etapa: 'contatos',
                isCadastroNovo: false,
                inscricaoPropria: false,
                iniciarCadastro: false,
                possuiUnidade: false,
                escolaridade: new Form({
                    id: '',
                    membro_id: '',
                    nome_escola:'',
                    serie:'',
                    periodo:''
                }),
                endereco: new Form({
                    id: '',
                    origem_id: '',
                    origem: '',
                    cep:'',
                    logradouro:'',
                    numero:'',
                    bairro:'',
                    complemento:'',
                    referencia:'',
                    localidade:'',
                    uf:''
                }),
                dadosBasicos: new Form({
                    id: '',
                    nome:'',
                    data_nascimento: '',
                    idade:'',
                    sexo:'',
                    unidade:'',
                    estado_civil:'',
                    cpf: '',
                    rg: '',
                    certidao: '',
                    user_create: '',
                    user_id:''
                })
            }
        },
        methods: {
            iniciarInscricao(){
                this.dadosBasicos.reset();
                this.iniciarCadastro = true;
                this.inscricaoPropria = true;
                this.isCadastroNovo = true;
                this.etapa = 'dadosBasicos';

                this.etapas ={ dadosBasicos: true, documentos: false, escolaridade: false, contatos: false, responsaveis: false, fichadesaude: false, documentacao: false };
            },
            meInscrever(){
                this.iniciarInscricao();

                this.dadosBasicos.fill( {
                    nome: this.$gate.getNome(),
                    user_id: this.$gate.getId(),
                    user_create: this.$gate.getId()
                } );

            },
            outraInscricao(){
                this.iniciarInscricao();

                this.inscricaoPropria = false;
                this.dadosBasicos.fill( {
                    user_create: this.$gate.getId()
                } );
            },

            editarInscricao( membro ){
                this.iniciarInscricao();
                this.iniciarCadastro = true;
                this.inscricaoPropria = membro.id == this.$gate.getId();
                this.isCadastroNovo = false;
                this.etapas ={ dadosBasicos: true, documentos: true, escolaridade: true, contatos: true, responsaveis: true, fichadesaude: true, documentacao: true };
                this.dadosBasicos.fill( membro );
                this.carregarEscolaridade( membro );
                this.carregarEndereco( membro );
                this.membro = membro;
            },

            carregarResponsavel(){
                this.etapa = 'responsaveis';
                Fire.$emit( 'carregarResponsaveis', this.membro );
            },

            carregarInformacoesAdicionais(){
                this.etapa = 'informacoesAdicionais';
                Fire.$emit( 'carregarResponsaveis', this.membro );
            },

            cancelar(){
                swal.fire({
                    title: 'Deseja realmente sair?',
                    text: "Você perderá os dados não salvos de continuar.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, sair!',
                    cancelButtonText: 'Desistir'
                }).then((result) => {

                    if( result.value ){
                        this.dadosBasicos.reset();
                        this.iniciarCadastro = false;
                        this.inscricaoPropria = false;
                    }
                });
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
                if( !this.validateDadosBasicos() ){
                    return;
                }

                this.$Progress.start();
                this.dadosBasicos.post('api/membro')
                    .then( ( data ) => {
                        this.dadosBasicos.fill(data.data);
                        // this.isCadastroNovo = false;
                        this.etapas.documentos = true;
                        $('#navDocumentos').click();

                        toast.fire(
                            'Novo membro!',
                            'Dados do novo membro salvos com sucesso.',
                            'success'
                        );
                        this.$Progress.finish();
                    } )
                    .catch( () =>{
                        this.$Progress.fail();
                    })
                ;
            },
            updateMembro( e ){
                if( !this.validateDadosBasicos() ){
                    return;
                }

                this.$Progress.start();
                this.dadosBasicos.put('api/membro/' + this.dadosBasicos.id )
                    .then( ( data ) => {
                        this.dadosBasicos.fill(data.data);

                        toast.fire(
                            'Atualização!',
                            'Dados salvos com sucesso.',
                            'success'
                        );
                        this.$Progress.finish();
                    } )
                    .catch( () =>{
                        this.$Progress.fail();
                    })

            },

            saveEscolaridade(){
                this.$Progress.start();

                if( this.escolaridade.id && this.escolaridade.id > 0 ){
                    this.escolaridade.put('api/membro/escolariadade/' + this.escolaridade.id)
                        .then( ( data ) => {
                            this.escolaridade.fill(data.data);
                            this.etapas.contatos = true;
                            $('#navContatos').click();

                            toast.fire(
                                'Atualização!',
                                'Dados salvos com sucesso.',
                                'success'
                            );
                            this.$Progress.finish();
                        } )
                        .catch( () =>{
                            this.$Progress.fail();
                        });
                }else{
                    this.escolaridade.post('api/membro/escolariadade')
                        .then( ( data ) => {
                            this.escolaridade.fill(data.data);
                            this.etapas.contatos = true;
                            $('#navContatos').click();

                            toast.fire(
                                'Atualização!',
                                'Dados salvos com sucesso.',
                                'success'
                            );
                            this.$Progress.finish();
                        } )
                        .catch( () =>{
                            this.$Progress.fail();
                        });

                }
            },

            saveContatosMembro(){
                this.$Progress.start();
                this.saveEnderecoMembro()
                    .then( () => {
                        this.etapas.responsaveis = true;
                        $('#navResponsaveis').click();

                        toast.fire(
                            'Atualização!',
                            'Dados salvos com sucesso.',
                            'success'
                        );
                        this.$Progress.finish();
                    } )
                    .catch(( e ) =>{
                        console.log( e );
                        toast.fire(
                            'Erro!',
                            'Aconteceu algo na gravação dos contatos. Tente novamente',
                            'warning'
                        );
                        this.$Progress.fail();
                    });
            },

            saveEnderecoMembro(){
                if( this.endereco.id && this.endereco.id > 0 ){
                    return this.endereco.put('api/membro/endereco/' + this.endereco.id)
                        .then( ( data ) => {
                            this.endereco.fill(data.data);
                            Fire.$emit( 'saveContatos' );
                        } );
                }else{
                    return this.endereco.post('api/membro/endereco')
                        .then( ( data ) => {
                            this.endereco.fill(data.data);
                        } );
                }
            },

            validateDadosBasicos(){
                if(this.dadosBasicos.idade < 10){
                    swal.fire(
                        'Desculpe!',
                        'Não é permitida a inscrição de menores de 10 anos.',
                        'warning'
                    );
                    return false;
                }
                return true;
            },
            carregarEscolaridade( membro ){
                axios.get('api/membro/escolariadade/' + membro.id)
                    .then( ({ data }) => {
                        this.escolaridade.fill( data )
                        this.escolaridade.membro_id = this.dadosBasicos.id;
                    } );
            },
            carregarEndereco( membro ){
                axios.get('api/membro/endereco/' + membro.id)
                    .then( ({ data }) => {
                        this.endereco.fill( data )
                        this.endereco.origem_id = this.dadosBasicos.id;
                    } );
            },
            carregarEndereco( membro ){
                axios.get('api/membro/endereco/' + membro.id)
                    .then( ({ data }) => {
                        this.preencherEndereco( data );
                    } );
            },

            preencherEndereco( dadosEndereco ){
                this.endereco.fill( dadosEndereco )
                this.endereco.origem_id = this.dadosBasicos.id;
                this.endereco.origem = 'MEMBRO';
            },
            buscarCep( e ){
                let cep = e.target.value;

                if(/^[0-9]{5}-[0-9]{3}$/.test( cep )){
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/", (enderecoParam)=>{
                        console.log({ enderecoParam });
                        if(enderecoParam.erro){

                            $("#logradouro").focus();
                            return;
                        }
                        $("#numeroLogradouro").focus();
                        this.preencherEndereco( enderecoParam );

                        $("#inputNumero").focus();
                    });
                }
            }
        },
        mounted() {
        },
        created() {
            Fire.$on( 'editarMembro', ( membro ) =>{
                this.editarInscricao( membro );
            } );
        }
    }
</script>
