<script lang="ts" setup>
import { Button } from '@/components/ui/button';
import type { PaginationMetaLink } from '@/types/resources';
import { Link } from '@inertiajs/vue3';

defineProps<{
    links: PaginationMetaLink[];
}>();
</script>

<template>
    <div class="flex flex-wrap items-center justify-center gap-1">
        <template v-for="(link, i) in links" :key="i">
            <Button
                v-if="link.url"
                as-child
                :variant="link.active ? 'default' : 'outline'"
                size="sm"
            >
                <Link :href="link.url" preserve-scroll preserve-state>
                    <span v-html="link.label" />
                </Link>
            </Button>
            <Button
                v-else
                variant="ghost"
                size="sm"
                class="pointer-events-none text-muted-foreground"
            >
                <span v-html="link.label" />
            </Button>
        </template>
    </div>
</template>
