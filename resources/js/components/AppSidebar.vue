<script lang="ts" setup>
import type { SidebarProps } from '@/components/ui/sidebar';

import NavUser from '@/components/NavUser.vue';

import {
    Sidebar,
    SidebarCollapsibleMenuGroup,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarRail,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import myLibrary from '@/routes/my-library';
import { SidebarMenuItemSection } from '@/types';
import { Link } from '@inertiajs/vue3';
import AppLogo from './AppLogo.vue';

const props = withDefaults(defineProps<SidebarProps>(), {
    collapsible: 'icon',
});

const platformMenuItemSections: SidebarMenuItemSection[] = [
    {
        label: 'Libraries',
        items: [
            {
                title: 'My Library',
                icon: 'Library',
                isActive: true,
                items: [
                    {
                        title: 'Artists',
                        url: myLibrary.artist.index().url,
                        isActive: true,
                    },
                    {
                        title: 'Tracks',
                        url: myLibrary.track.index().url,
                    },
                    {
                        title: 'Set Histories',
                        url: '/dashboard',
                    },
                ],
            },
            {
                title: 'Master Library',
                icon: 'Crown',
                items: [
                    {
                        title: 'Artists',
                        url: '/dashboard',
                    },
                    {
                        title: 'Tracks',
                        url: '/dashboard',
                    },
                ],
            },
        ],
    },
];
</script>

<template>
    <Sidebar v-bind="props">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton as-child size="lg">
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>
        <SidebarContent>
            <SidebarCollapsibleMenuGroup
                v-for="(menuItemSection, index) in platformMenuItemSections"
                :key="`${index}-${menuItemSection.label}`"
                :items="menuItemSection.items"
                :label="menuItemSection.label"
            />
        </SidebarContent>
        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
        <SidebarRail />
    </Sidebar>
</template>
