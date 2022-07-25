<template>

    <div class="col-4">

        <!-- Sidebar categories -->
        <h4 class="mb-3">Ricerca per categorie</h4>
        <div class="list-group mb-5" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action" data-toggle="list" role="tab" aria-controls="home"
             v-for="category in categories" :key="category.id"
             @click="$emit('searchPostsByCategory', category.slug)">
                {{category.name}}
            </a>

        </div>
        <!-- Sidebar categories -->

        <!-- Sidebar tags -->
        <h4 class="mb-3">Ricerca per tags</h4>
        <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action " data-toggle="list" role="tab" aria-controls="home"
             v-for="tag in tags" :key="tag.id"
             @click="$emit('searchPostsByTag', tag.slug)">
                {{tag.name}}
            </a>
        </div>
        <!-- Sidebar tags -->

    </div>

</template>

<script>
export default {
    name: 'SideBar',

    props:{
        categories: Array,
        tags: Array,
    }
}
</script>

<style lang="scss" scoped>
a{
    cursor: pointer;
}
</style>
