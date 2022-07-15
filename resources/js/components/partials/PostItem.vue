<template>

    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">{{post.title}}
            <router-link class="btn btn-warning font-italic m-1 py-0 px-1" :to="{name: 'show', params: {slug: post.slug}}">vedi dettagli</router-link>
        </h5>
        <!-- <small>3 days ago</small> -->
        </div>
        <p class="mb-1">{{post.description}}</p>
    </a>

</template>

<script>
export default {
    name: 'PostItem',

    props:{
        post: Object
    }
}
</script>

<style lang="scss" scoped>

</style>
