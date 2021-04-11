<template>
  <div class="container">
    <transition name="fade" mode="out-in">
      <div class="d-flex justify-content-center">
        <div v-if="!resultsLoaded" class="pt-4 mx-auto text-center" >
          <strong>Cargando resultados...</strong>
          <br>
          <i class="mt-3 fas fa-5x fa-spinner fa-spin fa-pulse"></i>
        </div>
      </div>
    </transition>
    <transition name="fade" mode="out-in">
      <div v-show="resultsLoaded" >
        <ais-panel>
          <ais-instant-search
          index-name="classifieds"
          :search-client="searchClient"
          :routing="routing"
          :stalled-search-delay="200"
          class="mt-2"
          >
          <hits-connector
          @loaded="showResults"
          >
        </hits-connector>
        <refresh-connector
        @refreshFlag="setFlag"
        :triggerUpdate="updated">
      </refresh-connector>
      <ais-configure
      :hitsPerPage="20"
      :filters = "'seller_profile_id:' + user_id"
      />
      <ais-search-box
      placeholder="Buscar publicaciones..."
      :show-loading-indicator =  "true"
      >
    </ais-search-box>
    <div class="row mt-4 results-box">
      <div class="col-3">
        <ais-state-results>
          <div slot-scope="{results: {hits}}">
            <div class="left-panel text-break" v-if="hits.length">
              <h2>Categorias</h2>
              <ais-refinement-list attribute="category"/>
              <hr>
              <h2>Condición</h2>
              <ais-refinement-list attribute="usage"/>
              <hr>
              <h2>Estado de Publicación</h2>
              <classifieds-refinement attribute="active"/> <!-- Custom widget to show an active or inactive tag.-->
            </div>
          </div>
        </ais-state-results>
      </div>
      <div class="col-9 right-panel">
        <ais-hits>
          <div slot-scope="{items}">
            <div v-for="(item,index) in items" :key="index" style="position: relative;">
              <a :href="'/classified/' + item.id" class=" item-bg d-flex" :class="{inactive : (item.active==0)}">
                <img :src="'/storage/uploads/' + item.images[0].URI" width="120" height="120">
                <span class="d-inline pl-3">
                  <strong>{{item.name}}</strong>
                  <p class="pt-3">{{item.location}}</p>
                  <h5 >Bs. {{item.price}}</h5>
                </span>
                <div class="dropdown ml-auto">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu de opciones
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div v-if="item.active == 0">
                      <a class="dropdown-item" href="#" @click.prevent="flipActive(item)">Reactivar publicación</a>
                      <a class="dropdown-item" href="#" @click.prevent="deleteItem(item, items, index)">Eliminar publicación</a>
                    </div>
                    <div v-else>
                      <a class="dropdown-item" :href="'/classified/' + item.id + '/edit'">Modificar publicación</a>
                      <a class="dropdown-item" href="#" @click.prevent="flipActive(item)">Finalizar publicación</a>
                    </div>
                  </div>
                </div>
              </a>
              <hr>
            </div>
          </div>
        </ais-hits>
      </div>
    </div>

    <ais-state-results>
      <p slot-scope="{results : {hits}}"
      v-show="!hits.length"
      class="text-center">
      No tienes publicaciones, crea algunas y apareceran aqui...
    </p>
  </ais-state-results>
  <ais-pagination/>

</ais-instant-search>

</ais-panel>
</div>
</transition>
<transition name="fade">
  <div v-if="this.alertList[0] != undefined && this.alertList[0].text!=''"> <!--If the alert isnt empty and isnt the default, we show it-->
    <div v-for="(alert, index) in alertList" :key="index">
      <div class="alert text-center" :class="{'alert-success':alert.success,'alert-danger':!alert.success }" @click="popAlert(index);">
        <strong>{{alert.text}}.</strong>
      </div>
    </div>
  </div>
</transition>
</div>

</template>

<script>
  import algoliasearch from 'algoliasearch/lite';
  import 'instantsearch.css/themes/algolia-min.css';
  import { history as historyRouter } from 'instantsearch.js/es/lib/routers';
  import { singleIndex as singleIndexMapping } from 'instantsearch.js/es/lib/stateMappings';

  export default {
    props:['user_id'],
    data() {
      return {
        inProgress: false,
        updated: false,
        resultsLoaded: false,
        alertList: [{
          text: '',
          success: true,
        }],
        searchClient: algoliasearch(
          'UKNF6XGHI9',
          '163814f7269186a7b632ccf8870e2a1e',
          ),
        routing: {
          router: historyRouter(),
          stateMapping: singleIndexMapping('classifieds'),
        },
        loaded: false,
        items: [{}]
      };
    },

    methods: {
      flipActive(item){
        axios.put('/classified/' + item.id, {
          id: item.id,
          mode: 'flip',
        }).then((response) => {
                    //Since algolia takes a bit after receiving requests, we need a timeout of about 1-2 seconds.
                    setTimeout(() => {
                      if (item.active == 0) {
                        this.pushAlert('Publicación ' + item.name + ' activada exitosamente', true);
                      } else {
                        this.pushAlert('Publicación ' + item.name + ' pausada exitosamente', true);
                      }
                      this.updated = true;
                    }, 2000);
                  }).catch(error => {
                    this.pushAlert(error, false);
                  });
                },

                deleteItem(item, items, index){
                  axios.delete('/classified/' + item.id).then((response) => {
                    setTimeout(() => {
                      this.pushAlert('Publicación ' + item.name + ' eliminada exitosamente', true);
                      this.updated = true;
                    }, 2000);
                  }).catch(error => {
                    this.pushAlert(error, false);
                  });
                },

                showResults(){
                  this.resultsLoaded = true;
                },

                pushAlert(message, status){
                //If the error is still the default and not undefined, replace by the message's text
                if (this.alertList[0] != undefined && this.alertList[0].text == ''){
                  this.alertList[0].text = message;
                  this.alertList[0].success = status;
                } else {
                  this.alertList.push({
                    'text': message,
                    'success': status,
                  })
                }

              },

              popAlert(index){
                this.alertList.splice(index,1);
              },

              setFlag(){
                this.updated = false;
              }
            },

          };
        </script>

        <style scoped>

        .left-panel{
          padding: 5px 0px 10px 10px;
          border-radius: 8px;
          border-style: solid;
        }

        strong{
          font-size: 19px;
        }

        .item-bg:hover{
          border: 4px solid rgb(85,85,85);
          border-radius: 8px;
          margin: -4px;
        }

        .dropdown {
          padding-top: 10px;
          padding-left: 10px;
        }

        .alert {
          position: fixed;
          z-index: 3;
          bottom: 0px;
        }

        .inactive {
          opacity: 0.5;
          transition: opacity .5s
        }

        .hidden {
          opacity: 0;
        }

        .no-results{

        }

        .fade-enter-active, .fade-leave-active {
          transition: opacity .5s;
        }
        .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
          opacity: 0;
        }
      </style>
