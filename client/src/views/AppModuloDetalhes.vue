<template>
<div class="offset-md-2 col-md-8" style="margin-top: 2rem">
    <div class="card mb-3">
        <div class="card-body">
            <h3 class="card-title"><b>{{ modulo.nome }}</b></h3>
            <div class="row">
                <div class="col-md-2">
                    <img class="card-img-top" :src="modulo.icone" alt="Imagem de capa do card">
                </div>
                <div class="col-md-10">
                    <p class="card-text">{{ modulo.tipo_pagamento }}</p>
                    <span class="badge badge-pill badge-primary">{{ modulo.tipo }}</span>                    
                    <div class="float-right">
                        <button class="btn btn-primary" @click='alterarStatus(modulo.status)'>{{definirAcaoStatus(modulo.status)}}</button>
                    </div>                    
                </div>
            </div>        
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            modulo: null
        }
    },
    created() {
        let id = this.$route.params.id
        axios
            .get('http://localhost:8000/modulo/' + id)
            .then(response => this.modulo = response.data)
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
        },
        alterarStatus(status) {
            switch(status) {
                case 'NAO_CONTRATADO':
                case 'DESATIVADO':
                    this.salvarStatusAlterado('ATIVADO')
                break
                case 'ATIVADO':
                    this.salvarStatusAlterado('DESATIVADO')
                break
            }
        },
        salvarStatusAlterado(status) {
            let modulo = this.modulo
            modulo.status = status
            axios.put('http://localhost:8000/modulo/' + modulo.id, modulo)
                 .then(response => response.data.status)
                 .then(() => this.$router.push('/modulos'))
        }
    }
}
</script>