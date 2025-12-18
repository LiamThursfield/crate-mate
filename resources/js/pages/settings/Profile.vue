<script lang="ts" setup>
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import { edit } from '@/routes/profile';
import { send } from '@/routes/verification';
import { Form, Head, Link, usePage } from '@inertiajs/vue3';

import DeleteUser from '@/components/DeleteUser.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';

interface Props {
    mustVerifyEmail: boolean;
    status?: string;
}

defineProps<Props>();

defineOptions({
    layout: (h: any, page: any) =>
        h(
            AppLayout,
            {
                breadcrumbs: [
                    {
                        title: 'Profile settings',
                        href: edit().url,
                    },
                ],
            },
            () => page,
        ),
});

const page = usePage();
const user = page.props.auth.user;
</script>

<template>
    <Head title="Profile settings" />

    <SettingsLayout>
        <div class="flex flex-col space-y-6">
            <HeadingSmall
                description="Update your details"
                title="Profile information"
            />

            <Form
                v-slot="{ errors, processing, recentlySuccessful }"
                class="space-y-6"
                v-bind="ProfileController.update.form()"
            >
                <div class="grid gap-2">
                    <Label for="name">Name</Label>
                    <Input
                        id="name"
                        :default-value="user.name"
                        autocomplete="name"
                        class="mt-1 block w-full"
                        name="name"
                        placeholder="Full name"
                        required
                    />
                    <InputError :message="errors.name" class="mt-2" />
                </div>

                <div class="grid gap-2">
                    <Label for="name">DJ Name</Label>
                    <Input
                        id="dj_name"
                        :default-value="user.dj_name"
                        autocomplete="dj_name"
                        class="mt-1 block w-full"
                        name="dj_name"
                        placeholder="DJ name"
                        required
                    />
                    <InputError :message="errors.dj_name" class="mt-2" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        :default-value="user.email"
                        autocomplete="username"
                        class="mt-1 block w-full"
                        name="email"
                        placeholder="Email address"
                        required
                        type="email"
                    />
                    <InputError :message="errors.email" class="mt-2" />
                </div>

                <div v-if="mustVerifyEmail && !user.email_verified_at">
                    <p class="-mt-4 text-sm text-muted-foreground">
                        Your email address is unverified.
                        <Link
                            :href="send()"
                            as="button"
                            class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
                        >
                            Click here to resend the verification email.
                        </Link>
                    </p>

                    <div
                        v-if="status === 'verification-link-sent'"
                        class="mt-2 text-sm font-medium text-green-600"
                    >
                        A new verification link has been sent to your email
                        address.
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <Button
                        :disabled="processing"
                        data-test="update-profile-button"
                        >Save</Button
                    >

                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p
                            v-show="recentlySuccessful"
                            class="text-sm text-neutral-600"
                        >
                            Saved.
                        </p>
                    </Transition>
                </div>
            </Form>
        </div>

        <DeleteUser />
    </SettingsLayout>
</template>
