<template>
    <ol class="breadcrumb">
        <li><router-link :to="{ name: 'home' }">Home</router-link>
        <li class="active">{{ $route.meta.title }}</li>
    </ol>
</template>

<script>
export default {

}
</script>
