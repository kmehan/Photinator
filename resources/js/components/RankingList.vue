<template>
  <div id="v-for-users" class="userRanking">
    <div
    class="card text-white bg-dark mb-3 mw-100"
    v-for="user in users"
    >
      <div class="card-body">
        <h5 class="card-title">{{user.rank}}.&nbsp;{{user.name}}</h5>
        <p class="card-text">{{user.likes}}&nbsp;Likes</p>
      </div>
    </div>
  </div>
</template>
<script>
  function User(rank,{name,likes}) {
    this.rank = rank+1;
    this.name = name;
    this.likes = likes;
  }
  export default {
    data: function() {
      return {
        users: [],
      }
    },
    created() {
      this.getUsers();
    },
    props: ['rank','name','likes'],
    methods: {
      getUsers() {
        window.axios.get('api/photos/ranking').then(({data}) => {
          for(let i=0; i<data.length; i++) {
            //console.log(data[i]);
            this.users.push(new User(i,data[i]));
          }
          //console.log(this.users);
        });
      }
    },
  }
</script>
