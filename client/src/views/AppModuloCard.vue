<template>
<div class="card" style="width: 15rem; margin: 0 1rem">    
    <img class="card-img-top" :src="modulo.icone" alt="Card image cap">
    <button type="button" class="btn btn-sm btn-primary"  disabled>{{ modulo.tipo }}</button>
    <div class="card-body">
        <h5 class="card-title"><b>{{ modulo.nome }}</b></h5>
        <p class="card-text">{{ modulo.tipo_pagamento }}</p>        
        <router-link :to="`/modulos/${modulo.id}`" class="btn btn-primary float-right">{{ definirAcaoStatus(modulo.status) }}</router-link>
    </div>    
</div>
</template>

<script>
export default {
    props: {
        modulo: {}
    },
    created() {
        this.definirAcaoStatus(this.modulo.status)
    },
    methods: {
        definirAcaoStatus(status) {
            switch(status) {
                case 'CONTRATADO':
                case 'DESATIVADO':
                    return 'Ativar'
                case 'ATIVADO':
                    return 'Desativar'
                default:
                    return 'Contratar'
            }
        }
    }
}
</script>