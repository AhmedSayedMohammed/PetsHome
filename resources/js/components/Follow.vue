<template>
    <div>
       <form @submit.prevent="follow(user,other)">
        <div v-if="isFollowed==true"> 
             <button type="submit" class="btn btn-danger">Unfollow</button>
        </div>
        <div v-if="isFollowed==false"> 
             <button type="submit" class="btn btn-primary">Follow</button>
        </div>
      </form>
    </div>
</template>
<script>
export default {
    data(){
      return{
        isFollowed:this.followed,
         req:axios.create({
                   baseUrl:BASE_URL
               }),
        }
    },
    props:['user','other','followed']
    ,
    methods:{
        follow(user,other)
        {
            if(this.isFollowed==false)
            {
              axios.post('/user/follow/'+this.other.id).then(res=>{
                    this.isFollowed=true;
                }
            );

            }
            else{

           axios.post('/user/unfollow/'+this.other.id).then(res=>{
                    this.isFollowed=false;
                }
            )

            }
        }
    }
}
</script>