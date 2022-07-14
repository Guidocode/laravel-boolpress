<template>
    <div class="global">

        <HeaderComp />


        <main>
            <router-view></router-view>
        </main>


        <FooterComp />

    </div>
</template>

<script>

import HeaderComp from './components/partials/HeaderComp.vue';
import FooterComp from './components/partials/FooterComp.vue';

export default {
    name: "App",

    components: { HeaderComp, FooterComp },



}
</script>

<style>

.global{
    height: 100vh;


}

</style>
