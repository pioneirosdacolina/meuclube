<template>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Olá {{nome}}!</div>

                    <div class="card-body">
                        <p>
                            Estamos felizes com o seu cadastro.
                        </p>
                        <p>
                            Essa é mais uma iniciativa com o propósito de melhorarmos nossa comunicação com pais,
                            desbravadores e amigos do nosso clube. Em breve, funções como notificações e agenda serão
                            disponibilizados nesse canal.
                        </p>
                        <p>
                            No momento, o seu perfil é de visitante. Isso quer dizer que, em breve, você terá acesso
                            as notificações citadas. Mas, se desejar, você pode fazer a Pré Inscrição sua ou de um dependente
                            no clube de desbravadores.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                nome: ''
            }
        },
        created(){
            axios.get('api/user');
                // .then( ({ data }) => ( this.users = data.data ) );
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
