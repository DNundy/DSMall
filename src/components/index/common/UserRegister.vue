<template>
    <div class="registerWrap" v-if="registerDivStatus">
        <div class="registerDiv">
            <img class="registerLogo" src="@/assets/logo_register.png" alt="注册LOGO">
            <div class="registerHead">
                <span class="registerTitle">注册</span>
                <div class="registerClose" @click="closeRegisterDiv">×</div>
            </div>
            <div class="registerCont">
                <input type="text" placeholder="请输入用户昵称" v-model="registerInfo.name">
                <input type="text" placeholder="请输入手机号码" v-model="registerInfo.id">
                <input type="email" placeholder="请输入电子邮箱" v-model="registerInfo.email">
                <input type="password" placeholder="请输入登录密码" v-model="registerInfo.password">
                <input type="button" value="立即注册" @click="submitRegister">
            </div>
            <div class="registerFoot">
                <span>已有账号？</span>
                <span class="toLogin" @click="toLogin">去登录</span>
            </div>
        </div>
    </div>
</template>
 
<script>
import qs from 'qs'
export default {
  data () {
    return {
        registerInfo: {
            name: '',
            id: '',
            email: '',
            password: ''
        }
    }
  },
  methods: {
      closeRegisterDiv() {
          this.$store.commit('closeRegisterDiv');
      },
      toLogin() {
          this.closeRegisterDiv();
          this.$store.commit('openLoginDiv');
      },
      submitRegister() {
        let data = qs.stringify(this.registerInfo);
        this.$ajax.post('/api/Account/register', data)
        .then((response)=>{
            console.log(response);
        }).catch((response)=>{
            console.log(response);
        })
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
        height: 380px;
        position: absolute;
        top: 0;bottom: 0;left: 0;right: 0;
        margin: auto;
        background: #fff;
        border-radius: 6px;
    }
    .registerLogo{
        display: block;
        width:110px;
        height: auto;
        position: absolute;
        left: 0;right: 0;
        top: -110px;
        margin: auto;
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
    .registerCont input[type=password], input[type=text], input[type=button], input[type=email]{
        padding: 10px;
        width: 86%;
        border-radius: 2px;
        outline: none;
        box-sizing: border-box;
        display: block;
        margin: 15px auto;
        outline: none;
    }
    .registerCont input[type=password], input[type=text],  input[type=email]{
        border: 1px solid #e9e9e9;
    }
    .registerCont input[type=password]:focus,input[type=text]:focus,  input[type=email]:focus{
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