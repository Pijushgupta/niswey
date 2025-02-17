<script setup>
import Navbar from "./Navbar.vue";

</script>
<template>
    <Navbar/>
    <div class="px-5 container mx-auto">
        <div class="relative content">
            <slot/>
        </div>
    </div>
</template>