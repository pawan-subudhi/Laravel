<template>
    <div>
        <input type="text" v-model="keyword" placeholder="what are you looking for?" v-on:keyup="SearchJobs()" class="form-control">
        <div class="card-footer" v-if="results.length">
            <ul class="list-group">
                <li class="list-group-item" v-for="result in results">
                    <a style="color:#000;" :href=" '/jobs/'+result.id+'/'+result.slug+'/' ">
                        {{result.title}}
                        <br>
                        <small class="badge badge-success">{{result.position}}</small>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return{
                keyword:'',
                results:[], 
            }
        },
        methods:{
            SearchJobs(){
                this.results = [];
                if(this.keyword.length>1){
                    axios.get('/jobs/search',{params:{keyword:this.keyword}}).then(response=>{
                        this.results = response.data;
                    });
                }
            }
        }
    }
</script>
