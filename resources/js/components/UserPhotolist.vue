<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
          <v-pagination
          @change="imageUpdate()"
          v-model="currentPage"
          :page-count="5000"
          :classes="bootstrapPaginationClasses"
          ></v-pagination>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <a href="#"
        id="likeButton"
        :class="likeStatusClass"
        role="button"
        @click="likeCreate()"
        >Like</a>
      </div>
      <div class="col-6">
        <a href="#"
        id="unlikeButton"
        :class="unlikeStatusClass"
        role="button"
        @click="likeDelete()"
        >Unlike</a>
      </div>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <img
        :src="url"
        class="imageDisp"
        />
      </div>
    </div>

  </div>
</template>
<script>
  import vPagination from 'vue-plain-pagination';
  export default {
    components: {
        vPagination
    },
    data: function() {
      return {
        currentPage: 1,
        bootstrapPaginationClasses: {
          ul: 'pagination justify-content-center',
          li: 'page-item',
          liActive: 'active',
          liDisable: 'disabled',
          button: 'page-link'
        },
        url: '',
        likeStatus: false,
        likeStatusClass: 'btn btn-success btn-lg',
        unlikeStatusClass: 'btn btn-danger btn-lg disabled',
      }
    },
    created() {
      this.imageUpdate();
    },
    props: ['userId'],
    methods: {
      imageUpdate() {
        //Invokes JSONPlaceholder API to get current image
        //Gets like status by invoking show() API endpoint in PhotosController
        //console.log(this.currentPage);
        //console.log(this.userId);
        var array = {pid:this.currentPage,uid:this.userId};
        var params = JSON.stringify(array);
        //console.log(params);
        window.axios.get('http://jsonplaceholder.typicode.com/photos/'+this.currentPage).then(({data}) => {
          this.url = data.url;
        });
        window.axios.get('api/photos/'+params).then(({data}) => {
          //console.log(data);
          if(data === 'found') {
            this.likeStatus = true;
            this.likeStatusClass = 'btn btn-success btn-lg disabled';
            this.unlikeStatusClass = 'btn btn-danger btn-lg';
          } else {
            this.likeStatus = false;
            this.likeStatusClass = 'btn btn-success btn-lg';
            this.unlikeStatusClass = 'btn btn-danger btn-lg disabled';
          }
        });
      },
      likeCreate() {
        //Create a like by invoking update() API endpoint in PhotosController
        //console.log(this.currentPage);
        //console.log(this.userId);
        var array = {pid:this.currentPage,uid:this.userId};
        var params = JSON.stringify(array);
        window.axios.put('api/photos/'+params).then(({data}) => {
          //console.log(data);
          if(data.picture_id == this.currentPage) {
            this.likeStatus = true;
            this.likeStatusClass = 'btn btn-success btn-lg disabled';
            this.unlikeStatusClass = 'btn btn-danger btn-lg';
          } else {
            this.likeStatus = false;
            this.likeStatusClass = 'btn btn-success btn-lg';
            this.unlikeStatusClass = 'btn btn-danger btn-lg disabled';
          }
        });
      },
      likeDelete() {
        //Deletes the like by invoking destroy() API endpoint in PhotosController
        var array = {pid:this.currentPage,uid:this.userId};
        var params = JSON.stringify(array);
        window.axios.delete('api/photos/'+params);
        this.likeStatus = false;
        this.likeStatusClass = 'btn btn-success btn-lg';
        this.unlikeStatusClass = 'btn btn-danger btn-lg disabled';
      },

    },
  }
</script>
<style scoped>
#likeButton {
  float:right;
  width: 110px;
  margin: 10px 10px 10px 10px;
}
#unlikeButton {
  float:left;
  width: 110px;
  margin: 10px 10px 10px 10px;
}
.imageDisp {
  height: 55vh;
  with: auto;
}
</style>
