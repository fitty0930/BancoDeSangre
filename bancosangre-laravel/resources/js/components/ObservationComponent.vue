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
                    fetch('api/observations/${id}',{
                        method:'DELETE'
                    })
                    .then(res=> res.json())
                    .then(data=>{
                        this.fetchObservations();
                    })
                    .catch(err=> console.log(err));
                }
            }
        }
    }
</script>
