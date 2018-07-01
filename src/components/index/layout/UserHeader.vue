<template>
    <div class="header">
        <div class="headerWrap">
            <a href="/"><span class="headerLogo">趣二手</span></a>
            <div class="headerList">
                <a href="" class="active">寻购商品</a>
                <a href="">我要出售</a>
                <a href="">个人空间</a>
                <a href="">关于我们</a>
            </div>
            <div class="user-info">
                <span v-if="!accountStatus.loginStatus">
                        <span class="goLogin" @click="jumpTo('loginDiv')">登录</span>
                        <span class="goRegister" @click="jumpTo('registerDiv')">&nbsp;&nbsp;注册</span>
                </span>
                <span v-else>
                    <span>{{userInfo.a_name}}</span>
                    <span class="outLogin" @click="loginOut">&nbsp;&nbsp;退出</span>
                </span>
            </div>
            <user-login></user-login>
            <user-register></user-register>
            <user-forget></user-forget>
        </div>
    </div>
</template>

<script>

import UserLogin from '../common/UserLogin'
import UserRegister from '../common/UserRegister'
import UserForget from '../common/UserForget'
import storageUtil from '@/utils/storage';

export default {
    data () {
        return {}
    },
    methods:{
        jumpTo(place){
            this.$store.commit('accountPanel',{
                name: place,
                status: true
            });
        },
        loginOut(){
            this.$store.commit('clearUserInfo');
            storageUtil.clearUserInfo();
        }
    },
    components: {
        UserLogin,
        UserRegister,
        UserForget
    },
    computed: {
        userInfo: function (params) {
            return this.$store.state.userInfo;
        },
        accountStatus: function (params) {
            return this.$store.state.accountStatus;
        }
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
    /* header logo */
    .headerLogo{
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
    /* header选项列表 */
    .headerList{
        float: left;
        width: 600px;
        height: 50px;
        margin-left: 80px;
    }
    .headerList a{
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
    .headerList a:after{
        content: "";
        width: 0;
        height: 1px;
        background: #08B35F;
        position: absolute;
        top: 100%;
        left: 50%;
        transition: all .3s;
    }
    .headerList a:hover:after{
        left: 0%;
        width: 100%;
    }
    /* 登录注册按钮 */
    .user-info{
        float: right;
        width: 200px;
        height: 40px;
        text-align: center;
        overflow: hidden;
    }
    .user-info span{
        font-size: 16px;
        line-height: 40px;
        color: #08B35F;
        cursor: pointer;
    }
    .user-info .outLogin{
        color: crimson;
    } 
</style>