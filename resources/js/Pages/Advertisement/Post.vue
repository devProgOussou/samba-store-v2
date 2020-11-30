<template>
  <div>
    <FlashMessage :position="'right top'"></FlashMessage>
    <div class="container">
      <div class="row mt-5">
        <div v-for="item in advertisements" :key="item.id" class="mt-5">
          <div class="card" style="margin-left: 10rem">
            <div id="carouselExampleControls" class="card mr-4 carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img alt="First slide" :src="'http://localhost:8000/uploads/' + item.images" style="width: 50rem; height: 25rem" />
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <div class="card-body">
              <h5 class="card-title">{{ item.productName }}</h5>
              <p class="card-text" style="width: 50rem; height: 12rem">
                {{ item.description }}
              </p>
              <p>
                <small
                  >Posté par :
                  <strong>
                    {{ item.user.name }}
                  </strong>
                </small>
              </p>
              <div class="text-center">
                <button class="btn btn-info btn-round mb-4" data-toggle="modal" data-target="#modalLoginForm">Commander</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <form @submit.prevent="handleSubmit">
      <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title w-100 font-weight-bold">Laissez un message</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body mx-3">
              <div class="md-form mb-4">
                <i class="fas fa-message"></i>
                <textarea class="form-control col-md-12" rows="5" v-model="form.message" required></textarea>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button class="btn btn-default">Envoyer</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import TextareaInput from "../../Shared/TextareaInput";

export default {
  components: {
    TextareaInput,
  },
  data() {
    return {
      sending: false,
      datas: {},
      id: null,
      form: {
        message: null,
      },
    };
  },
  props: ["advertisements"],
  mounted: function () {
    this.datas = this.advertisements;
    for (var i = 0; i < this.datas.length; i++) {
      this.id = this.datas[i].user.id;
    }
  },
  methods: {
    handleSubmit() {
      this.sending = true;
      var data = new FormData();

      data.append("message", this.form.message || "");
      data.append("id", this.id || "");

      this.$inertia.post("/sendMessage", data, {
        onSuccess: () => {
          this.flashMessage.success({
            message: "Votre Message a ete envoyer avec success!",
          });
        },
      });
    },
  },
};
</script>
