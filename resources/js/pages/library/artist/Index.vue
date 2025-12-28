<script lang="ts" setup>
import myLibrary from '@/routes/my-library';
import { LibraryArtistResource, PaginatedResource } from '@/types/resources';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    artists: PaginatedResource<LibraryArtistResource>;
}>();

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
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <pre class="text-xs">{{ artists }}</pre>
        </div>
    </div>
</template>
