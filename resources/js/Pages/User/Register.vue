<template>
  <div>
    <side-bar-user></side-bar-user>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-4" style="margin-top: -29em">
          <br /><br />
          <h1 class="text-center">Completez votre inscription</h1>
          <form @submit.prevent="handleSubmit">
            <div class="form-group">
              <file-input v-model="form.avatar" label="avatar" />
            </div>
            <div class="form-group">
              <label for="lastName">nom : </label>
              <input type="text" class="form-control" placeholder="Votre nom" v-model="form.lastName" />
            </div>
            <div class="form-group">
              <label for="prenom">Prenom : </label>
              <input type="text" class="form-control" placeholder="Votre prenom" v-model="form.firstName" />
            </div>
            <div class="form-group">
              <label for="prenom">Téléphone :</label>
              <input type="text" class="form-control" placeholder="Téléphone" v-model="form.phone" required />
            </div>
            <div class="form-group">
              <label for="address">Adresse</label>
              <input type="text" class="form-control" placeholder="votre adresse" v-model="form.address" required />
            </div>
            <button type="submit" class="btn btn-round btn-outline-primary col-md-5 offset-4">Soumettre</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SideBarUser from "../../Shared/SideBarUser";
import SelectInput from "../../Shared/SelectInput";
import FileInput from "../../Shared/FileInput";

export default {
  name: "Register",
  components: {
    SelectInput,
    FileInput,
    SideBarUser,
  },
  data() {
    return {
      sending: false,
      form: {
        lastName: null,
        firstName: null,
        phone: null,
        address: null,
        avatar: null,
      },
    };
  },

  methods: {
    handleSubmit() {
      this.sending = true;
      var data = new FormData();

      data.append("lastName", this.form.lastName || "");
      data.append("firstName", this.form.firstName || "");
      data.append("phone", this.form.phone || "");
      data.append("address", this.form.address || "");
      data.append("avatar", this.form.avatar || "");

      this.$inertia.post("/userRegistering", data, {
        onSuccess: () => {
          this.sending = false;
          console.log("Send Success");
        },
      });
    },
  },
};
</script>
