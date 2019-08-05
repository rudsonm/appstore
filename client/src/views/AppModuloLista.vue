<template>
<div class="row offset-md-2 col-md-8" style="margin-top: 2rem">
    <div class="form-group col-md-8">
        <label for="modulo-nome">Nome do Módulo</label>
        <input type="text" class="form-control" id="modulo-nome" v-model='filtroNome'>        
    </div>
    <div class="form-group col-md-4">
        <label for="modulo-status">Status</label>
        <select class="form-control" id="exampleFormControlSelect1" v-model='filtroStatus'>
            <option value="TODOS" selected>Todos</option>
            <option value="NAO_CONTRATADO">Não Habilitado</option>
            <option value="ATIVADO">Ativado</option>
            <option value="DESATIVADO">Desativado</option>
        </select>
    </div>
    <app-modulo-card v-for='modulo in modulosFiltrados' v-bind:key='modulo.id' :modulo='modulo'></app-modulo-card>
</div>
</template>

<script>
import axios from 'axios'
import AppModuloCard from './AppModuloCard.vue'

export default {
    data() {
        return {
            modulos: [],
            filtroStatus: 'TODOS',
            filtroNome: ''
        }
    },
    mounted() {
        axios
            .get('http://localhost:8000/modulo')
            .then(response => this.modulos = response.data)
    },
    computed: {
        modulosFiltrados() {
            return this
                    .modulos
                    .filter(modulo => modulo.nome.toLowerCase().includes(this.filtroNome.toLowerCase()))
                    .filter(modulo => this.filtroStatus == 'TODOS' || this.filtroStatus == modulo.status)
        }
    },
    components: {
        appModuloCard: AppModuloCard
    }
}
</script>

<style>
body {
    background-color: #FAFAFA
}
</style>