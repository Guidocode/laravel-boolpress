<template>

    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">{{post.title}}
            <router-link class="btn btn-warning font-italic m-1 py-0 px-1" :to="{name: 'show', params: {slug: post.slug}}">vedi dettagli</router-link>
        </h5>
        <small>{{formattingDate}}</small>
        </div>
        <p class="mb-1">{{limitDescription}}</p>
    </a>

</template>

<script>
import { computed } from 'vue'
export default {
    name: 'PostItem',

    props:{
        post: Object
    },

    computed:{
        limitDescription(){
            return this.post.description.substr(0, 30) + '...';
        },

        formattingDate(){
            const d = new Date(this.post.updated_at);
            let date = d.toLocaleString()

            return date;
        }

    }
}
</script>

<style lang="scss" scoped>

</style>
