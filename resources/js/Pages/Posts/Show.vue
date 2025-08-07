<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
    post: Object,
})

const form = useForm()

function destroy() {
    form.delete(route('posts.destroy', { post: props.post.id }), {
        preserveScroll: true,
        preserveState: true,
        onBefore: () => confirm('Are you sure you want to delete this post?'),
    })
}
</script>

<template>
    <Head :title="post.title" />

    <AppLayout>
        <div class="mx-auto w-full max-w-xl space-y-6">
            <div class="flex gap-4">
                <div class="grow">
                    <h1 class="page-title">{{ post.title }}</h1>
                </div>

                <div>
                    <Link :href="route('posts.index')" class="btn btn-link">
                        <i class="ri-arrow-left-long-fill"></i>
                        Back
                    </Link>
                </div>
            </div>

            <div class="card">
                <div class="card-body space-y-4">
                    <div>
                        <div class="font-bold">Content</div>
                        <div v-html="post.content"></div>
                    </div>

                    <div>
                        <div class="font-bold">Type</div>
                        <div v-text="post.type.label"></div>
                    </div>

                    <div>
                        <div class="font-bold">Exclusive</div>
                        <div v-text="post.is_exclusive"></div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <Link :href="route('posts.edit', { post: post.id })" class="btn btn-primary">
                    <i class="ri-pencil-line"></i>
                    Edit
                </Link>

                <button type="button" :disabled="form.processing" class="btn btn-danger" @click="destroy">
                    <i class="ri-delete-bin-line"></i>
                    <span>Delete</span>
                </button>
            </div>
        </div>
    </AppLayout>
</template>
