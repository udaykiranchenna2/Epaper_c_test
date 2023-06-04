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

    <Head title="Welcome" />
    <div>

        <main>
            <div class="bg-white text-gray-600 work-sans leading-normal text-base tracking-normal  EPaper">

                <!--Nav-->
                <HeaderVue />

                <div class="min-h-screen">
                <slot />

                </div>

            </div>
            <FooterVue />


        </main>


    </div>
</template>
<script>
import HeaderVue from '../Components/Epaper/Header.vue';
import FooterVue from '../Components/Epaper/Footer.vue'
export default {
    components: {
        HeaderVue, FooterVue
    }
}
</script>