<template>
  <div>
    <side-bar-user></side-bar-user>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-4" style="margin-top: -29em">
          <div class="row">
            <div v-for="item in advertisements" :key="item.id">
              <div class="card mr-5" style="width: 20rem">
                <img class="card-img-top" style="height: 200px; width: 20rem" :src="'http://localhost:8000/uploads/' + item.images" alt="Card image cap" />
                <div class="card-body">
                  <h5 class="card-title">{{ item.productName }}</h5>
                  <p class="card-text">
                    {{ item.description }}
                  </p>
                  <inertia-link :href="url + item.id">
                    <button class="btn btn-info btn-sm ml-4">Afficher</button>
                  </inertia-link>
                  <inertia-link :href="'deactivate/' + item.id" v-if="item.isAvailable == true">
                    <button class="btn btn-warning btn-round btn-sm ml-1">Desactiver</button>
                  </inertia-link>
                  <inertia-link :href="'activate/' + item.id" v-if="item.isAvailable == false">
                    <button class="btn btn-success btn-round btn-sm ml-1">Activer</button>
                  </inertia-link>
                  <inertia-link :href="'advertisementDestroy/' + item.id">
                    <button class="btn btn-round btn-danger btn-sm ml-1">Supprimer</button>
                  </inertia-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import AppLayout from "../../Shared/AppLayout.vue";
import SideBarUser from "../../Shared/SideBarUser";

export default {
  components: {
    AppLayout,
    SideBarUser,
  },
  props: ["advertisements"],

  data() {
    return {
      url: "advertisement/",
    };
  },
  methods: {
    logout() {
      axios.post("/logout").then((response) => {
        window.location = "/";
      });
    },
  },
};
</script>
