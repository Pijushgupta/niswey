<script setup>
import { router} from '@inertiajs/vue3';
import { reactive } from 'vue';

// Props
const props = defineProps({
    contact: Object,
});
const formData = reactive({
    id: props.contact?.id || null,
    first_name : props.contact?.first_name || null,
    last_name: props.contact?.last_name || null,
    phone: props.contact?.phone || null
})

const submit = () =>{
    router.post('/save', formData);
}

</script>

<template>
<div class="max-w-2xl  ">
    <form @submit.prevent = "submit">
        <div class="flex flex-col mt-8">
            <input 
                type="text" 
                v-model="formData.first_name" 
                class="border w-full text-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full ps-10 p-2.5 mb-2"
                placeholder=" First Name"
            />
            <input 
                type="text" 
                v-model="formData.last_name" 
                class="border w-full text-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full ps-10 p-2.5 mb-2"
                placeholder="Last Name"
            />
            <input 
                type="text" 
                v-model="formData.phone" 
                class="border w-full text-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full ps-10 p-2.5 mb-2"
                placeholder="Phone"
            />
            <button type="submit" class="bg-blue-800 p-2 text-white rounded-lg">Save</button>
        
        </div>
        
    </form>
</div>
</template>