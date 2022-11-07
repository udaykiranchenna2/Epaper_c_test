<template>
    <AppLayout title="Dashboard">
        <div>
            <div class=" bg-gray-100">
                <div class="header bg-gray-300 rounded-md my-3">
                    <div class="flex ">
                        <Link :href="'/admin/upload-epaper'" class="btn btn-primary m-2">Add</Link>
                    </div>
                </div>
                <div class="flex h-[100vh] overflow-auto">
                    <div class="w-[20%] bg-gray-400 mx-1 h overflow-y-auto">

                        <div v-for="(image, index) in News.pdf_images" :key="index">
                            <div class="border border-2 border-gray-200 rounded-sm mx-10 mt-5 mb-4 cursor-pointer">
                                <img :src="image.image_url" alt="" @click="activateImage(image.image_url)">
                            </div>
                            <p class="text-center">{{index+1    }}</p>

                        </div>

                    </div>
                    <div class="w-[80%] bg-gray-400 mx-1">
                        <div class="border border-2 border-gray-200 rounded-sm z-999">
                            <!-- <img :src="ActiveFile" class="" alt=""/> -->
                            <inner-image-zoom :src="ActiveFile" :zoomSrc="ActiveFile"  :zoomScale="0.9"/>
                            <!-- <vue-image-zoomer :regular="ActiveFile" :zoom="ActiveFile" click-zoom="true" click-message="Click To Zoom" /> -->
                        </div>
                    </div>
                </div>
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
    import 'vue-inner-image-zoom/lib/vue-inner-image-zoom.css';
    import InnerImageZoom from 'vue-inner-image-zoom';
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
            'inner-image-zoom': InnerImageZoom
        },
        props: {
            News: Object
        },
        data() {
            return {
                toast: useToast(),
                drag: false,
                previewMode: true,
                ActiveFile: this.News.pdf_images[0].image_url
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
            activateImage(image) {
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
<style lang="css">
::-moz-selection { /* Code for Firefox */
    background: transparent;
  }

  ::selection {
    background: transparent;
  }
</style>
