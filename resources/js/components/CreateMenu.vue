<template>
    <div>
        <transition name="fade" mode="out-in">
            <div v-if="classified.id == 0" key="create">
                <form @submit.prevent="sendClassified()">
                    <h1 class="text-center">Crear Publicación</h1>
                    <div class="row" :style="setOpacity">
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="d-flex">
                                    <i class="pl-2 far fa-address-card align-self-center"></i>
                                    <label for="name" class="pl-2 col-form-label">Titulo</label>
                                </div>
                                <!--@keydown.enter.prevent avoids the user inserting a newline in a 1 row textarea-->
                                <input id="name"
                                       type="text"
                                       class="form-control"
                                       v-model="classified.name"
                                       @keyup="titleCount()"
                                       @keydown.enter.prevent
                                       maxlength="120"
                                       placeholder="Titulo de tu publicación"
                                       required
                                       :disabled="inProgress">
                                <div class="d-flex flex-grow-1 justify-content-end">
                            <span class="text-count pt-2" :style="{color: titleCountColor}">
                                {{titleChanged == true ? titleLength : classified.name.length}}/120 caracteres usados
                            </span>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="d-flex">
                                    <i class="pl-2 align-self-center far fa-images"></i>
                                    <label class="pl-2 col-form-label">Imagenes</label>
                                </div>
                                <draggable-menu :imagesProp="images"
                                                :inProgress="inProgress"
                                                :minimumImages = 0
                                                id="imageArray"
                                                @delete="updateDelete"
                                                @change="updateImages"
                                >
                                </draggable-menu>
                            </div>

                            <div class="form-group row">
                                <div class="d-flex">
                                    <i class="pl-2 align-self-center fas fa-search"></i>
                                    <label for="category" class="pl-2 col-form-label">Categoria</label>
                                </div>
                                <select class="form-control" id="category" v-model="classified.category" required
                                        :disabled="inProgress">
                                    <option value="" selected>"Selecciona una categoria..."</option>
                                    <option value="Accesorios Para Vehiculos">Accesorios para Vehiculos</option>
                                    <option value="Agricultura">Agricultura</option>
                                    <option value="Alimentos y Bebidas">Alimentos y Bebidas</option>
                                    <option value="Animales y Mascotas">Animales y Mascotas</option>
                                    <option value="Antiguedades y Colecciones">Antiguedades y Colecciones</option>
                                    <option value="Arte, Papelería y Merceria">Arte, Papelería y Mercería</option>
                                    <option value="Bebés">Bebés</option>
                                    <option value="Carros, Motos y Otros">Carros, Motos y Otros</option>
                                    <option value="Celulares y Telefonos">Celulares y Telefonos</option>
                                    <option value="Computación">Computación</option>
                                    <option value="Consolas y Videojuegos">Consolas y Videojuegos</option>
                                    <option value="Camaras y Accesorios">Camaras y Accesorios</option>
                                    <option value="Deportes y Fitness">Deportes y Fitness</option>
                                    <option value="Electrodomesticos">Electrodomesticos</option>
                                    <option value="Electronica, Audio y Video">Electronica, Audio y Video</option>
                                    <option value="Estética y Belleza">Estética y Belleza</option>
                                    <option value="Herramientas y Construcción">Herramientas y Construcción</option>
                                    <option value="Hogar y Muebles">Hogar y Muebles</option>
                                    <option value="Industrias">Industrias</option>
                                    <option value="Inmuebles">Inmuebles</option>
                                    <option value="Instrumentos Musicales">Instrumentos Musicales</option>
                                    <option value="Juegos y Juguetes">Juegos y Juguetes</option>
                                    <option value="Libros, Revistas y Comics">Libros, Revistas y Comics</option>
                                    <option value="Música, Películas y Series">Música, Películas y Series</option>
                                    <option value="Relojes, Joyas y Bisutería">Relojes, Joyas y Bisutería</option>
                                    <option value="Ropa, Zapatos y Accesorios">Ropa, Zapatos y Accesorios</option>
                                    <option value="Servicios">Servicios</option>
                                    <option value="Otras Categorias">Otras Categorias</option>
                                </select>
                            </div>

                            <div class="form-group row">
                                <div class="d-flex">
                                    <i class="align-self-center pl-2 fas fa-hand-sparkles"></i>
                                    <label for="usage" class="pl-2 col-form-label">Condición</label>
                                </div>
                                <select class="form-control" id="usage" v-model="classified.usage" required
                                        :disabled="inProgress">
                                    <option value="" selected>"Indica la condición de tu articulo..."</option>
                                    <option value="Nuevo">Nuevo</option>
                                    <option value="Usado">Usado</option>
                                </select>
                            </div>

                            <div class="form-group row">
                                <div class="d-flex">
                                    <i class="align-self-center pl-2 fas fa-clipboard-list"></i>
                                    <label for="description" class="pl-2 col-form-label">Descripción</label>
                                </div>
                                <textarea id="description"
                                          class="form-control"
                                          v-model="classified.description"
                                          rows=8
                                          @keyup="descCount()"
                                          maxlength="2000"
                                          placeholder="Descripcion de tu publicación"
                                          required
                                          :disabled="inProgress">
                        </textarea>
                                <div class="d-flex flex-grow-1 justify-content-end">
                            <span class="text-count" :style="{color: descCountColor}">
                                {{descChanged == true ? descLength : classified.description.length}}/2000 caracteres usados
                            </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="d-flex">
                                    <i class="align-self-center pl-2 fas fa-tags"></i>
                                    <label for="price" class="align-self-center pl-2 col-form-label">Precio</label>
                                </div>
                                <input id="price"
                                       class="form-control"
                                       type="number"
                                       v-model="classified.price"
                                       placeholder="Precio en BSS."
                                       @keydown.enter.prevent
                                       required
                                       :disabled="inProgress">
                            </div>

                            <div class="row pt-2 d-flex">
                                <button class="btn btn-primary" type="submit" :disabled="inProgress">Crear Publicación
                                </button>
                            </div>
                        </div>
                    </div>
                    <div v-if="inProgress==true" class="text-center loading-indicator">
                        <h3>Creando publicación...</h3>
                        <i class="fas fa-3x fa-spinner fa-spin fa-pulse"></i>
                    </div>
                </form>
            </div>
            <div v-else key="success">
                <classified-success :classified="classified" :image="images[0].URI" :mode="'create'"></classified-success>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        name: "EditMenu",

        data() {
            return {
                classified: {
                    name: '',
                    category: '',
                    usage: '',
                    description: '',
                    price: '',
                    id: 0,

                },
                images: [{
                    URI: ''
                }],
                deletedImages: [{
                    URI: ''
                }],
                deletedFlag: false,
                inProgress: false, //Shows a loading indicator for the classified upload, and prevents further clicks
                titleLength: 0,
                descLength: 0,
                titleChanged: false,
                descChanged: false,
            }
        },
        created() {
            window.addEventListener('beforeunload', this.warnRefresh);

        },

        methods: {
            sendClassified() {
                if (!this.inProgress) {
                    this.inProgress = true;
                    if (this.deletedFlag){
                         axios.delete('/image', {data: {images: this.deletedImages}});
                     }
                    if(this.images[0] != undefined) {
                        axios.post('/classified', {
                            classified: this.classified,
                            images: this.images,
                        }).then((response) => {
                            this.classified.id = response.data;
                            this.inProgress = false;
                            window.removeEventListener('beforeunload', this.warnRefresh);

                        })
                            .catch(error => {
                                console.log(error);
                                this.inProgress = false;
                            });
                    } else {

                    }

                } else {
                    alert('Por favor, espere el resultado de la operación.')
                }
            },

            titleCount() {
                this.titleLength = this.classified.name.length;
                this.titleChanged = true;
            },

            descCount() {
                this.descLength = this.classified.description.length;
                this.descChanged = true;
            },

            updateDelete(deletedList, deletedFlag, images) {
                this.deletedImages = deletedList;
                this.deletedFlag = deletedFlag;
                this.images = images;
            },

            updateImages(images){
                this.images = images;
            },

            warnRefresh(e){
                e = e || window.event;
                if (e) {
                    e.returnValue = 'Puede que los cambios que hayas realizado se pierdan, recargar?';
                    return 'Puede que los cambios que hayas realizado se pierdan, recargar?';
                } else {
                    return null;
                }

            }

        },

        computed: {
            titleCountColor() {
                if (this.titleLength > 80 && this.titleLength < 120) {
                    return 'orange';
                } else if (this.titleLength == 120) {
                    return 'red';
                } else {
                    return 'black';
                }
            },

            descCountColor() {
                if (this.descLength > 1500 && this.descLength < 2000) {
                    return 'orange';
                } else if (this.descLength == 2000) {
                    return 'red';
                } else {
                    return 'black';
                }
            },

            setOpacity() {
                if (this.inProgress) {
                    return {
                        'opacity': 0.2,
                    }
                } else {
                    return {
                        'opacity': 1,
                    }
                }
            }
        }

    }
</script>

<style scoped>

    h1 {
        margin-bottom: 20px;
        margin-top: 20px;
        font-weight: 600;
    }

    form {
        position: relative;
    }

    .row {
        transition: 0.5s;
    }

    textarea {
        resize: none;
        border-radius: 30px;

    }

    select, input {
        border-radius: 30px;

    }

    .form-group {
        font-size: 1.5rem;
        font-weight: 600;
        padding: 5px 10px 10px 10px;
        background-color: rgba(224, 220, 220, 0.73);
        border-radius: 30px;
    }

    .text-count {
        font-size: 1rem;
        font-weight: 500;
    }

    .loading-indicator {
        position: absolute;
        top: 50%;
        bottom: 50%;
        width: 100%;
        margin-left: -20px;
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
