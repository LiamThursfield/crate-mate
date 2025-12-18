<script lang="ts" setup>
import { Head } from '@inertiajs/vue3';

import AppearanceTabs from '@/components/AppearanceTabs.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { edit } from '@/routes/appearance';

defineOptions({
    layout: (h: any, page: any) =>
        h(
            AppLayout,
            {
                breadcrumbs: [
                    {
                        title: 'Appearance settings',
                        href: edit().url,
                    },
                ],
            },
            () => page,
        ),
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
