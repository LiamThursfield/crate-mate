<script lang="ts" setup>
import { Button } from '@/components/ui/button';
import type { PaginationMetaLink } from '@/types/resources';

defineProps<{
    links: PaginationMetaLink[];
}>();
</script>

<template>
    <div class="flex flex-wrap items-center justify-center gap-1">
        <template v-for="(link, i) in links" :key="i">
            <Button
                v-if="link.page != null"
                :variant="link.active ? 'default' : 'outline'"
                size="sm"
                @click="$emit('pageChange', link.page)"
            >
                <span v-html="link.label" />
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
