<template>
<div>
  <div v-if="loading" class="text-center">
    <strong>Cargando resultados...</strong>
    <br>
    <i class="mt-3 fas fa-5x fa-spinner fa-spin fa-pulse"></i>
  </div>
  <div v-else class="d-flex pt-2">
    <a v-for="(classified, index) in classifieds" :key=index
    :href="'/classified/' + classified.id" class="p-2 mx-1 my-2 classified">
      <img :src="'/storage/uploads/' + classified.images[0].URI " alt="">
      <p>{{classified.name}}</p>
      <h3>Bs. {{classified.price}}</h3>
    </a>
  </div>
</div>
</template>

<script>
export default {
  name: 'classified-gallery',

  data() {
    return {
      classifieds: [{

      }],
      loading: true,
    };
  },

  mounted() {
    axios.get('classified').then((response) => {
      this.classifieds = response.data;
      this.loading = false;
    });
  },
};
</script>

<style scoped>

  p {
    color: black;
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  h3 {
    color: black;
  }

  .d-flex {
    flex-wrap: wrap;
    justify-content: space-evenly;
  }

  .classified {
    background-color: rgba(224, 220, 220, 0.73);
    transition: 0.1s;
    border: 2px solid rgb(85,85,85);
    border-radius: 8px;
    text-align: center;
    box-shadow: 2px 2px gray;

  }

  .classified:hover{
    transform:scale(1.07);
  }

</style>
