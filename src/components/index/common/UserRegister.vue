<template>
    <div class="registerWrap" v-if="registerDivStatus">
        <div class="registerDiv">
            <div class="registerHead">
                <span class="registerTitle">注册账号</span>
                <div class="registerClose" @click="closeRegisterDiv">×</div>
            </div>
            <div class="registerCont">
                <input type="text" placeholder="请输入用户名">
                <input type="text" placeholder="请输入手机号">
                <input type="password" placeholder="请输入密码">
                <input type="button" value="立即注册">
            </div>
            <div class="registerFoot">
                <span>已有账号？</span>
                <span class="toLogin" @click="toLogin">去登录</span>
            </div>
        </div>
    </div>
</template>
 
<script>
export default {
  data () {
    return {
    }
  },
  methods: {
      closeRegisterDiv() {
          this.$store.commit('closeRegisterDiv');
      },
      toLogin() {
          this.$store.commit('closeRegisterDiv');
          this.$store.commit('openLoginDiv');
      }
  },
  computed: {
      registerDivStatus(){
          return this.$store.state.registerDivStatus;
      }
  },
  mounted(){
  }
}
</script>
 
 
<style scoped>
    .registerWrap{
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;left: 0;
        z-index: 999;
        background-color: rgba(0, 0, 0, .7);
    }
    .registerDiv{
        width: 320px;
        height: 330px;
        position: absolute;
        top: 0;bottom: 0;left: 0;right: 0;
        margin: auto;
        background: #fff;
        border-radius: 6px;
    }
    .registerHead{
        box-sizing: border-box;
        width: 100%;
        height: 50px;
        line-height: 50px;
        padding: 0 20px;
        margin-bottom: 20px;
    }
    .registerTitle{
        font-size: 18px;
        font-weight: 600;
        color: #3c3c3c;
    }
    /* 关闭按钮 */
    .registerClose{
        width: 30px;
        height: 30px;
        text-align: center;
        font-size: 25px;
        float: right;
        cursor: pointer;
        color: #3c3c3c;
    }
    .registerClose:hover{
        color: crimson;
    }
    /* 注册页表单样式 */
    .registerCont input[type=password], input[type=text], input[type=button]{
        padding: 10px;
        width: 86%;
        border-radius: 2px;
        outline: none;
        box-sizing: border-box;
        display: block;
        margin: 15px auto;
        outline: none;
    }
    .registerCont input[type=password], input[type=text]{
        border: 1px solid #e9e9e9;
    }
    .registerCont input[type=password]:focus,input[type=text]:focus{
        border-color: #307B8A;
    }
    .registerCont input[type=button]{
        cursor: pointer;
        color: #fff;
        border: none;
        background: #307B8A;
    }
    /*注册页底部提示*/
    .registerFoot{
        box-sizing: border-box;
        width: 86%;
        padding: 10px;
        margin: 0 auto;
    }
    .registerFoot span{
        color: #757575;
        font-size: 14px;
    }
    .registerFoot .toLogin{
        cursor: pointer;
        color: #307B8A;
    }
</style>