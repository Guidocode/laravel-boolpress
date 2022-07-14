<template>

    <div class="container p-5">

        <div class="list-group">
            <h2 class="title-content text-dark">Posts</h2>

            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start"
            v-for="post in posts" :key="post.id">
                <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{post.title}}</h5>
                <!-- <small>3 days ago</small> -->
                </div>
                <p class="mb-1">{{post.description}}</p>
            </a>
        </div>

    </div>

</template>

<script>
import Axios from 'axios';

export default {
    name: 'BlogComp',

    data() {
        return {
            apiUrl: "/api/posts",
            posts: []
        };
    },
    methods: {
        getApi() {
            Axios.get(this.apiUrl)
                .then(resp => {
                this.posts = resp.data.posts;
                console.log(this.posts);
            });
        }
    },
    mounted() {
        this.getApi();
    },
}
</script>

<style>

</style>
