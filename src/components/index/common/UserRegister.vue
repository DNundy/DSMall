<template>
    <div class="registerWrap" v-if="registerDivStatus">
        <div class="registerDiv">
            <img class="registerLogo" src="@/assets/logo_register.png" alt="注册LOGO">
            <div class="registerHead">
                <span class="registerTitle">注册</span>
                <div class="registerClose" @click="closeRegisterDiv">×</div>
            </div>
            <div class="registerCont" @keyup.enter="submitRegister">
                <input type="text" placeholder="请输入用户昵称" v-model="registerInfo.name"  @keyup="checkName">
                <input type="text" placeholder="请输入手机号码" v-model="registerInfo.id"  @keyup="checkPhone">
                <input type="email" placeholder="请输入电子邮箱" v-model="registerInfo.email"  @keyup="checkEmail">
                <input type="password" placeholder="请输入登录密码" v-model="registerInfo.password"  @keyup="checkPwd">
                <div class="tips" :class="{error:error_status}">{{error_tips}}</div>
                <div class="submitBtn" @click="submitRegister">{{submit_text}}</div>
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
import validate from '@/utils/validate';
import storageUtil from '@/utils/storage';

export default {
    data () {
        return {
            registerInfo: {
                name: '',
                id: '',
                email: '',
                password: ''
            },
            error_status: false,
            error_text: '欢迎注册趣二手！',
            error_tips: '欢迎注册趣二手！',
            submit_text: '立即注册'
        }
    },
    methods: {
        closeRegisterDiv() {
            this.$store.commit('closeRegisterDiv');
            this.registerInfo.id = this.registerInfo.name = this.registerInfo.email = this.registerInfo.password = '';
            this.error_status = false;
            this.error_tips = this.error_text;
        },
        toLogin() {
            this.closeRegisterDiv();
            this.$store.commit('openLoginDiv');
        },
        // 检测方法
        checkName: function () {
            let result = validate.checkLength(this.registerInfo.name, 2, 15);
            if( !result.status ){
                if( result.type == -1 ){
                    this.error_tips = result.msg;
                }else if ( result.type == 1 ){
                    this.error_tips = "昵称是必须的哦！";
                }
                this.error_status = true;
                return false;
            }
            this.error_status = false;
            this.error_tips = this.error_text;
            return true;
        },
        checkPhone: function () {
            let result = validate.checkPhone(this.registerInfo.id);
            if( !result.status ){
                this.error_tips = result.msg;
                this.error_status = true;
                return false;
            }
            this.error_status = false;
            this.error_tips = this.error_text;
            return true;
        },
        checkEmail: function () {
            let result = validate.checkEmail(this.registerInfo.email);
            if( !result.status ){
                this.error_tips = result.msg;
                this.error_status = true;
                return false;
            }
            this.error_status = false;
            this.error_tips = this.error_text;
            return true;
        },
        checkPwd: function () {
            let result = validate.checkLength(this.registerInfo.password, 6, 16);
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
        submitRegister() {
            let status = this.checkName() && this.checkPhone() && this.checkEmail() &&this.checkPwd();
            if( status ){
                this.submit_text = "拼命注册ing..."
                this.$ajax(this.$service.AccountRegister, this.registerInfo)
                .then((response) => {
                    let data = response.data;
                    if( data.code == 0 ){
                        this.error_tips = this.error_text;;
                        this.error_status = false;
                        this.submitSuccess(data.data);
                    }else if ( data.code == -1 ){
                        this.error_tips = data.msg;
                        this.error_status = true;
                    }
                    this.submit_text='立即注册';
                }).catch((response) => {
                    this.error_tips = '一个未知的错误发生了！';
                    this.error_status = true;
                    this.submit_text='立即注册';
                })
            }
        },
        submitSuccess(data){
            // 设置全局信息
            this.$store.commit('setUserInfo', data);
            // 改变登录状态
            this.$store.commit('changeLoginStatus', true);
            // 存储本地Token
            storageUtil.setUserToken(data);
            // 关闭注册框
            this.closeRegisterDiv();
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
        height: 440px;
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
    .registerCont .tips{
        width: 86%;
        box-sizing: border-box;
        padding: 10px;
        margin: 0 auto;
        font-size: 14px;
        color:#307B8A;
    }
    .registerCont .error{
        color:tomato;
    }
    .registerCont input[type=password], input[type=text], input[type=email]{
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
    .registerCont .submitBtn{
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