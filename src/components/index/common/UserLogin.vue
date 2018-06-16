<template>
    <div class="user-login">
        <a href="">
            <span class="outLogin">退出</span>
        </a>
        <a href="">
            <span class="goLogin">登录</span>
            <span class="goRegister">注册</span>
        </a>
    </div>
</template>
 
<script>
export default {
  data () {
    return {
    }
  }
}
</script>
 
 
<style scoped>
    .user-login{
        float: right;
        width: 200px;
        height: 40px;
        text-align: center;
        overflow: hidden;
    }
    .user-login a{
        font-size: 16px;
        text-decoration: none;
        line-height: 40px;
        color: #08B35F;
    }
    .outLogin{
        color: crimson;
    }   
</style>