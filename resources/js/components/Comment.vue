<template>
<div>
          <div v-for="comm in comments" v-bind:key="comm.id" class="border bg-light rounded border-light m-2 p-2" >
           
             <a v-bind:href="'/profile/show/other/'+comm.user.id" class="text-dark d-flex">  
             <img style="width:20px; height:20px" class="rounded-circle m-2" v-bind:src="comm.user.avatar" alt="">
             <h5> {{comm.user.name}}</h5>
             </a>
             <p class="bg-light rounded ml-3 d-inline">
              {{comm.comment}}
             </p>
        </div>
</div>
</template>
<script>
export default {
    props:['comments'],
}
</script>