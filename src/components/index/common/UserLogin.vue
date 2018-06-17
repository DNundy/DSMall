<template>
    <div class="loginWrap" v-if="loginDivStatus">
        <div class="loginDiv">
            <img class="loginLogo" src="@/assets/logo_login.png" alt="登录LOGO">
            <div class="loginHead">
                <span class="loginTitle">登录</span>
                <div class="loginClose" @click="closeLoginDiv">×</div>
            </div>
            <div class="loginCont">
                <input type="text" placeholder="请输入手机号" v-model="loginInfo.id">
                <input type="password" placeholder="请输入密码" v-model="loginInfo.password">
                <input type="button" value="立即登录" @click="submitLogin">
            </div>
            <div class="loginFoot">
                <span>没有账号？</span>
                <span class="toRegister" @click="toRegister">朕要注册</span>
                <span class="forgetPw" @click="toForget">忘记密码</span>
            </div>
        </div>
    </div>
</template>
 
<script>
export default {
  data () {
    return {
        loginInfo: {
            id: '',
            password: ''
        }
    }
  },
  methods: {
      closeLoginDiv() {
          this.$store.commit('closeLoginDiv');
          this.loginInfo.id = this.loginInfo.password = '';
      },
      toRegister() {
          this.closeLoginDiv();
          this.$store.commit('openRegisterDiv');
      },
      toForget() {
          this.closeLoginDiv();
          this.$store.commit('openForgetDiv');
      },
      submitLogin(){
        this.$ajax.post('/api/Account/encode', this.loginInfo).then((response)=>{
            console.log(response);
        }).catch((response)=>{
            console.log(response);
        })
      }
  },
  computed: {
      loginDivStatus(){
          return this.$store.state.loginDivStatus;
      }
  },
  mounted(){
  }
}
</script>
 
 
<style scoped>
    .loginWrap{
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;left: 0;
        z-index: 999;
        background-color: rgba(0, 0, 0, .7);
    }
    .loginDiv{
        width: 320px;
        height: 290px;
        position: absolute;
        top: 0;bottom: 0;left: 0;right: 0;
        margin: auto;
        background: #fff;
        border-radius: 6px;
    }
    .loginLogo{
        display: block;
        width:100px;
        height: auto;
        position: absolute;
        left: 0;right: 0;
        top: -95px;
        margin: auto;
    }
    .loginHead{
        box-sizing: border-box;
        width: 100%;
        height: 50px;
        line-height: 50px;
        padding: 0 20px;
        margin-bottom: 20px;
    }
    .loginTitle{
        font-size: 18px;
        font-weight: 600;
        color: #3c3c3c;
    }
    /* 关闭按钮 */
    .loginClose{
        width: 30px;
        height: 30px;
        text-align: center;
        font-size: 25px;
        float: right;
        cursor: pointer;
        color: #3c3c3c;
    }
    .loginClose:hover{
        color: crimson;
    }
    /* 登录页表单样式 */
    .loginCont input[type=password], input[type=text], input[type=button]{
        padding: 10px;
        width: 86%;
        border-radius: 2px;
        outline: none;
        box-sizing: border-box;
        display: block;
        margin: 15px auto;
        outline: none;
    }
    .loginCont input[type=password], input[type=text]{
        border: 1px solid #e9e9e9;
    }
    .loginCont input[type=password]:focus,input[type=text]:focus{
        border-color: #307B8A;
    }
    .loginCont input[type=button]{
        cursor: pointer;
        color: #fff;
        border: none;
        background: #307B8A;
    }
    /* 登录页底部提示 */
    .loginFoot{
        box-sizing: border-box;
        width: 86%;
        padding: 10px;
        margin: 0 auto;
    }
    .loginFoot span{
        color: #757575;
        font-size: 14px;
    }
    .loginFoot .toRegister, .loginFoot .forgetPw{
        cursor: pointer;
        color: #307B8A;
    }
    .loginFoot .forgetPw{
        float: right;
    }
</style>