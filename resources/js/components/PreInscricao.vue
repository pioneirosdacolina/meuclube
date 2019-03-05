<template>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header"><h1>Pr&eacute; Inscri&ccedil;&atilde;o</h1></div>
                    <div class="card-body">
                        <h3>
                            Ol&aacute; {{$gate.getNome()}}!
                        </h3>
                        <p>
                            Gostar&iacute;amos de melhorar a sua experi&ecirc;ncia e rela&ccedil;&atilde;o com nosso clube em todos os aspectos.
                            Por isso, a partir de 2019, vamos disponibilizar a Pr&eacute; Inscri&ccedil;&atilde;o Online
                            como forma de agilizar o processo da sua inscri&ccedil;&atilde;o ou do seu dependente. Isso lhe ajudar&aacute;
                            a evitar filas e/ou diversas idas para regularizar a sua inscri&ccedil;&atilde;o.
                        </p>
                        <h4>
                            Como funciona?
                        </h4>
                        <p>
                            O processo &eacute; simples:
                        </p>
                        <ol>
                            <li>Voc&ecirc; preenche a ficha de inscri&ccedil;&atilde;o (id&ecirc;ntica a manuscrita)</li>
                            <li>Responde tamb&eacute;m a ficha m&eacute;dica</li>
                            <li>Faz o upload dos documentos necess&aacute;rios para a inscri&ccedil;&atilde;o (opcional)</li>
                            <li>Faz o upload do comprovante de pagamento da inscri&ccedil;&atilde;o (opcional)</li>
                        </ol>
                        <p>
                            No pr&oacute;ximo domingo de reuni&atilde;o, comparece a sede do clube, e a ficha do inscrito
                            j&aacute; estar&aacute; impressa pronta para assinar.
                        </p>
                        <p>
                            Caso tenha optado por n&atilde;o subir os documentos, estes dever&atilde;o ser entregues juntamente com a 
                            ficha assinada. A mesma coisa acontece acontece com o pagamento da inscri&ccedil;&atilde;o.
                        </p>
                        <h4>
                            Documentos Necess&aacute;rios
                        </h4>
                        <p>
                            Os documentos obrigat&oacute;rios para a inscri&ccedil;&atilde;o s&atilde;o:
                        </p>
                        <ol>
                            <li>RG autenticado do DESBRAVADOR</li>
                            <li>CPF do DESBRAVADOR</li>
                            <li>Carteira de vacina&ccedil;&atilde;o do DESBRAVADOR</li>
                            <li>SUS do DESBRAVADOR</li>
                            <li>Comprovante de resid&ecirc;cia</li>
                            <li>Carteira do conv&ecirc;nio (se tiver)</li>
                            <li>RG e CPF do respons&aacute;vel</li>
                        </ol>

                        <p>
                            Lembrando que, se voc&ecirc; j&aacute; &eacute; veterano, os documentos abaixo são imprescend&iacute;veis:
                        </p>
                        <ol>
                            <li>RG autenticado do DESBRAVADOR </li>
                            <li>Comprovante de resid&ecirc;cia</li>
                        </ol>
                        <h4>
                            Dados para transfer&ecirc;cia
                        </h4>
                        <p>
                            As contas abaixo pertencem &agrave; Igreja Unasp - Uni&atilde;o Central Brasileira
                        </p>
                        <ul>
                            <li>Bradesco: Ag: 3396-0, C/c: 2226-8</li>
                            <li>Banco do Brasil: Ag: 1740-X. C/c: 18.823-9</li>
                            <li>Banco Santander: Ag: 3719, C/c: 13000048-0</li>
                            <li>Banco Itaú: Ag: 1661, C/c: 11480-9</li>
                        </ul>
                        <blockquote>
                            <strong>
                                Enviar comprovante at&eacute; sexta feira às 12h (meio-dia) da SEMANA DA OPERA&Ccedil;&Atilde;O para
                                <a href="mailto:tesouraria@pioneirosdacolina.com.br">tesouraria@pioneirosdacolina.com.br</a> e acrescentar as seguintes informa&ccedil;&otilde;es:</strong>
                            <br> Nome do desbravador / Unidade / Telefone para Contato / Valor Referente a: <strong>INSCRI&Ccedil;&Atilde;O</strong>
                            <br> OU
                            <br> Fa&ccedil;a o Upload do mesmo pelo nosso sistema.
                        </blockquote>
                        <h4 class="red">
                            <i class="fas fa-exclamation"></i> ATEN&Ccedil;&Atilde;O
                        </h4>
                        <p>
                            Todos os documentos precisam estar v&aacute;lidos e leg&iacute;veis. Por isso, utilize um boa
                            resolu&ccedil;&atilde;o do seu scanner ou da sua c&acirc;mera fotogr&aacute;fica. O seus documentos
                            s&oacute; ser&atilde;o aceitos ap&oacute;s a avalia&ccedil;&atilde;o da secretaria. Por garantia,
                            mesmo que voc&ecirc; tenha feito Upload da mesma, leve os documentos no dia de efetivar a sua
                            inscri&ccedil;&atilde;o.
                        </p>
                    </div>
                    <button @click="adicionarMembro" class="btn btn-primary">Tudo Certo. Vamos começar <i class="fas fa-arrow-circle-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods:{
            adicionarMembro(){
                this.$router.push('/adicionarMembro')
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
