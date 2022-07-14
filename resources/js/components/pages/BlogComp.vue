<template>

    <div class="container p-5">

        <div class="list-group">
            <h2 class="title-content text-dark">Posts</h2>

            <PostItem
            v-for="post in posts" :key="post.id"
            :post="post"
            />
        </div>

    </div>

</template>

<script>
import Axios from 'axios';
import PostItem from '../partials/PostItem.vue';

export default {
    name: "BlogComp",

    components: { PostItem },

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
