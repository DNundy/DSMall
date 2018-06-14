# Common模块是一个特殊的模块，是应用的公共模块

#访问所有的模块之前都会首先加载公共模块下面的

配置文件（Conf/config.php）+ 公共函数文件（Common/function.php）

但Common模块本身不能通过URL直接访问，公共模块的其他文件则可以被其他模块继承或者调用。