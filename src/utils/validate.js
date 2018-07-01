const validate = {
    checkLength: function (value, min, max, type) {
        if (typeof (min) != 'number' || typeof (max) != 'number') {
            throw new Error('【validate】: 最小值和最大值应该设为数字！')
        } else if (min > max) {
            throw new Error('【validate】: 最小值应该小于最大值！')
        }

        let valueLength = value.length;
        if (valueLength >= min && valueLength <= max) {
            return {
                status: true,
            };
        } else if (!value) {
            return {
                status: false,
                type: 1,
            };
        } else if (valueLength < min) {
            return {
                status: false,
                type: -1,
                msg: type + '长度不能小于' + min + '位'
            };
        } else if (valueLength > max) {
            return {
                status: false,
                type: -1,
                msg: type + '长度不能大于' + max + '位'
            };
        }
    },
    checkPhone: function (value) {
        let valueLength = value.length;
        let phoneReg = /^[1][3,4,5,7,8][0-9]{9}$/;
        let result = phoneReg.test(value);
        if (!value) {
            return {
                status: false,
                type: -1,
                msg: '手机号码是必须的哦'
            };
        } else if (valueLength != 11) {
            return {
                status: false,
                type: -1,
                msg: '手机号码一般为11位纯数字'
            };
        } else if (!result) {
            return {
                status: false,
                type: -1,
                msg: '手机号码格式好像出错了呢'
            };
        } else if (result) {
            return {
                status: true,
            }
        }
    },
    checkEmail: function (value) {
        let emailReg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        let result = emailReg.test(value);

        if (!value) {
            return {
                status: false,
                type: -1,
                msg: '邮箱是必须的哦'
            };
        } else if (!result) {
            return {
                status: false,
                type: -1,
                msg: '邮箱格式好像出错了呢'
            };
        } else if (result) {
            return {
                status: true,
            }
        }
    },
}
export default validate
