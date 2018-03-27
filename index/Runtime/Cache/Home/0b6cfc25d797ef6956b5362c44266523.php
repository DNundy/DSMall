<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台管理 - 趣二手</title>

    <!-- ThirdParty -->
    <script src="./lib/vue.min.js"></script>
    <script src="./lib/element.min.js"></script>
    <link rel="stylesheet" href="./lib/normalize.css">
    <link rel="stylesheet" href="./lib/element.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="./css/admin.css">
</head>
<body>
    <!-- Layout -->
    <div id="app">
        <el-container>
            <!-- Header 区域 -->
            <el-header>
                <div class="logo">趣二手 后台管理系统</div>
                <el-button type="warning" plain>退出登录</el-button>
            </el-header>

            <el-container>

                <!-- 侧边栏 -->
                <el-aside>
                    <div class="userInfo">
                        <div class="userInfo-pic"><img src="./img/test.jpg" alt="头像" title="头像"></div>
                        <div class="userInfo-name">欢迎您！Admin</div>
                    </div>
                    <el-menu default-active="1">
                        <el-submenu index="1">
                            <template slot="title">
                                <i class="el-icon-location"></i>
                                <span slot="title">用户管理</span>
                            </template>
                            <el-menu-item index="1-1">查看用户</el-menu-item>
                            <el-menu-item index="1-2">添加用户</el-menu-item>
                            <el-menu-item index="1-3">删除用户</el-menu-item>
                            <el-menu-item index="1-4">修改信息</el-menu-item>
                        </el-submenu>

                        <el-submenu index="2">
                            <template slot="title">
                                <i class="el-icon-menu"></i>
                                <span slot="title">商品管理</span>
                            </template>
                            <el-menu-item index="2-1">查看商品</el-menu-item>
                            <el-menu-item index="2-2">添加商品</el-menu-item>
                            <el-menu-item index="2-3">删除商品</el-menu-item>
                        </el-submenu>

                        <el-submenu index="3">
                            <template slot="title">
                                <i class="el-icon-document"></i>
                                <span slot="title">系统设置</span>
                            </template>
                            <el-menu-item index="2-1">系统设置</el-menu-item>
                            <el-menu-item index="2-2">系统设置</el-menu-item>
                            <el-menu-item index="2-3">系统设置</el-menu-item>
                        </el-submenu>

                        <el-submenu index="4">
                            <template slot="title">
                                <i class="el-icon-setting"></i>
                                <span slot="title">其它设置</span>
                            </template>
                            <el-menu-item index="2-1">其它设置</el-menu-item>
                            <el-menu-item index="2-2">其它设置</el-menu-item>
                            <el-menu-item index="2-3">其它设置</el-menu-item>
                        </el-submenu>
                    </el-menu>
                </el-aside>

                <!-- 内容区域 -->
                <el-main>
                </el-main>

            </el-container>

            <!-- Footer 区域 -->
            <el-footer>
                <div class="links">
                    <a target="_blank" href="http://www.xiyou.edu.cn/">西邮官网</a> | 
                    <a target="_blank" href="http://cs.xupt.edu.cn:81/xiyoucs/index.asp">计算机学院</a> | 
                    <a target="_blank" href="http://gr.xupt.edu.cn/">研究生院</a> | 
                    <a href="./login.html">普通用户</a>
                </div>
                <p class="copyright"> Copyright © 2018 趣二手 All Rights Reserved </p>
            </el-footer>

        </el-container>
    </div>

    <!-- VUE -->
    <script>
        var app = new Vue({
            el: '#app',
            data: {
            },
            methods: {
            }
        })
    </script>
</body>
</html>