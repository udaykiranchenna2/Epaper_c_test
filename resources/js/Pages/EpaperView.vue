<template>
    <AppLayout title="Epaper">

        <Head title="Epaper" />


        <div class="flex overflow-auto   container mx-auto">
            <div class="w-[20%]  mx-1 h overflow-y-auto h-[1000px]">

                <div v-for="(image, index) in News.pdf_images" :key="index">
                    <div class="border border-2 border-gray-200 rounded-sm mx-10 mt-5 mb-4 cursor-pointer">
                        <img :src="image.image_url" alt="" @click="activateImage(image.image_url)">
                    </div>
                    <p class="text-center">{{index+1    }}</p>

                </div>

            </div>
            <div class="w-[80%]  mx-1 h-[100%]">
                <!-- <button @click="editMode = !editMode"> Edit</button>
                <button @click="saveCropped"> Save</button> -->
                <div class="border border-2 border-gray-200 rounded-sm z-999">
                    <!-- <img :src="ActiveFile" class="" alt=""/> -->
                    <inner-image-zoom :src="ActiveFile" :zoomSrc="ActiveFile" :zoomScale="0.9" v-if="!editMode" />
                    <!-- <vue-image-zoomer :regular="ActiveFile" :zoom="ActiveFile" click-zoom="true" click-message="Click To Zoom" /> -->
                    <!-- <div class="" >
                        <cropper class="cropper" :src="img" :stencil-props="{
                                }" @change="change"></cropper>
                    </div> -->
                    <!-- <img  :src="imageFile" alt="Red dot" /> -->
                </div>
            </div>
        </div>

    </AppLayout>
</template>
<script>
    import VueCropper from 'vue-cropperjs';
    import 'cropperjs/dist/cropper.css';
    import AppLayout from '@/Layouts/NewsLayout.vue';
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
    import {
        Cropper
    } from 'vue-advanced-cropper'
    import 'vue-advanced-cropper/dist/style.css';

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
            'inner-image-zoom': InnerImageZoom,
            VueCropper,
            Cropper
        },
        props: {
            News: Object
        },
        data() {
            return {
                toast: useToast(),
                drag: false,
                previewMode: true,
                ActiveFile: this.News.pdf_images[0].image_url,
                imgSrc: this.News.pdf_images[0].image_url,
                cropImg: '',
                data: null,
                editMode: false,
                img: this.News.pdf_images[0].image_url,
                imageFile:null,
                imageFileCanvas:''
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
            },
            change({
                coordinates,
                canvas
            }) {
                console.log(coordinates, canvas)
                this.imageFileCanvas = canvas;
            },
            saveCropped(){
                this.imageFile =this.imageFileCanvas.toDataURL();
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
    ::-moz-selection {
        /* Code for Firefox */
        background: transparent;
    }

    ::selection {
        background: transparent;
    }

    .EPaper .container{
        width: 100%;
        margin-right: auto;
        margin-left: auto;
    }
    @media (min-width: 640px){
        .EPaper .container{
            max-width: 640px;
        }
    }
    @media (min-width: 768px){
        .EPaper .container{
            max-width: 768px;
        }
    }
    @media (min-width: 1024px){
        .EPaper .container{
            max-width: 1024px;
        }
    }
    @media (min-width: 1280px){
        .EPaper .container{
            max-width: 1280px;
        }
    }

</style>
