<template>
 <div>
     <div>
         <div class="panel panel-default border rounded">
        <div class="panel-heading bg-primary p-2 rounded">
            <a v-bind:href="'/profile/show/other/'+user.id" class="text-dark d-flex">  
            <img v-bind:src="user.avatar" alt="user photo" style="width:50px; height:50px;" class="rounded-circle  mr-1">
            <h2 > {{user.name}}</h2> 
            </a>
            
       </div>
        <div class="panel-body ">
             <div class="container-viewport">
                 <form @submit.prevent="addPost" class="mb-3">
              
                     <div class="form-group ">
                        <textarea v-model="post.body" rows="4" cols="50" name="body" placeholder="What do you need .." data-toggle="modal" data-target="#myModal" class="form-control" >
                        </textarea>
                        <button type="submit" class="btn btn-primary m-1">Post</button>
                      </div>
                </form>
                </div>
       </div>
    </div>
     </div>
  <hr>
    <div class="card m-3 " v-for="(post,index) in posts" v-bind:key="post.id">
            <div class="card-header">
                <a v-bind:href="'/profile/show/other/'+post.user.id" class="text-dark d-flex">  
             <img style="width:35px; height:35px" class="rounded-circle mr-1" v-bind:src="post.user.avatar" alt="">
            <h3>{{post.user.name}}</h3> 
              </a>
             </div>
             
            <div class="card-body">
                {{post.body}}               
            </div>
            {{checkLike(post)}}
               <div  v-if="post.liked==true">
                 <form @submit.prevent="removeLike(post.id,like_id,index)" >
                 <button type="submit"  class="fa fa-heart text-danger border rounded m-2 p-2 float-right" aria-hidden="true">  {{post.likes.length}}</button>
                   </form>
                </div>

               <div v-else-if="post.liked==false" >
                   <form @submit.prevent="addLike(post,index)" >
                       <input type="text" name="body" v-model="post.like_id" hidden>
               <button type="submit"  class="fa fa-heart text-dark border rounded m-2 p-2 float-right" aria-hidden="true">  {{post.likes.length}}</button>
                 </form>
               </div>
            <Comment :comments="post.comments"></Comment>
           <AddComment :post="post" :user="user"></AddComment>
       </div>
      <infinite-loading @distance="1" @infinite="makePagination"></infinite-loading>

 </div>
 

</template>


<script>
import { stringify } from 'querystring';
import { stat } from 'fs';
import Comment from './Comment.vue';
import AddComment from './AddComment.vue';
    export default {
        components:{
             Comment,AddComment
        },
        data(){
            return{
                posts:[],
                post:{
                    id:'',
                    title:this.user.name,
                    body:'',
                    user_id: this.user.id,
                  
                },
                comments:[]
                ,
                comment:{
                    id:'',
                    comment:'',
                    user_id:'',
                    post_id:'',
                  
                },
                 post_id:'',
                 pagination:{},
                 edit:false,
                 liked:false,
                 like_id:0,
                 index:0,
                 page:1,
            
            }
        }, props:['user']
        ,
        created()
        {
  
           
        },
        methods:{
            
            makePagination(state)
            {
               
               
             
               let  page_url=page_url||'/posts?page='+this.page;
           
                 axios.get(page_url).
                    then(res=>{
                       console.log(res); 
                     page_url=res.data.links.next;
                      res.data.data.forEach(data => {
                          this.posts.push(data);
                      });
                     console.log(res.data.links.next);
                     if(res.data.links.next !=null)
                       {
                         state.loaded();
                       }
                       else 
                       {
                             state.complete();
                       
                       }
                 }).catch(console.log(err=>err))
                 this.page=this.page+1;
             },
            addPost()
            {
                if(this.post.body !=''){
                axios.post('/posts',{   
                 body:this.post.body,
                 title:this.post.title
                         
                }).then(res=>{
                     console.log(res);
                        this.post.body='';
                        this.posts.push(res.data.data);
                        this.$forceUpdate();
                })}
            
            }
            ,
            deletePost(id)
            {
                if(confirm('are you sure'))
                {
                    axios.delete('post/'+id,{
                        method:'delete'
                    }).then(res=>res.json()).then(data=>{
                        alert('Removed');
                        //delete from posts
                    })

                }
            },
            editPost(post)
            {
                this.post.edit=true;
                this.post.title=post.title;
                this.post.body=post.body;
                this.post.id=post.id;
                this.post.post_id=post.id;
            },
            addLike(post,index)
            {
                   axios.post('post/like/'+post.id).then(res=>{
                        this.posts[index]=res.data.data;
                        this.$forceUpdate();
                        console.log(index);
                        console.log(post.id);
                })
            },
            removeLike(post_id,like_id,index)
            {
                   axios.post('/post/like/remove/'+post_id+'/'+like_id).then(res=>{
                   this.posts[index]=res.data.data;
                    this.$forceUpdate();
                })
            },
            checkLike(post)
            {
                  post.likes.forEach(like => {
                      if(like.user_id==this.user.id)
                      {
                          this.like_id=like.id;
                          post.liked=true;
                      }
                  });
            }
        }
    };
</script>

