<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <getobservation-component 
                v-for="observation in observations"
                :key="observation.id"
                :observation="observation"
                >
                </getobservation-component>
                    <br>
                <comment-component @new="addObservation">  </comment-component> 
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return  {
                observations: [{'id':1,
                'patient_id':1,
                 'name': 'martin',
                 'content':'omelette du frommage'}]
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        methods:{
            addObservation(observation){
                this.observations.push(observation);
            }
        }
    }
</script>