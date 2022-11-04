<script setup>
    import {
        ref
    } from 'vue';
    import {
        Inertia
    } from '@inertiajs/inertia';
    import {
        Head,
        Link
    } from '@inertiajs/inertia-vue3';
    import Banner from '@/Components/Banner.vue';
    import Dropdown from '@/Components/Dropdown.vue';
    import DropdownLink from '@/Components/DropdownLink.vue';
    import NavLink from '@/Components/NavLink.vue';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
    import SideNav from "@/components/SideNav.vue";
    import MobileNav from "@/components/MobileNav.vue";
    import Topbar from "@/components/Topbar.vue";
    defineProps({
        title: String,
    });

    const showingNavigationDropdown = ref(false);

    const switchToTeam = (team) => {
        Inertia.put(route('current-team.update'), {
            team_id: team.id,
        }, {
            preserveState: false,
        });
    };

    const logout = () => {
        Inertia.post(route('logout'));
    };

</script>

<template>
    <div>

        <Head :title="title" />
        <MobileNav />
        <div class="flex mt-[4.7rem] md:mt-0 overflow-hidden">
            <SideNav />
            <div class="content">
            <main>
                    <Topbar />
                    <slot />
            </main>
        </div>


        </div>


    </div>
</template>
