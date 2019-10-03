import Home from './pages/Home'
import Posts from './components/Posts.vue'

export default[
    { 
      path:'/',
      component:Home
      ,name:'home'
     },
    {
        path:'/home',
      component:Posts
      ,name:'posts'
    }
    ];