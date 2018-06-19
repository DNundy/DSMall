<template>
    <div class="loginWrap" v-if="loginDivStatus">
        <div class="loginDiv">
            <img class="loginLogo" src="@/assets/logo_login.png" alt="登录LOGO">
            <div class="loginHead">
                <span class="loginTitle">登录</span>
                <div class="loginClose" @click="closeLoginDiv">×</div>
            </div>
            <div class="loginCont" @keyup.enter="submitLogin">
                <input type="text" placeholder="请输入手机号码" v-model="loginInfo.id" @keyup="checkPhone">
                <input type="password" placeholder="请输入登录密码" v-model="loginInfo.password"  @keyup="checkPwd">
                <div class="tips" :class="{error:error_status}">{{error_tips}}</div>
                <div class="submitBtn" @click="submitLogin">{{submit_text}}</div>
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

import qs from 'qs'
import validate from "@/utils/validate";

export default {
  data () {
    return {
        loginInfo: {
            id: '',
            password: ''
        },
        error_status: false,
        error_text: '欢迎登录趣二手！',
        error_tips: '欢迎登录趣二手！',
        submit_text: '立即登录'
    }
  },
  methods: {
        // 跳转方法
        closeLoginDiv() {
            this.$store.commit('closeLoginDiv');
            this.loginInfo.id = this.loginInfo.password = '';
            this.error_status = false;
            this.error_tips = this.error_text;
        },
        toRegister() {
            this.closeLoginDiv();
            this.$store.commit('openRegisterDiv');
        },
        toForget() {
            this.closeLoginDiv();
            this.$store.commit('openForgetDiv');
        },

        // 检测方法
        checkPwd: function () {
            let result = validate.checkLength(this.loginInfo.password, 6, 16);
            if( !result.status ){
                if( result.type == -1 ){
                    this.error_tips = result.msg;
                }else if ( result.type == 1 ){
                    this.error_tips = "密码是必须的哦！";
                }
                this.error_status = true;
                return false;
            }
            this.error_status = false;
            this.error_tips = this.error_text;
            return true;
        },
        checkPhone: function () {
            let result = validate.checkPhone(this.loginInfo.id);
            if( !result.status ){
                this.error_tips = result.msg;
                this.error_status = true;
                return false;
            }
            this.error_status = false;
            this.error_tips = this.error_text;
            return true;
        },
        submitLogin(){
            if(this.checkPhone() && this.checkPwd()){
                this.submit_text="拼命登陆ing...";
                let data = qs.stringify(this.loginInfo);
                this.$ajax.post('/api/Account/login', data).then((response)=>{
                    this.submit_text="立即登录"
                }).catch((response)=>{
                    this.submit_text="立即登录"
                })
            }
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
        height: 320px;
        padding: 10px 0;
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
    .loginCont .tips{
        width: 86%;
        box-sizing: border-box;
        padding: 10px;
        margin: 0 auto;
        font-size: 14px;
        color:#307B8A;
    }
    .loginCont .error{
        color:tomato;
    }
    .loginCont input[type=password], input[type=text]{
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
    .loginCont .submitBtn{
        box-sizing: border-box;
        margin: 15px auto;
        text-align: center;
        width: 86%;
        padding: 10px;
        cursor: pointer;
        color: #fff;
        outline: none;
        border: none;
        border-radius: 2px;
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