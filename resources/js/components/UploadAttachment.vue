<template>
    <div class="input-group">

        <div class="upload-image-prepend">
            <span class="upload">رفع ملفات   </span>
            <div class="frame-lists-images">
                <input id="files" name="attachments[]"  type="file" @change="UploadFile" class="form-control upload-image-company" multiple>
            </div>
            <button type="button" @click="deleteFile" class="btn btn-danger" v-if="files != null || savedfiles.length != 0">حذف كل الملفات  </button>
        </div>
        <div class="show-image">
            <img class="image-company-show" :src="[ files != null ? '' : ( savedfiles.length != -1  ? '' : require('../assets/img/upload.svg') ) ]" />
            <table style="width: 100%;font-size: 13px;">
                <tr v-for="(file,index) in files" :key="index" style="background-color: white;border-bottom:1px solid #eee">
                    <td> <img style="width: 50px;" src="../assets/img/file-36573.png" /> </td>
                    <td> {{ file.name }} </td>
                    <td> {{ file.size }}kb </td>
                    <td >
                         <i @click="viewFile(index)" title="معاينة الملف" style="cursor:pointer" class="fas fa-download"></i>
                    </td>
                </tr>

                <tr v-for="(file,index) in savedfiles" :key="index" style="background-color: white;border-bottom:1px solid #eee">
                    <td> <img style="width: 50px;" src="../assets/img/file-36573.png" /> </td>
                    <td>
                        <div class="attachment-name">
                            {{ file.attachment_name }}
                        </div>
                    </td>
                    <td >
                         <i @click="DownloadFile(file.attachment_url,file.attachment_name)" title="معاينة الملف" style="cursor:pointer" class="fas fa-download"></i>
                    </td>
                </tr>


            </table>
        </div>
    </div>

</template>
<script>
let $ = require('jquery');
export default {
    props:{
        savedfiles:[]
    },
    data () {
       return {
           files:null
       }
    },
    mounted() {
        console.log(this.savedfiles.length);
    },
    methods: {
        UploadFile:function(event){
            this.files =  Array.from(event.target.files);
            this.savedfiles = [];
            console.log(event.target.files);
        },
        deleteFile:function(){
            $('input#files').val(null);
            this.files = null;
            this.savedfiles = []
            console.log(this.files);
        },
        viewFile:function(index){
            let file = URL.createObjectURL(this.files[index]);
            window.open(file,'_blank');
        },
        DownloadFile:function(link,name){
            var downloadLink      = document.createElement("a");
            downloadLink.href     = link;
            downloadLink.download = name;
            document.body.appendChild(downloadLink);
            downloadLink.click();
        }
    }
}
</script>
<style>
   .attachment-name{
        width: 80%;
        text-align: center !important;
   }
</style>
