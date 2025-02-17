<script setup>

import Pagination from '@/global/Pagination.vue';
import { Link } from '@inertiajs/vue3'
const props = defineProps(
    {
        posts: Object,

    }
)

const links = props.posts.links;

</script>
<template>
    <div class="flex flex-row justify-between">
        <Link href="/" class="border rounded-lg mb-2 "> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 p-1"> <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /> </svg> </Link>

        <Link href="/edit" class="border rounded-lg mb-2"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 p-1"> <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /> </svg> </Link>
    </div>
    
    <template v-if="posts.data && posts.data.length > 0">
        
        <div class="relative overflow-y-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="post in posts.data" :key="post.id"
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex flex-col">
                                {{ post.first_name + ' ' + post.last_name }}
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            {{ post.phone }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="mr-2">
                                <Link :href="`/edit?id=${post.id}`">
                                    Edit
                                </Link>
                                
                            </span>
                            <span>
                                <Link :href="`/delete?id=${post.id}`">
                                    Delete
                                </Link>
                            </span>
                        </tD>
                    </tr>
                </tbody>
            </table>
        </div>
        <Pagination :links="links" class="flex flex-row justify-end my-4" />
    </template>

    <div>
        
    </div>




</template>