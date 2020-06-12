<template>
    <div>
        <div class="card card-header">
            <h2> observaciones </h2>
        </div>
        
        <div class="card card-body" v-for="observation in observations" v-bind:key="observation.id">
            <h4> {{observation.name}}</h4>
            <p> {{observation.content}}</p>
            <button @click="deleteObservation(observation.id)"> Borrar </button>
        </div>
        <!-- FORMULARIO PARA AGREGAR OBSERVACION -->
        <div class="card card-footer">
            <form @submit.prevent="addObservation">
                <div class="form-group">
                    <textarea type="text" class="form-control" placeholder="algun texto" v-model="observation.content">

                    </textarea>
                </div>
                <button type="submit"> Agregar observacion </button>
            </form>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                observations:[],
                observation:{
                    id:'',
                    name:'',
                    content:''

                }
            }
        },

        created(){
            this.fetchObservations();
        },

        methods:{
            fetchObservations(){
                fetch('api/observations')
                .then(res=> res.json())
                .then(data=>{
                    this.observations= data;
                    console.log(data);
                });
            },

            deleteObservation(id){
                if(confirm('¿Estas Seguro?')){
                    fetch(`api/observations/${id}`,{
                        method:'delete'
                    })
                    .then(res=> res.json())
                    .then(data=>{
                        fetchObservations();
                    })
                    .catch(err=> console.log(err));
                }
            },

            addObservation(){
                fetch('api/observations',{
                    method: 'post',
                    body: JSON.stringify(this.observation),
                    headers: {
                        'content-type':'application/json'
                    }
                })
                .then(res=> res.json())
                .then(data=>{
                    this.observation.content=''
                    alert("agregado")
                })
                .catch(err=> console.log(err));
            }
        }
    }
</script>
