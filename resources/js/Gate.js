export default class Gate {
    constructor(user){
        this.user = user;
    }

    isVisitante() {
        return this.user.role === 'visitante';
    }

    isDesbravador(){
        return this.user.role === 'desbravador';
    }

    isResponsavel(){
        return this.user.role === 'responsavel';
    }

    isConselheiro(){
        return this.user.role === 'conselheiro';
    }

    isInstrutor(){
        return this.user.role === 'instrutor';
    }

    isAnciao(){
        return this.user.role === 'anciao';
    }

    isTesoureiro(){
        return this.user.role === 'tesoureiro';
    }

    isSecretaria(){
        return this.user.role === 'secretaria';
    }

    isDiretorAssociado(){
        return this.user.role === 'diretor_assoc';
    }

    isDiretor(){
        return this.user.role === 'diretor';
    }

    isAdministrador(){
        return this.user.role === 'administrador';
    }

    isDiretoria(){
        return this.user.role === 'anciao'
            || this.user.role === 'tesoureiro'
            || this.user.role === 'secretaria'
            || this.user.role === 'diretor_assoc'
            || this.user.role === 'diretor'
            || this.user.role === 'administrador'
            ;
    }

    getNome(){
        return this.user.name;
    }

    getId(){
        return this.user.id;
    }
}