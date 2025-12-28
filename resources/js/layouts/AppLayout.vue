<script setup lang="ts">
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

const props = withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage();

// If the frontend has defined any breadcrumbs, use those
// Otherwise, grab the backend breadcrumbs
const computedBreadcrumbs = computed(() => {
    return props.breadcrumbs.length > 0
        ? props.breadcrumbs
        : page.props.breadcrumbs || [];
});
</script>

<template>
    <AppSidebarLayout :breadcrumbs="computedBreadcrumbs">
        <slot />
    </AppSidebarLayout>
</template>
