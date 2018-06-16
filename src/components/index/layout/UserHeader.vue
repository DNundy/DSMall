<template>
  <div class="header">
        <div class="headerWrap">
            <a href="/">
                <span class="hlogo">趣二手</span>
            </a>
            <div class="hList">
                <a href="" class="active">寻购商品</a>
                <a href="">我要出售</a>
                <a href="">个人空间</a>
                <a href="">关于我们</a>
            </div>
            <user-login></user-login>
        </div>
  </div>
</template>
 
<script>

import UserLogin from '../common/UserLogin'

export default {
  data () {
    return {
    }
  },
  components: {
      UserLogin
  }
}
</script>
 
 
<style scoped>
    .header{
        box-sizing: border-box;
        width: 100%;
        height: 50px;
        background: #fff;
        box-shadow: 0 1px 2px 0 rgba(0,0,0,.06);
        text-decoration: none;
    }
    .headerWrap{
        width: 1200px;
        margin: 0 auto;
        overflow: hidden;
    }
    .hlogo{
        display: inline-block;
        float: left;
        font-size: 26px;
        font-weight: 700;
        color: #08B35F;
        text-decoration: none;
        line-height: 50px;
        margin-left: 50px;
        font-family: '楷体';
    }
    .hList{
        float: left;
        width: 600px;
        height: 50px;
        margin-left: 80px;
    }
    .hList a{
        display: block;
        float: left;
        position: relative;
        
        width: 70px;
        height: 45px;
        line-height: 50px;
        text-align: center;
        margin: 0 20px;
        
        color: #000;
        font-size: 14px;
        text-decoration: none;
    }
    .hList a:after{
        content: "";
        width: 0;
        height: 1px;
        background: #08B35F;
        position: absolute;
        top: 100%;
        left: 50%;
        transition: all .3s;
    }
    .hList a:hover:after{
        left: 0%;
        width: 100%;
    }
</style>