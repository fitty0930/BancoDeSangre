<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header"> Publicado por {{observation.name}} </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>{{observation.content}}</p>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-danger">
                            Eliminar
                        </button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['observation'],

        data(){
            return  {
                
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
