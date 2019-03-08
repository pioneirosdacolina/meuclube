<template>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Componente dos responsáveis</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            Fire.$on( 'carregarResponsaveis', ( membro ) =>{
                this.carregarResponsaveis( membro );
            } );
        },
        methods:{
            carregarResponsaveis( membro ){
                console.log( { componente: 'Carregar responsáveis!', membro: membro } );
            }
        },
        created() {

        }

    }
</script>
