<template>
    <div class="form-group">
        <h3>{{title}} <i class="fas fa-plus-circle green" @click="adicionaContato" style="cursor: pointer"></i></h3>
        <div class="col-sm-10" v-for="contato in filteredContatos" :key="contato.id">
            <the-mask :mask="['(##) ####-####', '(##) #####-####']" v-if="tipo == 'telefone'"
                      class="form-control col-sm-7 col-md-7 custom-control-inline" name="contatoTelefonico"
                      placeholder="(99) 99999-9999" v-model="contato.contato"/>
            <input type="email"  v-if="tipo == 'email'"
                   class="form-control col-sm-7 col-md-7 custom-control-inline" name="contatoPorEmail"
                   placeholder="contato@email.com" v-model="contato.contato"/>
            <i class="fas fa-trash-alt red" style="cursor: pointer" @click="removerContato(contato)"></i>
            <br />
            <br />
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            title: String,
            origem: String,
            tipo: String
        },

        data(){
            return {
                origemId: 0,
                contatos:[]
            }
        },

        methods : {
            removerContato( contato ){
                console.log('TODO colocar alerta confirmando a exclusão do contato.');

                contato.isDeleted = true;
                if( !contato.isNovo ){

                    contato.delete( 'api/contato/' + contato.id )
                        .then( (data) => {
                            toast.fire(
                                "Contato Apagado",
                                this.title + ' apagado com sucesso!',
                                "success"
                            );
                        } )
                        .catch(({ e }) => {

                            console.log(e);
                            toast.fire(
                                "Erro",
                                "Erro ao apagar " + this.title.toLowerCase() + ".",
                                "warning"
                            );
                            contato.isDeleted = false;
                        });
                }


            },

            adicionaContato(){
                let contato = new Form({
                    id: 0,
                    origem: this.origem,
                    origem_id: this.origemId,
                    tipo: this.tipo,
                    contato:'',
                    isNovo: true,
                    isDeleted: false
                });

                contato.origem_id = this.origemId;

                this.contatos.push( contato );
            },

            carregarContatos(){
                this.contatos = [];
                if(this.origemId && this.origemId > 0 ){
                    axios.get('api/contato/' + this.origem + '/' +  this.tipo + '/' + this.origemId)
                        .then( ({ data }) => {
                            data.filter( (contato) => { this.populateContato( contato ) } );
                            if( this.contatos.length == 0 ){ this.adicionaContato(); }
                        } );
                }else{
                    if( this.contatos.length == 0 ){ this.adicionaContato(); }
                }
            },

            populateContato( contato ){
                let fContato = new Form({
                    id: 0,
                    origem: this.origem,
                    origem_id: this.origemId,
                    tipo: this.tipo,
                    contato:'',
                    isNovo: false,
                    isDeleted: false
                });

                fContato.fill( contato );
                fContato.isNovo = false;
                this.contatos.push( fContato );
            },

            saveAllContatos(){
                this.saveContato( this.contatos );
            },

            saveContato( contatos ){
                let inserts = contatos.filter( (contato) => { return ( contato.isNovo && !contato.isDeleted && contato.contato.length > 0 ) } );
                let updates = contatos.filter( (contato) => { return ( !contato.isNovo && !contato.isDeleted ) } );

                inserts.filter( ( contato ) => this.insertContato( contato ) );
                updates.filter( ( contato ) => this.updateContato( contato ) );
            },

            insertContato( contato ){
                return contato.post('api/contato')
                    .then((data) => {
                        contato.fill(data.data);
                        contato.isNovo = false;
                        toast.fire(
                            "Contato Salvo",
                            this.title + ' salvo com sucesso!',
                            "success"
                        );
                    })
                    .catch(({ e }) => {
                        console.log(e);

                        toast.fire(
                            "Erro",
                            "Erro ao salvar " + this.title.toLowerCase() + ".",
                            "warning"
                        );
                    });
            },

            updateContato( contato ){
                return contato.put('api/contato/' + contato.id)
                    .then((data) => {
                        contato.fill(data.data);
                        toast.fire(
                            "Contato Salvo",
                            this.title + ' salvo com sucesso!',
                            "success"
                        );
                    })
                    .catch(({ e }) => {
                        console.log(e);
                        toast.fire(
                            "Erro",
                            "Erro ao salvar " + this.title.toLowerCase() + ".",
                            "warning"
                        );
                    });
            },

            alterarOrigemId( origemId ){
                this.origemId = origemId;
                console.log( { component: this.tipo, newOrigemId: this.origemId } );
            },

        },
        computed:{
            filteredContatos(){
                return this.contatos.filter( ( contato ) => {
                    return !contato.isDeleted;
                });
            }
        },

        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this.carregarContatos();
            Fire.$on( "saveContatos", () => {
                this.saveContato( this.contatos );
            } );
            Fire.$on( "alterarOrigemESalvarContatos", ( origemId ) => {
                this.origemId = origemId;

                console.log( 'Novo origemId:' + origemId );

                this.saveContato( this.contatos );
            } );
        }
    }
</script>
