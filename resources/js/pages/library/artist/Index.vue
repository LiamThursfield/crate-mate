<script lang="ts" setup>
import Pagination from '@/components/Pagination.vue';
import { Input } from '@/components/ui/input';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import myLibrary from '@/routes/my-library';
import { LibraryArtistResource, PaginatedResource } from '@/types/resources';
import { Head, router } from '@inertiajs/vue3';
import { useDebounceFn } from '@vueuse/core';
import { ref, watch } from 'vue';

const props = defineProps<{
    artists: PaginatedResource<LibraryArtistResource>;
    search?: string;
}>();

const search = ref(props.search || '');

const handleSearch = useDebounceFn((value: string) => {
    router.get(
        myLibrary.artist.index().url,
        { search: value || null },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        },
    );
}, 300);

watch(search, (value) => {
    handleSearch(value);
});

defineOptions({
    breadcrumbs: [
        {
            title: 'My Library',
        },
        {
            title: 'Artists',
            href: myLibrary.artist.index().url,
        },
    ],
});
</script>

<template>
    <Head title="Library Artist" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-hidden rounded-xl p-4"
    >
        <div class="flex items-center justify-between">
            <div class="w-full max-w-sm">
                <Input v-model="search" placeholder="Filter by name..." />
            </div>
        </div>

        <div class="rounded-md border">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Artist Name</TableHead>
                        <TableHead>Master Artist Name</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-if="artists.data.length === 0">
                        <TableCell colspan="2" class="h-24 text-center">
                            No artists found.
                        </TableCell>
                    </TableRow>
                    <TableRow v-for="artist in artists.data" :key="artist.id">
                        <TableCell class="font-medium">{{
                            artist.name
                        }}</TableCell>
                        <TableCell>{{
                            artist.canonical_artist?.name || '-'
                        }}</TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>

        <div class="mt-4 flex justify-end">
            <Pagination :links="artists.meta.links" />
        </div>
    </div>
</template>
