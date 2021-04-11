<template>
  <div class="container text-center">
    <transition name="fade" mode="out-in">
      <div v-if="!success" key="confirmation">
        <div v-if="!loading">
            <div class="d-inline-flex mt-4 ">
              <img :src="'/storage/uploads/' + classified.images[0]['URI']"
              class="p-4 px-3 align-self-center">
              <span class="vertical-divider"></span>
              <div class="pl-3 p-4">
                <h2 class="text-center font-weight-bold">Confirmación de Compra</h2>
                <hr>
                <p>¿Seguro que desea comprar: {{classified.name}}?</p>
                <p>Condicion del Articulo: {{classified.usage}}</p>
                <p>Precio del Articulo: {{classified.price}}</p>
                <button class="btn" @click= "buyItem()">Confirmar Compra</button>
              </div>
            </div>

      </div>
      <div v-else class="d-block mt-4 text-center">
          <i class="fa fa-5x fa-spinner fa-pulse"></i>
          <br>
          <strong>Cargando...</strong>
        </div>
      </div>
      <div v-else key=success>
        <purchase-success :classified = this.classified 
        :sellerInfo = this.sellerInfo :purchaseId = this.purchaseId></purchase-success>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: ['classified'],
  data() {
    return {
      loading: false,
      success: false,
      purchaseId: 0,
      sellerInfo: {
        name: '',
        surname: '',
        state: '',
        address: '',
      },
    };
  },
  methods: {
    buyItem() {
      this.loading = true;
      const params = {
        classified_id: this.classified.id,
      };
      axios.post('/purchase', params).then((response) => {
        this.sellerInfo = response.data[0];
        this.purchaseId = response.data[1];
        this.success = true; // Change mode to Purchase Success
      });
    },
  },
};

</script>

<style scoped>
  .d-inline-flex{
    border: 5px solid gray;
    border-radius: 30px;
  }

  .vertical-divider{
    border-right: 5px gray solid;
  }

  .btn {
    background-color:dodgerblue;
    color: #fff;
    width: 100%;
  }

  .fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
  }

  .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
  }
</style>
