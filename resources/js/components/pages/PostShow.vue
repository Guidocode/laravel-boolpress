<template>
    <div class="container d-flex justify-content-center">

        <div class="card m-5" style="width: 18rem;">
            <img class="card-img-top" :src="post.image" :alt="post.title">
            <div class="card-body">
                <h5 class="card-title">{{post.title}}</h5>
                <p class="card-text">{{post.description}}}</p>
                <router-link class="btn btn-primary" :to="{name: 'blog'}">torna indietro</router-link>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: 'PostShow',

    data(){
        return{
            post: null,

            apiUrl: '/api/posts/'
        }
    },

    mounted(){
        this.getApi();
    },

    methods:{
        getApi(){
            axios.get(this.apiUrl + this.$route.params.slug)
            .then(resp =>{
                this.post = resp.data
                console.log(this.post);
            })
        }
    }
}
</script>

<style>

</style>
