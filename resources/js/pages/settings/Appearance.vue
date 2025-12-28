<script lang="ts" setup>
import { Head } from '@inertiajs/vue3';

import AppearanceTabs from '@/components/AppearanceTabs.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { edit } from '@/routes/appearance';

defineOptions({
    breadcrumbs: [
        {
            title: 'Appearance settings',
            href: edit().url,
        },
    ],
});
</script>

<template>
    <Head title="Appearance settings" />

    <SettingsLayout>
        <div class="space-y-6">
            <HeadingSmall
                description="Update your account's appearance settings"
                title="Appearance settings"
            />
            <AppearanceTabs />
        </div>
    </SettingsLayout>
</template>
