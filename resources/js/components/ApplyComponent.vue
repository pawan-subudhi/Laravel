<template>
    <div>
        <form @submit="formSubmit">
            <!-- if show is true then show apply button -->
            <button v-if="show" class="btn btn-success btn-block mt-3" type="submit">Apply</button>

            <!-- after clicking the button we make show value as false and  need to show a message that application sent successfully -->
            <div v-else class="alert alert-success">
                Application sent succesfully
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props:["jobid"],
        mounted() {
            console.log('Component mounted.')
        },
        // cutom i.e we wrote
        data(){
            return{
                'show':true
            }
        },
        methods:{
            formSubmit(e){
                e.preventDefault();//in order to restrict refereshing the browser or going to other link
                axios.post('/applications/'+ this.jobid,{

                }).then((response)=>{
                    this.show=false
                });
            }
        }
    }
</script>
