<template>
    <AppLayout title="Dashboard">
        <div>
            <div class=" bg-gray-100">
                <div class="header bg-gray-300 rounded-md my-3">
                    <div class="flex ">
                        <Link :href="'/admin/upload-epaper'" class="btn btn-primary m-2">Add</Link>
                    </div>
                </div>
                <draggable v-model="News" group="people" class="flex flex-wrap  mx-2" @start="drag=true"
                    @end="drag=false" item-key="id">
                    <template #item="{element}">
                        <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3 mx-2 max-w-[280px]">
                            <div class="box">
                                <div class="p-5">
                                    <div
                                        class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10">
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
                                    <Link :href="'/admin/epaper-view/'+element.newsid" class="flex items-center text-primary mr-auto"><i
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
    import AppLayout from '@/Layouts/AdminLayout.vue';
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
    export default {

        components: {
            AppLayout,
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

            // deleteCategory(id) {
            //     axios.post('/admin/delete-category', {
            //             id: id
            //         })
            //         .then(res => {
            //             if (res.data.status == true) {
            //                 let index = this.Categories.data.findIndex((element) => {
            //                     return element.id === id
            //                 })
            //                 this.Categories.data.splice(index, 1);
            //                 this.toast.success('Category has been deleted')
            //             }
            //         })
            // }
        }
    }

</script>
