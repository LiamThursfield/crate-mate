<script setup lang="ts">
import * as LucideIcons from "lucide-vue-next"
import {
    Collapsible,
    CollapsibleContent,
    CollapsibleTrigger,
} from '@/components/ui/collapsible'
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
} from '@/components/ui/sidebar/index'
import { SidebarMenuItem as SidebarMenuItemType } from '@/types';
import { Link } from '@inertiajs/vue3';

defineProps<{
    label: string,
    items: SidebarMenuItemType[]
}>();

/**
 * This function takes the string name and returns the component.
 * If the string doesn't match a Lucide icon, it falls back to AppWindow.
 */
const getIcon = (name: string | undefined) => {
    if (name == null) {
        return LucideIcons.AppWindow;
    }

    return (LucideIcons as any)[name] || LucideIcons.AppWindow;
};

</script>

<template>
    <SidebarGroup>
        <SidebarGroupLabel>
            {{ label }}
        </SidebarGroupLabel>

        <SidebarMenu>
            <Collapsible
                v-for="item in items"
                :key="item.title"
                as-child
                :default-open="item.isActive"
                class="group/collapsible"
            >
                <SidebarMenuItem>
                    <CollapsibleTrigger as-child>
                        <SidebarMenuButton
                            :class="{'font-black': item.isActive}"
                            :tooltip="item.title"
                        >
                            <component :is="getIcon(item.icon)"/>
                            <span
                                class="max-w-full text-ellipsis overflow-hidden whitespace-nowrap"
                                :aria-label="item.title"
                            >
                                {{ item.title }}
                            </span>
                            <LucideIcons.ChevronRight class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                        </SidebarMenuButton>
                    </CollapsibleTrigger>

                    <CollapsibleContent>
                        <SidebarMenuSub>
                            <SidebarMenuSubItem v-for="subItem in item.items" :key="subItem.title">
                                <SidebarMenuSubButton as-child>
                                    <Link
                                        :class="{'font-black': subItem.isActive}"
                                        :href="subItem.url"
                                    >
                                        {{ subItem.title }}
                                    </Link>
                                </SidebarMenuSubButton>
                            </SidebarMenuSubItem>
                        </SidebarMenuSub>
                    </CollapsibleContent>
                </SidebarMenuItem>
            </Collapsible>
        </SidebarMenu>
    </SidebarGroup>
</template>
