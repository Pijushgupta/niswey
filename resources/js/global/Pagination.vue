<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({links:Object, margin:Number});

</script>
<template>
<nav aria-label="Page navigation " >
    
    <ul class="inline-flex -space-x-px text-sm">
      <li v-for="(link,index) in links" :key="index">
        <Link
          :href="link.url || '#'"
          v-if="!link.active && index !== 0 && index !== links.length - 1"
          class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        >
          {{ link.label }}
        </Link>

        <!-- Active button -->
        <Link
          :href="link.url || '#'"
          v-else-if="link.active && index !== 0 && index !== links.length - 1"
          class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
        >
          {{ link.label }}
        </Link>

        <!-- Prev button -->
        <Link
          :href="link.url || '#'"
          v-else-if="index === 0"
          class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        >
          Prev
        </Link>

        <!-- Next button -->
        <Link
          :href="link.url || '#'"
          v-else-if="index === links.length - 1"
          class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        >
          Next
        </Link>
      </li>
    </ul>

  </nav>
</template>