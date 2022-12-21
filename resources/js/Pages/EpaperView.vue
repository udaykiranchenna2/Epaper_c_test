<template>
    <AppLayout title="Epaper">

        <Head title="Epaper" />
        <div class="bg-gray shadow-xl mb-5">
            <div
                class="container px-11  h-14 m-auto  mb- flex flex-nowrap  items-center justify-between flex-wrap  p-1">
                <div class="">
                    <select v-model="ActiveFile" name="" id="">
                        <option :value="item.image_url" v-for="(item, index) in News.pdf_images" :key="index">
                            Page {{ (index + 1) }}
                        </option>

                    </select>
                </div>
                <div class=" px-11 flex">
                    <button v-if="!cropping" @click="startCrop" class="btn mx-1 btn-success "> Crop</button>
                    <button v-else @click="startCrop" class="btn mx-1 btn-danger "> Cancel</button>
                    <button v-if="cropping" @click="saveCropped" class="btn mx-1 btn-secondary "> Save</button>
                </div>


            </div>
        </div>

        <div class="flex overflow-auto   container mx-auto">

            <div class="w-[20%]  mx-1 h overflow-y-auto h-[1000px]">

                <div v-for="(image, index) in News.pdf_images" :key="index">
                    <div class="border border-2 border-gray-200 rounded-sm mr-2 md:mx-10 mt-5 mb-4 cursor-pointer">
                        <img :src="image.image_url" alt="" @click="activateImage(image.image_url)">
                    </div>
                    <p class="text-center">{{ index + 1 }}</p>

                </div>

            </div>
            <div class="w-[80%]  mx-1 h-[100%]">
                <div class="border border-2 border-gray-200 rounded-sm z-999 cursor-pointer">

                    <div v-if="!cropping">
                        <img :src="ActiveFile" v-if="!editMode" @click="isOpen = !isOpen" />

                    </div>

                    <div class="" v-if="cropping">
                        <cropper class="cropper" :src="ActiveFile" @change="change"></cropper>
                    </div>
                </div>
                <DialogModal :show="isOpen" maxWidth="wxl">
                    <template #title>
                        <span class="float-right mr-2 cursor-pointer" @click="isOpen = !isOpen">X</span>
                    </template>
                    <template #content>
                        <!-- <vue-image-zoomer :regular="ActiveFile" :zoom="ActiveFile" click-zoom="true"
                            click-message="Click To Zoom" /> -->
                        <inner-image-zoom :src="ActiveFile" :zoomSrc="ActiveFile" />

                    </template>

                </DialogModal>

                <DialogModal :show="croppedOpen" maxWidth="sm">
                    <template #title>
                        <span
                            class="float-right mr-2 cursor-pointer z-[999] absolute -right-2 top-0 bg-gray-300 px-2  py-1 rounded-md"
                            @click="(croppedOpen = !croppedOpen, croppedLoading = !croppedLoading)">X</span>
                    </template>
                    <template #content>
                        <!-- <vue-image-zoomer :regular="ActiveFile" :zoom="ActiveFile" click-zoom="true"
                            click-message="Click To Zoom" /> -->
                        <div v-if="!croppedLoading">
                            <img :src="croppedImage" alt="" class="0" />
                            <div class="flex flex-wrap">
                                <div class="border border-gray-300 rounded-md py-2 px-2 my-2 w-[85%] break-words"
                                    ref="containerdiv">
                                    {{ croppedImage }}
                                </div>
                                <div>
                                    <button class="border border-gray-300 rounded-md py-2 px-2 my-2 w-full mx-1"
                                        @click="copyText">
                                        <i class="fa-regular fa-copy"></i>

                                    </button>
                                </div>

                            </div>
                            <div class="flex justify-around">
                                <div>
                                    <ShareNetwork network="facebook" :url="croppedImage"
                                        title=" NEWS PAPER 13.11.2022 ">
                                        <i class="fa-brands fa-facebook text-4xl"></i>
                                    </ShareNetwork>
                                </div>
                                <div>

                                    <ShareNetwork network="twitter" :url="croppedImage" title=" NEWS PAPER 13.11.2022 ">
                                        <i class="fa-brands fa-twitter text-4xl"></i>
                                    </ShareNetwork>
                                </div>
                                <div>

                                    <ShareNetwork network="whatsapp" :url="croppedImage"
                                        title=" NEWS PAPER 13.11.2022 ">
                                        <i class="fa-brands fa-whatsapp text-4xl "></i>
                                    </ShareNetwork>
                                </div>
                                <div>
                                    <ShareNetwork network="email" :url="croppedImage" title=" NEWS PAPER 13.11.2022 ">
                                        <i class="fa-solid fa-envelope text-4xl"></i>
                                    </ShareNetwork>

                                </div>



                            </div>
                        </div>
                        <div v-else>
                            Loading....
                        </div>
                    </template>

                </DialogModal>
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
import DialogModal from '@/Components/DialogModal.vue';
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
import ZoomImage from './Pdf/ZoomImage.vue';
import axios from 'axios';

export default {

    components: {
        AppLayout,
        Head,
        Link,
        useForm,
        PrimaryButton,
        DialogModal,
        Table,
        draggable,
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogTitle,
        ZoomImage,
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
            imageFile: null,
            imageFileCanvas: '',
            isOpen: false,
            cropping: false,
            croppedImage: '',
            croppedOpen: false,
            croppedLoading: true,
            topButton: 427,
            leftButton: 427,

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
        startCrop() {
            this.cropping = !this.cropping;
        },
        change({
            coordinates,
            canvas
        }) {
            console.log(coordinates)
            this.imageFileCanvas = canvas;
            // this.leftButton = coordinates.left,
            // this.topButton = coordinates.top
        },
        saveCropped() {
            this.imageFile = this.imageFileCanvas.toDataURL();
            console.log(this.imageFile)
            axios.post('/crop-image', { file: this.imageFile })
                .then(res => {
                    this.croppedOpen = true;
                    this.croppedImage = res.data.image;
                    this.croppedLoading = false;
                    this.cropping = false;
                    console.log(res.data)
                })
        },
        copyText() {
            this.$copyText(this.croppedImage);
            this.toast.success("Image copied to clip-board!", {});

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
}

::selection {}

.EPaper .container {
    width: 100%;
    margin-right: auto;
    margin-left: auto;
}

@media (min-width: 640px) {
    .EPaper .container {
        max-width: 640px;
    }
}

@media (min-width: 768px) {
    .EPaper .container {
        max-width: 768px;
    }
}

@media (min-width: 1024px) {
    .EPaper .container {
        max-width: 1024px;
    }
}

@media (min-width: 1280px) {
    .EPaper .container {
        max-width: 1280px;
    }
}
</style>
