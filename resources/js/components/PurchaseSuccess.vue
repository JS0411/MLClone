<template>
    <div>
        <div class="success mt-4">
            <div class="d-flex align-content-center justify-content-center divider">
                <i class="far fa-3x fa-check-circle pl-sm-3 pl-3" style="color: green"></i>
                <h2 class="pl-2 pt-1">Listo, acabas de comprar este articulo.</h2>
            </div>
            <div class="d-flex divider">
                <img :src="'/storage/uploads/' + classified.images[0].URI"
                class="" alt="Imagen del Articulo">
                <span class="horizontal-divider"></span>
                <div class="flex-grow-1">
                    <h4 class="pt-2">Nombre de Articulo: {{classified.name}}
                    </h4>
                    <hr>
                    <h4>Precio: {{classified.price}}Bs.s</h4>
                    <hr>
                    <h4>Condicion: {{classified.usage}}</h4>
                </div>
            </div>
            <div class="d-flex align-content-center justify-content-center divider">
                <i class="fas fa-3x fa-user pl-sm-3 pl-3 py-1"></i>
                <h2 class="pl-2 pt-2">Información del Vendedor</h2>
            </div>
            <div class="text-center">
                <h4 class="pt-3">Nombre: {{sellerInfo.name}}</h4>
                <hr>
                <h4>Apellido: {{sellerInfo.surname}}</h4>
                <hr>
                <h4>Estado: {{sellerInfo.state}}</h4>
                <hr>
                <h4>Direccion: {{sellerInfo.address}}</h4>
            </div>
            <div class="d-flex pt-4 pb-sm-2 pb-2">
                <button class="ml-auto mr-2 btn btn-primary">
                    <a :href="'/purchase/' + purchaseId + '?mode=bought'">Ver Compra</a>
                </button>
                <button class="mr-2 btn btn-primary">
                    <a href="/">Volver a la pagina principal</a>
                </button>
            </div>
            <div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'SuccessBox',
  props: ['classified', 'sellerInfo', 'purchaseId'],
};
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
