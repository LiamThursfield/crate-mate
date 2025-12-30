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
    LibraryResource,
    LibraryTrackResource,
    PaginatedResource,
} from '@/types/resources';
import { Head, router } from '@inertiajs/vue3';
import { useDebounceFn, watchDeep } from '@vueuse/core';
import { ref, watch } from 'vue';

const props = defineProps<{
    errors: Record<string, Array<string>>;
    tracks: PaginatedResource<LibraryTrackResource>;
    libraries: Array<LibraryResource>;
    search?: string;
    library?: string;
    bpm_min?: string;
    bpm_max?: string;
    page?: number;
}>();

const filters = ref({
    search: props.search || '',
    library: props.library || '',
    bpm_min: props.bpm_min || '',
    bpm_max: props.bpm_max || '',
});

const page = ref<number>(props.page || 1);

const handleSearch = useDebounceFn(() => {
    router.get(
        myLibrary.track.index().url,
        {
            ...filters.value,
            page: page.value,
        },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        },
    );
}, 300);

// When filters change, reset to page 1 and update the search
watchDeep([filters], () => {
    page.value = 1;
    handleSearch();
});

// When the page changes, update the search
watch([page], () => {
    handleSearch();
});

const onPageChange = (p: number) => {
    page.value = p;
};

const isFilterSet = (filterKey: keyof typeof filters.value) => {
    const value = filters.value[filterKey];
    return value !== null && value !== undefined && value !== '';
};

const filterHasError = (filterKey: keyof typeof filters.value) => {
    return props.errors[filterKey] && props.errors[filterKey].length > 0;
};

defineOptions({
    breadcrumbs: [
        {
            title: 'My Library',
        },
        {
            title: 'Tracks',
            href: myLibrary.track.index().url,
        },
    ],
});
</script>

<template>
    <Head title="Library Track" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-hidden rounded-xl p-4"
    >
        <div class="grid grid-cols-12 items-center gap-4">
            <div class="col-span-6 w-full sm:col-span-5">
                <Input
                    :aria-invalid="filterHasError('search')"
                    placeholder="Filter by name..."
                    v-model="filters.search"
                />
            </div>

            <div class="col-span-6 w-full sm:col-span-3">
                <Select
                    :aria-invalid="filterHasError('library')"
                    v-model="filters.library"
                >
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

            <div class="col-span-6 w-full sm:col-span-2">
                <Input
                    :aria-invalid="filterHasError('bpm_min')"
                    :min="1"
                    :max="
                        isFilterSet('bpm_max')
                            ? parseInt(filters.bpm_max) - 1
                            : null
                    "
                    placeholder="Min BPM"
                    step="1"
                    type="number"
                    v-model="filters.bpm_min"
                />
            </div>

            <div class="col-span-6 w-full sm:col-span-2">
                <Input
                    :aria-invalid="filterHasError('bpm_max')"
                    :min="
                        isFilterSet('bpm_max')
                            ? parseInt(filters.bpm_min) + 1
                            : 1
                    "
                    placeholder="Max BPM"
                    step="1"
                    type="number"
                    v-model="filters.bpm_max"
                />
            </div>
        </div>

        <div class="rounded-md border">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Title</TableHead>
                        <TableHead>Artist</TableHead>
                        <TableHead>Duration</TableHead>
                        <TableHead>BPM</TableHead>
                        <TableHead>Key</TableHead>
                        <TableHead>Master Track Title</TableHead>
                        <TableHead>Library</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-if="tracks.data.length === 0">
                        <TableCell colspan="7" class="h-24 text-center">
                            No tracks found.
                        </TableCell>
                    </TableRow>
                    <TableRow v-for="artist in tracks.data" :key="artist.id">
                        <TableCell class="font-medium">
                            {{ artist.title }}
                        </TableCell>
                        <TableCell>
                            {{ artist.library_artist!.name }}
                        </TableCell>
                        <TableCell class="text-right">
                            {{ artist.duration_formatted }}
                        </TableCell>
                        <TableCell class="text-right">
                            {{
                                artist.bpm != null ? Math.round(artist.bpm) : ''
                            }}
                        </TableCell>
                        <TableCell class="text-right">
                            {{ artist.key }}
                        </TableCell>
                        <TableCell>
                            {{ artist.canonical_track?.title || '-' }}
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
            <Pagination
                :links="tracks.meta.links"
                @page-change="onPageChange"
            />
        </div>
    </div>
</template>
