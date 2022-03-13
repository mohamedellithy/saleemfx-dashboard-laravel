<template>
    <div class="input-group">
        <div class="show-image">
            <img class="image-company-show" :src="[ image != null ? image : ( savedimage != '' && savedimage != null  ? savedimage : require('../assets/img/upload.svg') ) ]" />
        </div>
        <div class="upload-image-prepend">
            <span class="upload">رفع صورة لشركة التداول </span>
            <div class="frame-lists-images">
                <input name="image" type="file" @change="UploadImage" class="form-control upload-image-company">
            </div>
            <button @click="image = null" class="btn btn-danger" v-if="image != null">حذف صورة  </button>
        </div>
    </div>

</template>
<script>
export default {
    props:{
        savedimage:null
    },
    data () {
       return {
           image:null
       }
    },
    methods: {
        UploadImage:function(image){
            this.image =  URL.createObjectURL(image.target.files[0]);
            console.log(this.image);
        }
    }
}
</script>
