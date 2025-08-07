<script setup>
import { computed, ref } from 'vue';
import { useForm, usePage} from '@inertiajs/vue3'

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
})


const page = usePage();

const error = computed(() => {
    let errors = page.props.errors

    return Object.keys(errors)
    .map((value) => {
        return erros [value] !== undefined ? erros[value] : null
    })
    .filter((error) => error) 
    .join('<br />')
    })

    let file = ref(),
    files = ref([])

    function onChange(){
        files.value = [...file.value.files]

        if(files.value.length) {
            upload()
        }
    }

    function dragoverOver(event) {
        event.preventDefault()
        if(!event.currentTarget.classlList.contains('bg-green-500')){
            event.currentTarget.classList.remove('bg-zince-500')
            event.currentTarget.classList.add('bg-green-500')
        }
    }

    function dragleave(event){
        event.currentTarget.classList.add('bg-zinc-500')
        event.currentTarget.classList.remove('bg-green-500')
    }

    function drop(event){
        event.preventDefault()
        file.value.files = event.dataTransfer.files
        onChange()

        event.currentTarget.classList.add('bg-zinc-500')
        event.currentTarget.classList.remove('bg-green-500')
    }

    const form = useForm({})


    function upload(){
        form.transform((data )=> ({
            ...data,
            images: files.value
        })).post(route('posts.attachments.store', { post: props.post.id }),{
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                document.querySelector('#images').value = ''
                files.value = []
            },
        
        })
    }
</script>


<template>
    <div>
        <div v-if="error" class="mb-2 text-sm text-rose-500" v-html="error"></div>
        <label
            class="hover:border-teal-950 dark:hover:border-teal-500 hover:ring-teal-950 dark:hover:ring-teal-500 block cursor-pointer rounded-lg border border-zinc-200 bg-white text-zinc-500 duration-150 select-none hover:ring-1 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:bg-zinc-950"
            @dragleave="dragleave"
            @dragover="dragover"
            @drop="drop"
        >
            <input
                ref="file"
                type="file"
                id="images"
                accept="image/jpg, image/jpeg, image/png"
                class="absolute h-px w-px overflow-hidden opacity-0"
                multiple
                @change="onChange"
            />
            <div class="card-body">
                <div class="py-4 text-center">
                    <div class="mb-4">
                        <i class="ri-upload-2-line text-teal-950 dark:text-teal-500 text-4xl"></i>
                    </div>
                    <div>
                        Drag the images
                        <span class="text-sm">(JPEG/PNG)</span>
                        you would like to upload in this card or
                        <u class="text-teal-950 dark:text-teal-500 font-bold">click this card</u>
                        to browse local files in your device.
                    </div>
                </div>
            </div>
        </label>
    </div>
</template>