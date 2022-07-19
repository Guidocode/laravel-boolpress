<template>
    <div class="container d-flex justify-content-center">

        <div class="card m-5" style="width: 30rem;">
            <img class="card-img-top" :src="post.image" :alt="post.title">
            <div class="card-body">

                <h5 class="card-title">{{post.title}}</h5>

                <h4 class="d-inline mr-2"><span class="badge bg-info text-dark">{{ post.category.name }}</span></h4>

                <h6 class="d-inline"><span class="badge badge-pill badge-secondary"
                v-for="tag in post.tags" :key="tag.id">{{ tag.name }}</span></h6>

                <p class="card-text">{{post.description}}</p>

                <router-link class="btn btn-primary" :to="{name: 'blog'}">torna indietro</router-link>
            </div>
        </div>

    </div>
</template>

<script>
import { apiUrl } from '../../data/api-url';

export default {
    name: 'PostShow',

    data(){
        return{
            post: {
                title: '',
                image: '',
                description: '',
                category: '',
                tags: []
            },

            apiUrl
        }
    },

    mounted(){
        this.getApi();
    },

    methods:{
        getApi(){
            axios.get(this.apiUrl + '/' + this.$route.params.slug)
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
