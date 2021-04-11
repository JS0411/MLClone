<template>
  <div class="container d-flex">
    <div class="carousel-indicators">
      <img v-for="(image,index) in images" :key="index" :src="'/storage/uploads/' + image.URI"
      data-target="#carousel-banner" :data-slide-to="currentImg"  id="carousel-indicator-img"
      @mouseover="changeSlide(index)" :class="{active:(index==currentImg)}">
    </div>
    <div id="carousel-banner" class="carousel slide" data-interval="false">
      <div class="carousel-inner justify-content-center">
        <div class="carousel-item" v-for="(image,index) in images" :key="index"
        :class="{active:(index==currentImg)}">
          <div class="image-background d-flex">
            <inner-image-zoom class="ml-auto mr-auto" :src="'/storage/uploads/small' + image.URI"
            :zoomSrc="'/storage/uploads/original' + image.URI" :alt="'Slide' + index"
            className="carousel-images" moveType="drag"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import InnerImageZoom from 'vue-inner-image-zoom';
import 'vue-inner-image-zoom/lib/vue-inner-image-zoom.css';

export default {
  name: 'ImageGallery',
  props: ['imagesProp'],
  components: {
    'inner-image-zoom': InnerImageZoom,
  },

  data() {
    return {
      images: this.imagesProp,
      currentImg: 0,
    };
  },

  methods: {
    changeSlide(index) {
      this.currentImg = index;
    },
  },
};

</script>

<style scoped>
.carousel-indicators{
  max-width: 61px;
  max-height:400px;
  display: block;
  position: relative;
  margin-left: 0px;
  margin-right: 50px;
}

#carousel-indicator-img{
  margin-left: 10px;
  margin-bottom: 5px;
  max-height:100%;
  max-width: 100%;
}

#carousel-indicator-img.active {
  border: 2px solid #2AC6FC;
  border-radius: 3px;
}

#carousel-banner{
  width: 75%;
}

.image-background{
  margin-left: 10px;
  padding-bottom: 5px;
  max-height:100%;
  max-width: 100%;
}

.carousel-images{
  max-height: 100%;
  width: auto;
}


</style>
