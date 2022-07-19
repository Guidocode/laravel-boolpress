<template>

    <div class="container bg-light p-2 my-3 content">

        <!-- Loading comp -->
        <div class="d-flex justify-content-center mt-5" v-if="!posts">
            <LoadingComp />
        </div>
        <!-- Loading comp -->



        <!-- SideBar e lista post -->
        <div v-else>
            <div class="row">

                <!-- SideBarComp -->
                <SideBar
                :categories="categories"
                :tags="tags"
                @searchPostsByCategory="searchPostsByCategory"
                @searchPostsByTag="searchPostsByTag"
                />
                <!-- SideBarComp -->


                <div class="col-8">
                    <h2 class="title-content text-dark">Post {{searchType}}</h2>
                    <div class="tab-content  posts-list mb-3" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

                            <div v-if="posts.length != 0" class="list-group mb-3">


                                <!-- PostItem -->
                                <PostItem
                                v-for="post in posts" :key="post.id"
                                :post="post"
                                />
                                <!-- PostItem -->

                            </div>

                            <!-- non funziona!!! -->
                            <div v-else>
                                <h6 class="text-danger">Nessun post presente</h6>
                            </div>

                        </div>
                    </div>


                    <!-- pagination -->
                    <nav v-if="showPaginate" aria-label="...">
                        <ul class="pagination">

                            <li class="page-item"
                            @click="getApi(paginate.current - 1)">
                                <button class="page-link" href="#"
                                :disabled = "paginate.current === 1">Indietro</button>
                            </li>

                            <li class="page-item"
                            v-for="p in paginate.last" :key="p"
                            @click="getApi(p)"
                            :class="{active: paginate.current == p}">
                                <a class="page-link" href="#">{{p}}</a>
                            </li>

                            <li class="page-item"
                            @click="getApi(paginate.current + 1)">
                                <button class="page-link" href="#"
                                :disabled = "paginate.current === paginate.last">Avanti</button>
                            </li>

                        </ul>
                    </nav>
                    <!-- /pagination -->

                </div>
            </div>
        </div>
        <!-- SideBar e lista post -->

    </div>

</template>

<script>
import Axios from 'axios';
import PostItem from '../partials/PostItem.vue';
import LoadingComp from '../partials/LoadingComp.vue';
import SideBar from '../partials/SideBar.vue';
import { apiUrl } from '../../data/api-url';

export default {
    name: "BlogComp",

    components: { PostItem, LoadingComp, SideBar },

    data() {
        return {
            apiUrl,

            posts: null,
            categories: [],
            tags: [],

            paginate: {
                current: null,
                last: null
            },
            showPaginate: false,
            searchType: ''


        };
    },
    methods: {
        getApi(page) {
            this.searchType = ''
            this.posts = null;
            axios.get(this.apiUrl + "?page=" + page)
                .then(resp => {
                this.posts = resp.data.posts.data;
                this.paginate = {
                    current: resp.data.posts.current_page,
                    last: resp.data.posts.last_page
                }

                this.showPaginate = true;
                this.categories = resp.data.categories;
                this.tags = resp.data.tags;

                console.log('sono io', resp.data);
            });
        },

        searchPostsByCategory(slug_category){

            this.showPaginate = false;
            console.log(slug_category);
            axios.get(this.apiUrl + '/post-category/' + slug_category)
            .then(resp => {
                this.posts = resp.data.posts;
                this.searchType = resp.data.name
                console.log(resp.data.posts);
            })
        },
        searchPostsByTag(slug_tag){

            this.showPaginate = false;
            console.log(slug_tag);
            axios.get(this.apiUrl + '/post-tag/' + slug_tag)
            .then(resp => {
                this.posts = resp.data.posts;
                this.searchType = resp.data.name
                console.log(resp.data.posts);
            })
        }
    },
    mounted() {
        this.getApi(1);
    }
}
</script>

<style lang="scss" scoped>
.content{
    height: 700px;

    .posts-list{
        height: 527px;
        overflow-y: auto;
    }
}
</style>
