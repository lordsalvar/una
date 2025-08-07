<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Paginations/Pagination.vue'

defineProps({
    posts: Object,
})
</script>

<template>
    <Head title="posts" />

    <AppLayout>
        <div class="mx-auto w-full max-w-7xl space-y-6">
            <div class="flex gap-4">
                <div class="grow">
                    <h1 class="page-title">Posts</h1>
                </div>

                <div>
                    <Link :href="route('posts.create')" class="btn btn-link">
                        <i class="ri-add-line"></i>
                        Create
                    </Link>
                </div>
            </div>

            <div v-if="posts.data.length" class="card overflow-hidden">
                <div class="table-wrapperx">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Creator</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="post in posts.data" :key="post.id">
                                <tr>
                                    <td>
                                        <Link
                                            :href="route('posts.show', { post: post.id })"
                                            class="font-bold hover:underline hover:decoration-teal-500"
                                            v-text="post.title"
                                        ></Link>
                                    </td>
                                    <td v-text="post.type.label"></td>
                                    <td v-text="post.creator.name"></td>
                                    <td>
                                        <div v-text="post.created_at.date"></div>
                                        <div class="text-xs text-zinc-500" v-text="post.created_at.time"></div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            <div v-else>
                <div class="card">
                    <div class="card-body">
                        <div class="text-center text-zinc-500">No posts found</div>
                    </div>
                </div>
            </div>

            <Pagination :pagination="posts" />
        </div>
    </AppLayout>
</template>
