<template>
    <header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link class="nav-link" :to="{name: 'home'}">Home</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link class="nav-link" :to="{name: 'blog'}">Blog</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link class="nav-link" :to="{name: 'about'}">Chi siamo</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link class="nav-link" :to="{name: 'contacts'}">Contatti</router-link>
                    </li>
                </ul>
            </div>
        </nav>

    </header>
</template>

<script>


export default {
    name: 'HeaderComp'
}
</script>

<style>

</style>
