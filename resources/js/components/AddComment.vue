<template>

    <form @submit.prevent="addComment" class="form-group">
        <div class="d-flex">
            <a v-bind:href="'/profile/show/other/'+user.id" class="text-dark d-flex">    
            <img style="width:20px; height:20px" class="rounded-circle mb-2 ml-2 mr-1 " v-bind:src="user.avatar" alt="">
            </a>
            <textarea  v-model="comment.comment" name="comment" class="form-control" ></textarea>
            <button class="btn btn-primary m-2">commnent</button>
         </div>
    </form>
</template>
<script>
export default {
       data(){
            return{
                comments:[]
                ,
                comment:{
                    id:'',
                    comment:'',
                    user_id:this.user.id,
                    post_id:this.post.id,
                    user:this.user,
                },
                edit:false,
                page:1,loaded:false,
                 req:axios.create({
                   baseUrl:BASE_URL
               }),
               
            }
        }, props:['user','post'],
        methods:
        {
           addComment()
            { 
                if(this.comment.comment !=''){
                 axios.post('/comments',{
                     comment:this.comment.comment, 
                     user_id:this.user.id,
                     post_id:this.post.id,       
                }).then(res=>{
                        this.comment.comment='';
                        this.post.comments=res.data.data.comments;
                        console.log(res);
                }).catch(console.log(err=>err));
                }
            },
        }
        
}
</script>