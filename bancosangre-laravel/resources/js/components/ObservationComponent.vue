<template>
    <div>
        <div class="card card-header">
            <h2> Observaciones </h2><small> para futuras donaciones </small>
        </div>
        
        <div class="card card-body" v-for="observation in observations" v-bind:key="observation.id">
            <h4> {{observation.name}}</h4>
            <p> {{observation.content}}</p>
            <div v-if="admin">
                 <button class="btn btn-danger btn-block" @click="deleteObservation(observation.id)"> Borrar </button>
            </div>
        </div>
        <!-- FORMULARIO PARA AGREGAR OBSERVACION -->
        <!-- FORM TO ADD OBSERVATION  -->
        <div class="card card-footer">
            <form @submit.prevent="addObservation">

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="" 
                    v-model="observation.name" value="" name="name" readonly>
                </div>

                <div class="form-group">
                    <textarea type="text" name="content" class="form-control" 
                    placeholder="algun texto" v-model="observation.content">
                    </textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block"> Agregar observacion </button>
            </form>
        </div>
    </div>
</template>

<script>
    export default{
        props : ['user','userrole'],
        data(){
            return{
                observations:[],
                observation:{
                    id:'',
                    name:this.user.name,
                    content:''
                },
                admin: this.userrole
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
                    .then(()=>{
                        this.fetchObservations();
                        
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
                .then(()=>{
                    this.observation.content=''
                    this.fetchObservations();
                    alert("agregado")
                })
                .catch(err=> console.log(err));
            }
        }
    }
</script>
