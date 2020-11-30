<template>
  <div>
    <side-bar-user></side-bar-user>
    <FlashMessage :position="'right top'"></FlashMessage>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-4" style="margin-top: -28em">
          <form @submit.prevent="handleSubmit">
            <div class="form-group">
              <label for="type">categorie</label>
              <select v-model="form.category" class="custom-select" label="Catégorie" required>
                <option value="telephone">Telephone</option>
                <option value="ordinateur">Ordinateur</option>
                <option value="electromenager">electromenager</option>
                <option value="chemise">chemise</option>
                <option value="t-shirt">t-shirt</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Nom du produit" v-model="form.productName" required />
            </div>
            <div class="form-group">
              <file-input v-model="form.image" label="image *" />
              <file-input v-model="form.image1" label="image *" />
              <file-input v-model="form.image2" label="image *" />
            </div>
            <div class="form-group">
              <textarea class="form-control col-md-12" rows="5" v-model="form.description" required placeholder="description du produit"></textarea>
            </div>
            <button type="submit" class="btn btn-round btn-outline-primary col-md-5 offset-4">Submit</button>
            <br />
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FileInput from "../../Shared/FileInput";
import TextareaInput from "../../Shared/TextareaInput";
import SideBarUser from "../../Shared/SideBarUser";

export default {
  name: "Index",
  components: {
    FileInput,
    TextareaInput,
    SideBarUser,
  },
  data() {
    return {
      sending: false,
      form: {
        productName: null,
        image: null,
        description: null,
        category: null,
        image1: null,
        image2: null,
      },
    };
  },
  methods: {
    handleSubmit() {
      this.sending = true;
      var data = new FormData();
      data.append("productName", this.form.productName || "");
      data.append("description", this.form.description || "");
      data.append("image", this.form.image || "");
      data.append("category", this.form.category || "");
      data.append("image1", this.form.image1 || "");
      data.append("image2", this.form.image2 || "");

      this.$inertia.post("/userPost", data, {
        onSuccess: () => {
          this.sending = false;
          this.flashMessage.success({
            message: "Votre annonce a ete poste avec success!",
            time: 5000,
          });
        },
      });
    },
  },
};
</script>
