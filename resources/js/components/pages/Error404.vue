<template>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center">
            <h1 class="display-1 fw-bold alert alert-danger">Errore 404</h1>
            <p class="fs-3"> <span class="text-danger">Opps!</span> Pagina non trovata :(</p>
            <p class="lead">
                La pagina che stai guardando non esiste.
            </p>
            <router-link class="btn btn-primary" :to="{name: 'blog'}">Torna ai post</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Error404'
}
</script>

<style>

</style>
