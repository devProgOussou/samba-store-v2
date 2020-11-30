<template>
  <div>
    <side-bar-user></side-bar-user>
    <FlashMessage :position="'right top'"></FlashMessage>
    <div style="margin-top: -33rem">
      <div class="card mt-5" style="width: 20rem; margin-left: 24%">
        <div>
          <small class="m-2"
            ><img class="mr-2" src="https://pro.propeller.in/assets/images/avatar-icon-40x40.png" width="40" height="40" alt="avatar" />
            {{ this.userSendMessage }}
          </small>
        </div>
        <div class="card-body">
          <p v-for="message in messages" :key="message.id" class="card-text">
            <span style="float: left">{{ message.message }}</span
            ><br />
          </p>
          <p style="float: right" v-for="messageSender in messageSend" :key="messageSender.id">
            <span>{{ messageSender.message }}</span>
            <br />
          </p>
          <form @submit.prevent="handleSubmit">
            <textarea class="form-control col-md-12" rows="1" v-model="form.message" required></textarea>
            <button class="m-5 btn btn-round btn-md btn-success">Envoyer</button>
          </form>
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
  name: "displayMessage",
  props: ["messages", "messageSend"],
  data() {
    return {
      userSendMessage: null,
      datas: {},
      id: null,
      form: {
        message: null,
      },
    };
  },
  mounted: function () {
    this.datas = this.messages;
    for (var i = 0; i < this.datas.length; i++) {
      this.id = this.datas[i].sender_id;
      console.log(this.id);
    }

    this.userSendMessage = this.messages[0].user.name;
  },
  methods: {
    handleSubmit() {
      this.sending = true;
      var data = new FormData();

      data.append("message", this.form.message || "");
      data.append("id", this.id || "");

      this.$inertia.post("/sendMessage", data, {
        onSuccess: () => {
          this.form.message = "";
          this.flashMessage.success({
            message: "Message envoyer!",
            time: 5000,
          });
        },
      });
    },
  },
};
</script>
