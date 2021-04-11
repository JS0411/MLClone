<template>
    <div>
        <div class="success mt-3">
            <div class="d-flex align-content-center justify-content-center divider">
                <i class="far fa-3x fa-check-circle pl-sm-3 pl-3 py-1" style="color: green"></i>
                <h2 v-if="mode=='create'" class="pl-2 pt-2">Listo, ya publicastes tu articulo, proximamente aparecera en los listados.</h2>
                <h2 v-else class="pl-2 pt-2"> Listo, ya modificastes tu publicación, los cambios proximamente tomaran efecto.</h2>
            </div>
            <div class="d-flex">
                <img :src="'/storage/uploads/' + image" alt="Imagen del Articulo">
                <span class="horizontal-divider"></span>
                <div class="flex-grow-1">
                    <h4 class="pt-2">Nombre de Articulo: {{classified.name}}</h4>
                    <hr>
                    <h4>Precio: {{classified.price}}Bs.s</h4>
                    <hr>
                    <h4>Condicion: {{classified.usage}}</h4>
                    <div class="d-flex pt-4 pb-sm-2 pb-2">
                        <button class="ml-auto mr-2 btn btn-primary">
                            <a :href="'/classified/' + classified.id">Ver Publicación</a>
                        </button>
                        <button class="mr-2 btn btn-primary">
                            <a v-if="mode=='create'" href="/">Volver a la pagina principal</a>
                            <a v-else href="/userinfo/classifieds">Volver a mis publicaciones</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['classified', 'image', 'mode'],
        name: "SuccessBox"
    }
</script>

<style scoped>
    .success{
        border: 2px gray solid;
        border-radius: 40px;
        background-color: white;
    }

    .divider {
        border-bottom: 3px gray solid;
    }

    .horizontal-divider{
        border-right: 2px gray solid;
    }

    img{
        border-radius: 0px 0px 0px 38px;
        max-width: 300px;
        max-height: 300px;
        object-fit:cover;
    }

    h4{
        padding-left: 10px;
        word-break: break-all;
    }

    hr{
        background-color: black;
    }

    button {
        border-radius: 40px;
    }

    button a {
        color: white;
    }

</style>
