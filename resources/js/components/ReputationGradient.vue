<template>
  <div class="rep-bar" :class="{'bad-rep':badRep, 'ok-rep':okRep,
  'good-rep':goodRep}">
  </div>
</template>

<script>
export default {
  name: 'ReputationGradient',
  props: ['salesCount', 'positiveRep'],

  data() {
    return {
      reputationPercent: (this.positiveRep / this.salesCount),
      badRep: false,
      okRep: false,
      goodRep: false,
    };
  },

  mounted() {
    if (this.salesCount < 4) {
      /* If the user has < 4 sales, we default to orange */
      this.okRep = true;
    } else if (this.reputationPercent) {
      if (this.reputationPercent > 0.70) {
        this.goodRep = true;
      } else if (this.reputationPercent > 0.30) {
        this.okRep = true;
      } else {
        this.badRep = true;
      }
    }
  },
};
</script>

<style scoped>
  .rep-bar{
    height: 15px;
  }

  .good-rep{
    background: rgb(99,255,0);
    background: linear-gradient(90deg, rgba(99,255,0,1) 0%, rgba(25,149,39,1) 100%);
  }

  .ok-rep{
    background: rgb(255,214,0);
    background: linear-gradient(90deg, rgba(255,214,0,1) 0%, rgba(255,162,0,1) 100%);
  }

  .bad-rep {
    background: rgb(255,0,0);
    background: linear-gradient(90deg, rgba(255,0,0,1) 0%, rgba(172,13,13,1) 100%);
  }
</style>