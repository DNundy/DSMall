<template>
    <div class="forgetWrap" v-if="accountStatus.forgetDiv">
        <div class="forgetDiv">
            <img class="forgetLogo" src="@/assets/logo_forget.png" alt="忘记密码LOGO">
            <div class="forgetHead">
                <span class="forgetTitle">找回</span>
                <div class="forgetClose" @click="closeForgetDiv">×</div>
            </div>
            <div class="forgetCont"  @keyup.enter="submitForget">
                <input type="text" placeholder="请输入手机号码" v-model="forgetInfo.id"  @keyup="checkPhone">
                <input type="email" placeholder="请输入预留邮箱" v-model="forgetInfo.email"  @keyup="checkEmail">
                <input type="password" placeholder="请输入新的密码" v-model="forgetInfo.password"  @keyup="checkPwd">
                <div class="tips" :class="{error:forgetTips.error_status}">{{forgetTips.error_tips}}</div>
                <div class="submitBtn" @click="submitForget">{{forgetTips.submit_text}}</div>
            </div>
            <div class="forgetFoot">
                <span class="toLogin" @click="jumpTo('loginDiv')">返回登录</span>
            </div>
        </div>
    </div>
</template>

<script>

import validate from '@/utils/validate';
import storageUtil from '@/utils/storage';

export default {
    data () {
        return {
            forgetInfo: {
                id: '',
                email: '',
                password: ''
            },
            forgetTips: {
                error_status: false,
                error_text: '别担心，账户很快就回来了！',
                error_tips: '别担心，账户很快就回来了！',
                submit_text: '立即登录'
            }
        }
    },
    methods: {
        // 关闭当前
        closeForgetDiv() {
            this.$store.commit('accountPanel',{
                name: 'forgetDiv',
                status: false
            });
            this.forgetTips.error_status = false;
            this.forgetTips.error_tips = this.forgetTips.error_text;
            this.forgetInfo.id = this.forgetInfo.email = this.forgetInfo.password = '';
        },
        // 跳转方法
        jumpTo(place){
            this.closeForgetDiv();
            this.$store.commit('accountPanel',{
                name: place,
                status: true
            });
        },


        checkPhone: function () {
            let result = validate.checkPhone(this.registerInfo.id);
            if( !result.status ){
                this.registerTips.error_tips = result.msg;
                this.registerTips.error_status = true;
                return false;
            }
            this.registerTips.error_status = false;
            this.registerTips.error_tips = this.registerTips.error_text;
            return true;
        },
        checkEmail: function () {
            let result = validate.checkEmail(this.registerInfo.email);
            if( !result.status ){
                this.registerTips.error_tips = result.msg;
                this.registerTips.error_status = true;
                return false;
            }
            this.registerTips.error_status = false;
            this.registerTips.error_tips = this.registerTips.error_text;
            return true;
        },
        checkPwd: function () {
            let result = validate.checkLength(this.registerInfo.password, 6, 16, '密码');
            if( !result.status ){
                if( result.type == -1 ){
                    this.registerTips.error_tips = result.msg;
                }else if ( result.type == 1 ){
                    this.registerTips.error_tips = "密码是必须的哦！";
                }
                this.registerTips.error_status = true;
                return false;
            }
            this.registerTips.error_status = false;
            this.registerTips.error_tips = this.registerTips.error_text;
            return true;
        },

        // 提交信息
        submitForget(){

        }
    },
    computed: {
        accountStatus(){
            return this.$store.state.accountStatus;
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
        height: 373px;
        padding: 10px 0;
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
    .forgetCont .tips{
        width: 86%;
        box-sizing: border-box;
        padding: 10px;
        margin: 0 auto;
        font-size: 14px;
        color:#307B8A;
    }
    .forgetCont .error{
        color:tomato;
    }
    .forgetCont input[type=password], input[type=text], input[type=email]{
        padding: 10px;
        width: 86%;
        border-radius: 2px;
        outline: none;
        box-sizing: border-box;
        display: block;
        margin: 15px auto;
        outline: none;
        border: 1px solid #e9e9e9;
    }
    .forgetCont input[type=password]:focus,input[type=text]:focus, input[type=email]:focus{
        border-color: #307B8A;
    }
    .forgetCont .submitBtn{
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