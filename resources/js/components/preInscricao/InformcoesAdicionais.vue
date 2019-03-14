<template>
    <div class="container">
        <h3 class="card-title">Informa&ccedil;&otilde;es Adicionais</h3>
        <form @submit.prevent="editMode ? atualizarInformacoes() : criarInformacoes()">
            <div class="form-group">
                <label for="camiseta">Camiseta</label>
                <select name="camiseta" id="camiseta" v-model="informacoes.camiseta" class="form-control"
                        :class="{ 'is-invalide': informacoes.errors.has('camiseta')}">
                    <option value="">Escolha um Tamanho</option>
                    <option value="GI">GI</option>
                    <option value="PPA">PPA</option>
                    <option value="PA">PA</option>
                    <option value="MA">MA</option>
                    <option value="GA">GA</option>
                    <option value="GGA">GGA</option>
                    <option value="3G">3G</option>
                    <option value="4G">4G</option>
                </select>
                <has-error :form="informacoes" field="camiseta"></has-error>
            </div>
            <div class="form-group">
                <label for="batizadoSim">Batizado</label>
                <div class="mx-auto" style="width: 100%">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="batizadoRadioOptions" id="batizadoSim" value="SIM" v-model="informacoes.batizado" style="width: 0px">
                        <label class="btn" :class="{ 'btn-light': informacoes.batizado != 'SIM', 'btn-dark': informacoes.batizado == 'SIM', 'is-invalid' : informacoes.errors.has('batizado')}" for="batizadoSim">SIM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="batizadoRadioOptions" id="batizadoNao" value="NAO" v-model="informacoes.batizado" style="width: 0px">
                        <label class="btn" :class="{ 'btn-light': informacoes.batizado != 'NAO', 'btn-dark': informacoes.batizado == 'NAO', 'is-invalid' : informacoes.errors.has('batizado')}" for="batizadoNao">N&Atilde;O</label>
                    </div>
                    <has-error :form="informacoes" field="batizado"></has-error>
                </div>
            </div>
            <div class="form-group">
                <label for="religiao">Religi&atilde;o</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="religiao" placeholder="Religião" v-model="informacoes.religiao"
                           :class="{ 'is-invalid' : informacoes.errors.has('religiao') }">
                    <has-error :form="informacoes" field="religiao"></has-error>
                </div>
            </div>
            <div class="form-group">
                <label for="transferenciaSim">Veio de Outro Clube</label>
                <div class="mx-auto" style="width: 100%">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="outro_clubeRadioOptions" id="outro_clubeSim" value="SIM" v-model="informacoes.outro_clube" style="width: 0px">
                        <label class="btn" :class="{ 'btn-light': informacoes.outro_clube != 'SIM', 'btn-dark': informacoes.outro_clube == 'SIM', 'is-invalid' : informacoes.errors.has('outro_clube')}" for="outro_clubeSim">SIM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="outro_clubeRadioOptions" id="outro_clubeNao" value="NAO" v-model="informacoes.outro_clube" style="width: 0px">
                        <label class="btn" :class="{ 'btn-light': informacoes.outro_clube != 'NAO', 'btn-dark': informacoes.outro_clube == 'NAO', 'is-invalid' : informacoes.errors.has('outro_clube')}" for="outro_clubeNao">N&Atilde;O</label>
                    </div>
                    <has-error :form="informacoes" field="outro_clube"></has-error>
                </div>
            </div>
            <div class="form-group" v-if="informacoes.outro_clube == 'SIM'">
                <label for="nome_clube">Nome do outro clube</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nome_clube" placeholder="Nome do clube" v-model="informacoes.nome_clube"
                           :class="{ 'is-invalid' : informacoes.errors.has('nome_clube') }">
                    <has-error :form="informacoes" field="nome_clube"></has-error>
                </div>
            </div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" v-if="editMode" class="btn btn-success">Atualizar</button>
            <button type="submit" v-if="!editMode" class="btn btn-primary">Salvar</button>

        </form>
    </div>
</template>

<script>
    export default {
        props:[ 'membro' ],
        data(){
            return{
                editMode: false,
                informacoes: new Form({
                    id: '',
                    membros_id: '',
                    camiseta: '',
                    batizado: '',
                    religiao: '',
                    outro_clube: '',
                    nome_clube: ''
                })
            };
        },

        mounted(){
            console.log( 'Component mounted.' );
            console.log( { component: 'InformacoesAdicionais', action: "monted", dados: this.membro } );
            this.carregarInformacoes();

            this.informacoes.membros_id = this.membro.id;
        },

        methods:{
            atualizarInformacoes(){
                this.$Progress.start();
                this.informacoes.put( '/api/informacoesAdicionais/' + this.membro.id )
                    .then( ( { data } ) => {
                        console.log( data );
                        toast.fire(
                            'Salvo!',
                            'Dados salvos com sucesso.',
                            'success'
                        );
                        this.$Progress.finish();
                    } )
                    .catch( ( { e } ) => {
                        toast.fire(
                            'Erro!',
                            'Ocorreu um erro ao salvar os dados. Tente novamente',
                            'warning'
                        );
                        this.$Progress.fail();
                    } );
            },
            criarInformacoes(){
                this.$Progress.start();
                this.informacoes.post( '/api/informacoesAdicionais/' )
                    .then( ( { data } ) => {
                        this.editMode = true;

                        toast.fire(
                            'Salvo!',
                            'Dados salvos com sucesso.',
                            'success'
                        );
                        this.$Progress.finish();
                    } )
                    .catch( ( { e } ) => {
                        this.editMode = false;
                        toast.fire(
                            'Erro!',
                            'Ocorreu um erro ao salvar os dados. Tente novamente',
                            'warning'
                        );
                        this.$Progress.fail();
                    } );
            },
            carregarInformacoes(){
                this.$Progress.start();
                axios.get( '/api/informacoesAdicionais/' + this.membro.id )
                    .then( ( { data } ) => {
                        console.log( data );
                        this.informacoes.fill( data );
                        this.editMode = true;
                        this.$Progress.finish();
                    } )
                    .catch( ( { e } ) => {
                        this.editMode = false;
                        toast.fire(
                            'Erro!',
                            'Ocorreu um erro ao carregar os dados. Tente novamente',
                            'warning'
                        );
                        this.$Progress.fail();
                    } );
            }
        },

        created() {
            console.log( { component: 'InformacoesAdicionais', action: "created", dados: this.membro } )
        }
    }
</script>
