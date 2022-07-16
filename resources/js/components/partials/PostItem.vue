<template>

    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">

            <h5 class="mb-1">
                <router-link class="btn btn-warning font-italic mb-1 py-0 px-1" :to="{name: 'show', params: {slug: post.slug}}">Vedi dettagli</router-link> <br>
                {{post.title}} <br>
                <small class="badge bg-info text-dark mr-2">
                    {{ post.category.name }}
                </small>

                <small class="badge badge-pill badge-secondary mr-1"
                 v-for="tag in post.tags" :key="tag.id">
                    {{ tag.name }}
                </small>
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
.badge{
    font-size: 10px;
}
</style>
