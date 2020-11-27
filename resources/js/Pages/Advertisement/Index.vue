<template>
  <div>
    <div class="container-wide">
      <!--Carousel Wrapper-->
      <div id="carousel-example-1z" class="carousel slide carousel-fade mb-5" data-ride="carousel">
        <!--Indicators-->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-1z" data-slide-to="1"></li>
          <li data-target="#carousel-example-1z" data-slide-to="2"></li>
        </ol>
        <!--/.Indicators-->
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
          <!--First slide-->
          <div class="carousel-item active">
            <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(148).jpg" alt="First slide" />
          </div>
          <!--/First slide-->
          <!--Second slide-->
          <div class="carousel-item">
            <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(150).jpg" alt="Second slide" />
          </div>
          <!--/Second slide-->
          <!--Third slide-->
          <div class="carousel-item">
            <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(149).jpg" alt="Third slide" />
          </div>
          <!--/Third slide-->
        </div>
        <!--/.Slides-->
        <!--Controls-->
        <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
        <!--/.Controls-->
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">SAMBA-STORE</h1>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero deserunt laborum nemo tenetur ipsa? Numquam magni distinctio obcaecati ea et porro dignissimos quia reprehenderit expedita tenetur, veniam quas hic impedit.</p>
        </div>
      </div>
    </div>

    <div class="album py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-3" v-for="item in advertisements" :key="item.id">
            <div class="card mb-3 box-shadow">
              <img class="card-img-top" :src="'http://localhost:8000/uploads/' + item.images" alt="Card image cap" />
              <div class="card-body">
                <p>{{ item.productName }}</p>
                <p class="card-text">{{ item.description }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <small style="float: left"
                    >Posté par :
                    <strong>
                      {{ item.user.name }}
                    </strong>
                  </small>
                  <small class="text-muted">9 mins</small>
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
export default {
  components: {},
  props: ["advertisements"],
  created() {
    // this.$inertia
    //   .get("/")
    //   .then((response) => (this.advertisements = response))
    //   .catch((error) => console.log(error));
  },
  data() {
    return {
      q: null,
    };
  },
  methods: {
    searchAdvertisement() {
      if (this.q.length > 3) {
        this.$inertia
          .get("/" + this.q)
          .then((response) => (this.advertisements = response))
          .catch((error) => console.log(error));
      } else {
        this.$inertia
          .get("/")
          .then((response) => (this.advertisements = response))
          .catch((error) => console.log(error));
      }
    },
  },
  mounted() {
    let unix_timestamp = 1549312452;
    var date = new Date(unix_timestamp * 1000);
    var hours = date.getHours();
    var minutes = "0" + date.getMinutes();
    var seconds = "0" + date.getSeconds();
    var formattedTime = hours + ":" + minutes.substr(-2) + ":" + seconds.substr(-2);

    console.log(formattedTime);
  },
};
</script>

<style scoped>
.hm-gradient {
  background-image: linear-gradient(to top, #f3e7e9 0%, #e3eeff 99%, #e3eeff 100%);
}
.darken-grey-text {
  color: #2e2e2e;
}
</style>
