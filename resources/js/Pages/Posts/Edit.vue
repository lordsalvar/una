<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Checkbox, InputLabel, InputError, SelectInput, TextInput, TextareaInput } from '@/Components/Forms'

const props = defineProps({
    post: Object,
    types: Array,
})

const form = useForm({
    title: props.post.title,
    content: props.post.content,
    type: props.post.type.key,
    is_exclusive: props.post.is_exclusive,
})

function submit() {
    form.put(route('posts.update', { post: props.post.id }), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => form.reset(),
    })
}
</script>

<template>
    <Head title="Edit Post" />

    <AppLayout>
        <div class="mx-auto w-full max-w-xl space-y-6">
            <div class="flex gap-4">
                <div class="grow">
                    <h1 class="page-title">Edit Post</h1>
                </div>

                <div>
                    <Link :href="route('posts.index')" class="btn btn-link">
                        <i class="ri-arrow-left-long-fill"></i>
                        Back
                    </Link>
                </div>
            </div>

            <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                <div class="card">
                    <div class="card-body space-y-4">
                        <div>
                            <InputLabel value="Title" for="title" />
                            <TextInput id="title" v-model="form.title" class="w-full" required />
                            <InputError :message="form.errors.title" />
                        </div>

                        <div>
                            <InputLabel value="Content" for="content" />
                            <TextareaInput id="content" v-model="form.content" class="w-full" required />
                            <InputError :message="form.errors.content" />
                        </div>

                        <div>
                            <InputLabel value="Type" for="type" />
                            <SelectInput id="type" v-model="form.type" class="w-full" required>
                                <option value=""></option>
                                <option v-for="type in types" :key="type.key" :value="type.key" v-text="type.label"></option>
                            </SelectInput>
                        </div>

                        <div>
                            <InputLabel value="Exclusive" for="is-exclusive" />
                            <Checkbox id="is-exclusive" v-model:checked="form.is_exclusive" name="is_exclusive" />
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" :disabled="form.processing" class="btn btn-primary">
                        <i class="ri-save-line"></i>
                        <span>Submit Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>