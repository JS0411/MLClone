<template>
    <div class="container d-block">
        <div class="d-flex" v-if="this.images[0].URI != undefined && this.images[0].URI != ''">
            <draggable
                v-model="images"
                :options="{group: 'images',
                       handle: '.itemImg'}"
                :disabled="inProgress"
                @change="$emit('change', images)"
                class="d-flex">
                <div v-for="(image,index) in images" :key="index" class="d-flex wrapper">
                    <img class="itemImg" :src="'/storage/uploads/' + image.URI" alt="Imagen a editar">
                    <div class="circle align-self-center" v-if="images.length > minimumImages">
                        <i class="far fa-2x fa-trash-alt" @click="removeImg(index)"></i>
                    </div>
                    <div slot="footer" v-if="index==0" class="main-tag text-center">Imagen Principal</div>
                </div>
            </draggable>
        </div>
        <div v-else>
            <h3 class="text-center pt-1">Sube una o más imagenes para tu publicación</h3>
        </div>
        <!--
        <button class="btn btn-primary" @click.prevent = "submitImg()">Crear Publicación </button>
        -->
        <div class="img-buttons d-flex justify-content-center" v-if="Object.keys(this.images).length < 6">
            <div class="upload-btn-wrapper">
                <button class="btn btn-primary" @click.prevent = "" >
                    <i class="fas fa-camera"></i>
                    Agregar Imagenes
                </button>
                <input type="file"
                       class="form-control"
                       id="uploadImages"
                       name="uploadImages"
                       @change="onFileChange"
                       multiple
                       :disabled="inProgress"
                       accept=".jpg, .jpeg, .png"
                       :required="minimumImages == 0">
                <!--The above required allows the user to send the request without modifying images if its on edit mode-->
            </div>
            <div v-if="loading==true" class="align-self-center pl-2">
                Subiendo imagen...
                <i class="fas fa-spinner fa-spin fa-pulse"></i>
            </div>
        </div>
        <div v-else style="margin-top: 50px">
            <h4 class="text-center">El limite de imagenes es 6, elimina algunas si quieres agregar algo más</h4>
        </div>
        <transition name="fade">
            <div v-if="this.errorList[0] != undefined && this.errorList[0].text!=''"> <!--If the error isnt empty and isnt the default, we show it-->
                <div v-for="(error, index) in errorList" :key="index">
                    <div class="alert text-center"  @click="popError(index);">
                        <strong>Error:</strong> {{error.text}}.
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'

    const FILE_TYPES = [
        "image/jpeg",
        "image/png",
    ];

    export default {
        props:['imagesProp','inProgress', 'minimumImages'],
        name: "DraggableMenu",
        components: {
            draggable,
        },
        data() {

            return { //Maps the elements in an array similar to the relationship
                images : this.imagesProp,
                deletedList: [{
                   'URI': '',
                }],
                errorList: [{
                    'text': '',
                }],
                loading: false,
                deletedFlag : false,
            }
        },

        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length){
                    return;
                }
                //If the intiial image isnt undefined or empty, we take its actual length, otherwise, its 0.
                if ((this.images[0].URI != undefined && this.images[0].URI != '' ? this.images.length : 0) + e.target.files.length <= 6){
                    this.loading = true;
                    for (var i = 0; i<e.target.files.length; i++) {
                        if(this.validateFile(files[i])){
                            this.createImage(files[i]);

                        }
                    }
                } else {
                    this.pushError('El maximo de imagenes es de 6')
                }
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    let img = new Image();
                    img.onload = () => {
                        if (img.naturalHeight < 400 || img.naturalWidth < 400){
                            this.pushError('La resolución minima es de 400x400')
                            vm.loading = false;
                            return;
                        } else {
                            vm.upload(img, file.size);
                        }
                    }
                    img.src = e.target.result
                };
                reader.readAsDataURL(file);
            },
            upload(img, size){
                axios.post('/image',{image: img.src, width: img.naturalWidth, height: img.naturalHeight, size: size }).then(response => {
                    //If the initial image is undefined or empty, replace for the uploaded one
                    if(this.images[0].URI == undefined || this.images[0].URI == ''){
                        this.images[0].URI = response.data;
                    } else {
                        this.images.push({
                            'URI': response.data,
                        })
                        this.$emit('change', this.images);
                    }
                }) .catch(error => {
                    this.pushError(error);
                });
                this.loading = false;
            },
            removeImg(index){
                //First we check if the image number is greater than the minimum
                    if (!this.inProgress){ //If the request hasnt been sent, enable deletions
                        if (this.deletedList.length == 1 && !(this.deletedFlag)){
                            //If there have not been any deletions, replace the initial URI.
                            this.deletedList[0].URI = this.images[index].URI;
                        } else {
                            this.deletedList.push({
                                'URI': this.images[index].URI
                            })
                        }
                        //If theres only one image in the array, replace the initial one by undefined.
                        if (this.images.length == 1){
                            this.images[0].URI = undefined;
                        } else {
                            this.images.splice(index,1);
                        }
                        this.deletedFlag = true;
                        this.$emit('delete', this.deletedList, this.deletedFlag, this.images);
                    }


            },


            validateFile(file){
                if(!FILE_TYPES.includes(file.type)){
                    this.pushError('Los formatos aceptables son PNG, JPG y JPEG')
                    this.loading = false;
                } else if (file.size > 10485760){
                    this.pushError('El tamaño máximo es de 10MB')
                    this.loading = false;
                }
                return (this.loading) //Returns the state of loading, which should be false if there were errors, so the program will terminate
            },

            pushError(message){
                //If the error is still the default and not undefined, replace by the message's text
                if (this.errorList[0] != undefined && this.errorList[0].text == ''){
                    this.errorList[0].text = message;
                } else {
                    this.errorList.push({
                        'text': message,
                    })
                }

            },

            popError(index){
                this.errorList.splice(index,1);
            },
        },

    }
</script>

<style scoped>
    .container {
        font-size: 1rem;
        font-weight: 300;
    }

    h3,h4 {
        font-weight: 600;
    }
    .wrapper:first-of-type{
        margin-left: 0px;
    }
    .wrapper {
        position: relative;
        margin-left: 20px;
    }

    .wrapper .circle .fa-trash-alt {
    }

    .circle {
        visibility: hidden;
        position: absolute;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        background-color: #00aeff;
        left: 0;
        right: 0;
        margin-right: auto;
        margin-left: auto;
    }

    .itemImg {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        border: 1px solid black;
    }

    .fa-trash-alt {
        visibility: hidden;
        position: relative;
        top: 0.22rem;
        left: 0.35rem;

    }

    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .img-buttons{
        margin-top: 50px;

    }

    .main-tag{
        width:100%;
        top:100%;
        position:absolute;
        background-color:#00aeff;
        color:white;
    }

    .upload-btn-wrapper input[type=file] {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }

    .wrapper:hover > .itemImg {
        opacity: 0.2;
        cursor: move;
    }

    .wrapper:hover i, .wrapper:hover .circle {
        cursor:pointer; cursor:hand;
        visibility: visible;
    }

    .wrapper:hover > .itemImg:active{
        opacity: 1;
    }

    .itemImg:active ~ .circle, .itemImg:active ~ .circle > i {
        visibility:hidden;
    }

    .alert {
        margin-top: 20px;
        padding: 13px;
        background-color: #f44336;
        border-radius: 30px;
        color: white;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }

</style>
