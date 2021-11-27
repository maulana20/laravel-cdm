<template>
    <div>
        <button @click="visible = true" class="btn btn-sm btn-success">Images</button>
        
        <vue-easy-lightbox
            scrollDisabled
            escDisabled
            moveDisabled
            :visible="visible"
            :imgs="imgs"
            :index="index"
            @hide="visible = false"
        ></vue-easy-lightbox>
    </div>
</template>

<script>
    
    import VueEasyLightbox from 'vue-easy-lightbox';
    
    export default {
        components: {
            VueEasyLightbox
        },
        props: [
            'images'
        ],
        data: function() {
            return {
                imgs: '',
                visible: false,
                index: 0
            }
        },
        mounted() {
            this.imgs = this.images.map((res) => res.image_full)
        },
        methods: {
        }
    }
</script>
