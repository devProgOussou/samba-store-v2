<template>
  <div>
    <br />
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">ADMIN HOME PERSONALS SHOW</h1>
        </div>
        <div class="col-md-12">
          <br /><br />
          <show-link></show-link>
        </div>
        <div class="col-md-12">
          <table class="table table-dark">
            <tr class="m-5">
              <th>ID</th>
              <th>Nom</th>
              <th>Prenom</th>
              <th>Adresse</th>
              <th>Telephone</th>
              <th>Actions</th>
            </tr>
            <tr v-for="personal in personals" :key="personal.id">
              <td>{{ personal.id }}</td>
              <td>{{ personal.lastName }}</td>
              <td>{{ personal.firstName }}</td>
              <td>{{ personal.address }}</td>
              <td>{{ personal.phone }}</td>
              <td></td>
              <td>
                <inertia-link :href="'personal/' + personal.user_id">
                  <button class="btn btn-info btn-sm">Afficher</button>
                </inertia-link>

                <inertia-link :href="'personalDelete/' + personal.user_id">
                  <button class="btn btn-round btn-danger btn-sm">Supprimer le compte</button>
                </inertia-link>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ShowLink from "../../Shared/ShowLink";

export default {
  props: ["personals"],
  components: {
    ShowLink,
  },
};
</script>
