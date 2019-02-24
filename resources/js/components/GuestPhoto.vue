<template>
  <div>
    <gallery :images="images" :index="index" @close="index = null"></gallery>
    <div
    class="image"
    v-for="(image,imageIndex) in images"
    :key="imageIndex"
    @click="index = imageIndex"
    :style="{backgroundImage:'url(' + image + ')', width: '300px', height: '200px'}"
    ></div>
  </div>
</template>
<script>
  function Image(id) {
    return new Promise((resolve,reject) => {
      window.axios.get('http://jsonplaceholder.typicode.com/photos/'+id).then(({data}) => {
        if (data) {
          //console.log(data.url);
          resolve(data.url);
        } else {
          reject('Error');
        }
      });
    });
  }
  import VueGallery from 'vue-gallery';
  export default {
    data: function() {
      return {
        images: [],
        index: null
      };
    },
    created()
    {
      this.getIDs();
    },
    methods: {
      getIDs() {
        window.axios.get('api/photos').then(({data}) => {
          for (let i=0; i<data.length; i++) {
            Image(data[i]).then(imageItem => {
              //console.log(imageItem);
              this.images.push(imageItem);
            });
          }
          //console.log(this.images);
        });
      }
    },
    components: {
      'gallery': VueGallery
    },
  }
</script>
<style scoped>
  .image {
    float: left;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    border: 1px solid #ebebeb;
    margin: 6px;
  }

</style>
