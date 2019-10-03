<template>
<div>
<div v-if="loaded==true">
  <div class="card text-left">
      <div class="card-header bg-success">
        <img v-bind:src="consultation.doctor.user.avatar" style="width:30px; height:30px;" class="rounded-circle" alt="">
        <label>Dr/{{consultation.doctor.user.name}}</label>
        <label class="text-light bold">and</label>
        <img v-bind:src="user.avatar" style="width:30px; height:30px;" class="rounded-circle" alt="">
      <label>  {{user.name}}</label>
      </div>
       <img class="card-img-top" v-bind:src="consultation.image" alt="">
      <div class="card-body">
        <!-- <h4 class="card-title ">Title</h4> -->
        <p class="card-text">{{consultation.body}}</p>  
      </div>
    </div>
          <div v-for="comm in consultation.comments" v-bind:key="comm.id" class=" px-3">
            <div>  
             <img style="width:20px; height:20px" class="rounded-circle " v-bind:src="comm.user.avatar" alt="">
              <a href="#" style="font-size:10px;"> {{comm.user.name}}</a>
            </div>
            <pre class="bg-light border border-dark rounded ">
              {{comm.comment}}
            </pre>
         </div>
         
    <form @submit.prevent="addComment" class="form-group">
        <div class="d-flex">
           <img style="width:20px; height:20px" class="rounded-circle mb-2 ml-2 mr-1 " v-bind:src="consultation.user.avatar" alt="">
            <textarea v-model="comment.comment"  name="comment" class="form-control" ></textarea>
            <button class="btn btn-primary m-2">commnent</button>
        </div>
    </form>
</div>
</div>
</template>
<script>
export default {
  data() {
    return {
            consultation:[],
           comment:{
                    id:'',
                    comment:'',
                }
                ,loaded:false,
                 req:axios.create({
                   baseUrl:BASE_URL
               }),
    }  
  },props:['consultation_id','user']
  ,created(){
             let url='/consultation/'+this.consultation_id
            axios.get(url).then(res=>{
               console.log(res);
                   this.consultation=res.data.data;
                   this.loaded=true;
                   this.$forceUpdate();
           }) 
  },    methods:
        {
           addComment()
            { 
               axios.post('/consultation/comments/'+this.consultation.id,{
                 comment:this.comment.comment,
                }).then((res)=>res.json()).then(res=>{
                       this.comment.comment='';
                       this.consultation=res.data.data;
                       this.$forceUpdate();
                }).catch(console.log(err=>err));
            },
        }
}
</script>