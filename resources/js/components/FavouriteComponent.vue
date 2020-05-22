<template>
    <div>
        <button v-if="show" @click.prevent="unsave()" class="btn btn-primary btn-block mt-3">Unsave</button>

        <button v-else @click.prevent="save()" class="btn btn-dark btn-block mt-3">Save</button>
    </div>
</template>

<script>
    export default {
        // parameter passed to the component
        props:['jobid','favourited'],
        mounted() {
            console.log('Component mounted.')
        },
        // cutom i.e we wrote
        data(){
            return{
                'show':true
            }
        },
        mounted(){
            this.show =  this.jobFavourited ? true :false;
        },
        computed:{
            jobFavourited(){
                return this.favourited
            }
        },
        methods:{
            //try to save data into database
            save(){
                axios.post('/save/'+ this.jobid).then(response=>this.show=true).catch(error=>alert('error'));
            },
            unsave(){
                axios.post('/unsave/'+ this.jobid).then(response=>this.show=false).catch(error=>alert('error'));
            }
        }
    }
</script>
