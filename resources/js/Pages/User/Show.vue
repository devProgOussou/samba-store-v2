<template>
  <div>
    <side-bar-user></side-bar-user>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-4" style="margin-top: -29em">
          <br /><br />
          <div class="card offset-3" style="width: 40rem" v-for="item in advertisement" :key="item.id">
            <img class="card-img-top" style="height: 200px; width: 40rem" :src="'http://alpha-tests.defarsci.com/samba-store-v2/uploads/' + item.images" alt="Card image cap" />
            <div class="card-body">
              <h5 class="card-title">{{ item.productName }}</h5>
              <p class="card-text">
                {{ item.description }}
              </p>
              <inertia-link :href="'http://localhost:8000/DeletePersonalPost/' + item.id">
                <button class="btn btn-round btn-danger offset-4 col-md-5">Supprimer</button>
              </inertia-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SideBarUser from "../../Shared/SideBarUser";

export default {
  components: {
    SideBarUser,
  },
  props: ["advertisement"],
};
</script>
