<script lang="ts" setup>
import Pagination from '@/components/Pagination.vue';
import { Input } from '@/components/ui/input';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import myLibrary from '@/routes/my-library';
import {
    LibraryArtistResource,
    LibraryResource,
    PaginatedResource,
} from '@/types/resources';
import { Head, router } from '@inertiajs/vue3';
import { useDebounceFn } from '@vueuse/core';
import { ref, watch } from 'vue';

const props = defineProps<{
    artists: PaginatedResource<LibraryArtistResource>;
    libraries: Array<LibraryResource>;
    search?: string;
    library?: string;
}>();

const search = ref(props.search || '');
const library = ref(props.library || '');

const handleSearch = useDebounceFn(() => {
    router.get(
        myLibrary.artist.index().url,
        {
            search: search.value || null,
            library: library.value || null,
        },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        },
    );
}, 300);

watch([search, library], () => {
    handleSearch();
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
        <div class="flex items-center gap-4">
            <div class="w-full max-w-sm">
                <Input v-model="search" placeholder="Filter by name..." />
            </div>
            <div class="w-full max-w-sm">
                <Select v-model="library">
                    <SelectTrigger class="w-full">
                        <SelectValue placeholder="All Libraries" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectItem :value="null"> All Libraries </SelectItem>
                        <SelectItem
                            v-for="lib in libraries"
                            :key="lib.id"
                            :value="lib.id.toString()"
                        >
                            {{ lib.source }} | {{ lib.name }}
                        </SelectItem>
                    </SelectContent>
                </Select>
            </div>
        </div>

        <div class="rounded-md border">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Artist Name</TableHead>
                        <TableHead>Master Artist Name</TableHead>
                        <TableHead>Library</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-if="artists.data.length === 0">
                        <TableCell colspan="3" class="h-24 text-center">
                            No artists found.
                        </TableCell>
                    </TableRow>
                    <TableRow v-for="artist in artists.data" :key="artist.id">
                        <TableCell class="font-medium">
                            {{ artist.name }}
                        </TableCell>
                        <TableCell>
                            {{ artist.canonical_artist?.name || '-' }}
                        </TableCell>
                        <TableCell>
                            {{ artist.library!.source }} |
                            {{ artist.library!.name }}
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>

        <div class="mt-4 flex justify-end">
            <Pagination :links="artists.meta.links" />
        </div>
    </div>
</template>
