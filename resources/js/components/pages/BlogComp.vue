<template>

    <div class="container p-2 my-3">

        <!-- Loading comp -->
        <div class="d-flex justify-content-center m-5" v-if="posts == null">
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
                />
                <!-- SideBarComp -->


                <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            <div class="list-group mb-3">
                                <h2 class="title-content text-dark">Posts</h2>

                                <!-- PostItem -->
                                <PostItem
                                v-for="post in posts" :key="post.id"
                                :post="post"
                                />
                                <!-- PostItem -->

                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">...</div>
                        <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
                        <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
                    </div>


                    <!-- pagination -->
                    <nav aria-label="...">
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
                last: null,
                // prev: null,
                // next: null
            },

            // isActive: false
        };
    },
    methods: {
        getApi(page) {
            this.posts = null;
            Axios.get(this.apiUrl + "?page=" + page)
                .then(resp => {
                this.posts = resp.data.posts.data;
                this.paginate = {
                    current: resp.data.posts.current_page,
                    last: resp.data.posts.last_page,
                    // prev: resp.data.prev_page_url,
                    // next: resp.data.next_page_url,
                }

                this.categories = resp.data.categories;
                this.tags = resp.data.tags;

                console.log('sono io', resp.data);
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
