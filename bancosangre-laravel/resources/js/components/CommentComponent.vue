<template>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-header">Agregar observaciones </div>
                <br>
                <form action="" v-on:submit.prevent="newObservation()">
                <div class="form-group">
                    <input type="text" id="texto-observacion"
                     class="form-control tamaño-observacion" 
                     name="observation" v-model="content"
                    placeholder="El paciente... ">
                </div>
                <button type="submit" class="btn btn-success btn-block" >Agregar</button>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return{
                content:''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            newObservation() {
                let observation={
                    id: 1,
                    name: this.name,
                    content: this.content

                }
                this.$emit('new', observation);
                alert(this.content);
                this.content='';
            }
        }
    }
</script>
