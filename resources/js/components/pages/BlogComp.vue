<template>

    <div class="container p-2 my-3">

        <div class="d-flex justify-content-center m-5" v-if="posts == null">
            <LoadingComp />
        </div>

        <div v-else>

            <div class="list-group mb-3">
                <h2 class="title-content text-dark">Posts</h2>

                <PostItem
                v-for="post in posts" :key="post.id"
                :post="post"
                />
            </div>


            <!-- pagination -->
            <nav aria-label="...">
                <ul class="pagination">

                    <li class="page-item"
                    @click="getApi(paginate.current - 1)">
                        <a class="page-link" href="#"
                        :disabled = "paginate.current === 1">Indietro</a>
                    </li>

                    <li class="page-item"
                    v-for="p in paginate.last" :key="p"
                    @click="getApi(p)"
                    :class="{active: paginate.current == p}">
                        <a class="page-link" href="#">{{p}}</a>
                    </li>

                    <li class="page-item"
                    @click="getApi(paginate.current + 1)">
                        <a class="page-link" href="#"
                        :disabled = "paginate.current === paginate.last">Avanti</a>
                    </li>

                </ul>
            </nav>
            <!-- /pagination -->
        </div>
    </div>

</template>

<script>
import Axios from 'axios';
import PostItem from '../partials/PostItem.vue';
import LoadingComp from '../partials/LoadingComp.vue';

export default {
    name: "BlogComp",

    components: { PostItem, LoadingComp },

    data() {
        return {
            apiUrl: "/api/posts",
            posts: null,
            paginate: {
                current: null,
                last: null,
                // prev: null,
                // next: null
            },

            isActive: false
        };
    },
    methods: {
        getApi(page) {
            this.posts = null;
            Axios.get(this.apiUrl + "?page=" + page)
                .then(resp => {
                this.posts = resp.data.data;
                this.paginate = {
                    current: resp.data.current_page,
                    last: resp.data.last_page,
                    // prev: resp.data.prev_page_url,
                    // next: resp.data.next_page_url,
                }

                // console.log(this.paginate.prev);
                // console.log(this.paginate.next);
            });
        }
    },
    mounted() {
        this.getApi(1);
    },

}
</script>

<style>

</style>
