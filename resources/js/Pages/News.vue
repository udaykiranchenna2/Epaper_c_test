

<template>
    <AppLayout title="Epaper">
    <Head title="Epaper" />


        <div class=" ">
            <div class="  min-h-[100vh] mt-5">
                <draggable v-model="News" group="people" class="flex flex-wrap  mx-2" @start="drag=true"
                    @end="drag=false" item-key="id">
                    <template #item="{element}">
                        <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3 mx-2 max-w-[280px] border border-1 rounded-xl">
                            <div class="box rounded-xl">
                                <div class="p-5">
                                    <!-- <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10"> -->
                                        <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 ">
                                        <img alt="Midone - HTML Admin Template" class="rounded-md"
                                            :src="element.pdf_images[0].image_url">
                                        <!-- <div class="absolute bottom-0 text-white px-5 pb-6 z-10"> <a href="" class="block font-medium text-base">Samsung Q90 QLED TV</a> <span class="text-white/90 text-xs mt-3">Electronic</span> </div> -->
                                    </div>
                                    <div class="text-slate-600 dark:text-slate-500 mt-5">
                                        <div class="flex items-center"> <i data-lucide="link" class="w-4 h-4 mr-2"></i>
                                            {{element.title}} </div>
                                        <div class="flex items-center mt-2"> <i data-lucide="layers"
                                                class="w-4 h-4 mr-2"></i> {{dateFormat(element.date)}}</div>
                                    </div>
                                </div>
                                <div
                                    class="flex justify-center lg:justify-end items-center p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                                    <Link :href="'/epaper-view/'+element.newsid" class="flex items-center text-primary mr-auto"><i
                                        data-lucide="eye" class="w-4 h-4 mr-1"></i> Preview </Link>

                                    <a class="flex items-center mr-3" href="javascript:;"> <i data-lucide="check-square"
                                            class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal"
                                        data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2"
                                            class="w-4 h-4 mr-1"></i> Delete </a>

                                </div>
                            </div>
                        </div>

                    </template>
                </draggable>

            </div>
        </div>

    </AppLayout>
</template>
<script>
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/inertia-vue3';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import {
        Table
    } from "@protonemedia/inertiajs-tables-laravel-query-builder";
    import {
        useToast
    } from "vue-toastification";
    import draggable from 'vuedraggable'
    import {
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogTitle,
    } from '@headlessui/vue'
    import AppLayout from '@/Layouts/NewsLayout.vue';
    export default {

        components: {
            Head,
            Link,
            useForm,
            PrimaryButton,
            Table,
            draggable,
            TransitionRoot,
            TransitionChild,
            Dialog,
            DialogPanel,
            DialogTitle,
            AppLayout
        },
        props: {
            Categories: Object,
            News: Object
        },
        data() {
            return {
                toast: useToast(),
                drag: false,
                previewMode:false,
                ActiveFile:''
            }
        },
        methods: {
            dateFormat(date) {
                let dateVal = new Date(date);
                var options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                return dateVal.toLocaleDateString("en-US", options);
            },
            closeModal() {
                this.previewMode = false
            },
            openModal() {
                this.previewMode = true
            },
            activateImage(image)
            {
                this.ActiveFile = image
            }

        }
    }

</script>

<style >
.work-sans {
    font-family: 'Work Sans', sans-serif;
}

#menu-toggle:checked + #menu {
    display: block;
}

.hover\:grow {
    transition: all 0.3s;
    transform: scale(1);
}

.hover\:grow:hover {
    transform: scale(1.02);
}

.carousel-open:checked + .carousel-item {
    position: static;
    opacity: 100;
}

.carousel-item {
    -webkit-transition: opacity 0.6s ease-out;
    transition: opacity 0.6s ease-out;
}

#carousel-1:checked ~ .control-1,
#carousel-2:checked ~ .control-2,
#carousel-3:checked ~ .control-3 {
    display: block;
}

.carousel-indicators {
    list-style: none;
    margin: 0;
    padding: 0;
    position: absolute;
    bottom: 2%;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 10;
}

#carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
#carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
#carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
    color: #000;
    /*Set to match the Tailwind colour you want the active one to be */
}
</style>
