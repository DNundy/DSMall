<template>
    <div class="forgetWrap" v-if="forgetDivStatus">
        <div class="forgetDiv">
            <img class="forgetLogo" src="@/assets/logo_forget.png" alt="注册LOGO">
            <div class="forgetHead">
                <span class="forgetTitle">找回</span>
                <div class="forgetClose" @click="closeForgetDiv">×</div>
            </div>
            <div class="forgetCont">
                <input type="text" placeholder="请输入手机号码">
                <input type="email" placeholder="请输入预留邮箱">
                <input type="password" placeholder="请输入新的密码">
                <input type="button" value="去找回">
            </div>
            <div class="forgetFoot">
                <span class="toLogin" @click="toLogin">返回登录</span>
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
      closeForgetDiv() {
          this.$store.commit('closeForgetDiv');
      },
      toLogin() {
          this.closeForgetDiv();
          this.$store.commit('openLoginDiv');
      }
  },
  computed: {
      forgetDivStatus(){
          return this.$store.state.forgetDivStatus;
      }
  },
  mounted(){
  }
}
</script>
 
 
<style scoped>
    .forgetWrap{
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;left: 0;
        z-index: 999;
        background-color: rgba(0, 0, 0, .7);
    }
    .forgetDiv{
        width: 320px;
        height: 330px;
        position: absolute;
        top: 0;bottom: 0;left: 0;right: 0;
        margin: auto;
        background: #fff;
        border-radius: 6px;
    }
    .forgetLogo{
        display: block;
        width:130px;
        height: auto;
        position: absolute;
        left: 0;right: 0;
        top: -58px;
        margin: auto;
    }
    .forgetHead{
        box-sizing: border-box;
        width: 100%;
        height: 50px;
        line-height: 50px;
        padding: 0 20px;
        margin-bottom: 20px;
    }
    .forgetTitle{
        font-size: 18px;
        font-weight: 600;
        color: #3c3c3c;
    }
    /* 关闭按钮 */
    .forgetClose{
        width: 30px;
        height: 30px;
        text-align: center;
        font-size: 25px;
        float: right;
        cursor: pointer;
        color: #3c3c3c;
    }
    .forgetClose:hover{
        color: crimson;
    }
    /* 找回密码页表单样式 */
    .forgetCont input{
        padding: 10px;
        width: 86%;
        border-radius: 2px;
        outline: none;
        box-sizing: border-box;
        display: block;
        margin: 15px auto;
        outline: none;
    }
    .forgetCont input[type=password], input[type=text], input[type=email]{
        border: 1px solid #e9e9e9;
    }
    .forgetCont input[type=password]:focus,input[type=text]:focus, input[type=email]:focus{
        border-color: #307B8A;
    }
    .forgetCont input[type=button]{
        cursor: pointer;
        color: #fff;
        border: none;
        background: #307B8A;
    }
    /*找回密码页底部提示*/
    .forgetFoot{
        box-sizing: border-box;
        width: 86%;
        padding: 10px;
        margin: 0 auto;
    }
    .forgetFoot .toLogin{
        font-size: 14px;
        cursor: pointer;
        color: #307B8A;
    }
</style>