<template>
    <div class="flex flex-col">
        <div class="p-2 mt-5 rounded-xl shadow  block h-[400px] relative ">
            <label 
            id="drop-zone" 
            v-on:drop="handleDrop" 
            for="csvInput" 
            class="h-full w-full  cursor-pointer bg-gray-50 rounded-xl border border-dashed flex flex-col justify-end items-center overflow-hidden"
            v-on:dragover.prevent 
            v-on:dragenter.prevent 
            >
                
                <div class="relative w-full px-4 py-4 border-t border-dashed bg-gray-100 text-gray-300 text-center">
                    <span class="z-10 relative">
                    <template v-if="progress == 0">Upload the XML file here</template>
                    <template v-if="progress > 0 && progress < 100">File is being uploaded</template>
                    <template v-if="progress == 100">File uploaded</template>
                    </span>
                    <div 
                    :style="{ right: (100 - progress) + '%' }"
                    class="absolute bg-gradient-to-r from-blue-800 via-blue-500 to-blue-600 left-0 top-0 bottom-0  z-0 "></div>
                </div>
            </label>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-36 stroke-gray-200 absolute left-[45%] top-[25%] pointer-events-none"> <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /> </svg>

            <!-- file input  -->
            <input id="csvInput" name="csv-file" type="file" accept=".xml" class="hidden" @change="changeFileState"/>
            
        </div>
        <div class="flex justify-center mt-8">
            <Link 
            href="/contacts"
            class="bg-gray-100 px-2 py-2 rounded-full shadow hover:shadow-lg transition ease-in-out duration-500 flex flex-row items-center" 
           > 
                 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 "> <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /> </svg>
            </Link>
        </div>
    </div>
</template>
<script setup>
import {ref, watch} from 'vue';
import {Link} from '@inertiajs/vue3';

const xmlFile = ref(null); // to store file to local storage.  
const chunkSize = 1024 // 16 byte 
const progress = ref(0) // for progressbar

//on file change action 
const changeFileState = async(event) => {
    let f = event.target.files[0] // assigning file to local variable 
    if(f && f.type === 'text/xml'){
        xmlFile.value = f
        chunkTheFile();
    }
    
};

//on drop
const handleDrop = (e) => {
    e.preventDefault();
    let f = e.dataTransfer.files[0]
    if(f && f.type === 'text/xml'){
        xmlFile.value = f
        chunkTheFile();
    }
    
}

//submit action 
const  chunkTheFile = async(e) =>{
    if(!xmlFile.value) return false;

    //storing local vue ref to normal variable
    const file = xmlFile.value;

    //total number of chunks, its required to calculate 
    // total number of iteration is required to fully upload 
    const numberOfChunks = Math.ceil(file.size / chunkSize);

    //its to hold the pointer for starting of chunk
    let start = 0;

    for(let chunkIndex = 0; chunkIndex < numberOfChunks; chunkIndex++){
        
        //this chunk is going to get uploaded 
        let chunk = file.slice(start,start + chunkSize);
        
        //move the start pointer, since we already collected the chunk for this iteration. 
        // So it should be ready for next iteration 
        start += chunkSize;

        await uploadFile(chunk,chunkIndex,numberOfChunks,file.name);
        progress.value = Math.round(((chunkIndex + 1) / numberOfChunks)*100);
        
    }

}

const uploadFile = async(chunk, chunkIndex, numberOfChunks, fileName) =>{
    const data =  new FormData();
    data.append('file',chunk);
    data.append('index',chunkIndex);
    data.append('total',numberOfChunks);
    data.append('fileName',fileName);
  
   await fetch('/submitFile',{
    method:"POST",
    headers:{"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")} ,
    body:data
   })
    
}

watch((progress),(newValue)=>{
    if(newValue === 100){
        
    }
})
</script>