
https://blog.csdn.net/weixin_36851500/article/details/93923919
一篇php守护进程的命令讲解，

https://wzfou.com/php-fpm/
一篇有点偏向运维的服务器知识

https://www.cnblogs.com/hejun695/p/6934677.html
遇到个抓包灌水的文章，很多东西直接借鉴，留着，今晚看看

php从以前到现在一直都是单继承的语言，无法同时从两个基类中继承属性和方法，为了解决这个问题，php出了Trait这个特性

用法：通过在类中使用use 关键字，声明要组合的Trait名称，具体的Trait的声明使用Trait关键词，Trait不能实例化

原文链接与demo用法
https://www.jianshu.com/p/fc053b2d7fd1


对于PHP编程来说，抽象类可以实现的功能，接口也可以实现。
抽象类的接口的区别，不在于编程实现，而在于程序设计模式的不同。

一般来讲，抽象用于不同的事物，而接口用于事物的行为。
如：水生生物是鲸鱼的抽象概念，但是水生生物并不是鲸鱼的行为，吃东西才是鲸鱼的行为。

对于大型项目来说，对象都是由基本的抽象类继承实现，而这些类的方法通常都由接口来定义。
此外，对于事物属性的更改，建议使用接口，而不是直接赋值或者别的方式，

愿文章
https://blog.csdn.net/sunlylorn/article/details/6124319
https://segmentfault.com/a/1190000004699158

我觉得这个文章说明的很简洁、容易明白。大白话解答事情+举例
https://www.kancloud.cn/lllh/php-mysql-apache-ngnix-linux-git-svn/403842

相同点：
(1)      两者都是抽象类，都不能实例化。
(2)      interface 实现类及 abstract class 的子类都必须要实现已经声明的抽象方法。

3. interface 的应用场合

(1)      类与类之间需要特定的接口进行协调，而不在乎其如何实现。

(2)      作为能够实现特定功能的标识存在，也可以是什么接口方法都没有的纯粹标识。

(3)      需要将一组类视为单一的类，而调用者只通过接口来与这组类发生联系。

(4)      需要实现特定的多项功能，而这些功能之间可能完全没有任何联系。

4. abstract class 的应用场合

一句话，在既需要统一的接口，又需要实例变量或缺省的方法的情况下，就可以使用它。最常见的有：

(1)      定义了一组接口，但又不想强迫每个实现类都必须实现所有的接口。可以用 abstract class 定义一组方法体，甚至可以是空方法体，然后由子类选择自己所感兴趣的方法来覆盖。

(2)      某些场合下，只靠纯粹的接口不能满足类与类之间的协调，还必需类中表示状态的变量来区别不同的关系。 abstract 的中介作用可以很好地满足这一点。

(3)      规范了一组相互协调的方法，其中一些方法是共同的，与状态无关的，可以共享的，无需子类分别实现；而另一些方法却需要各个子类根据自己特定的状态来实现特 定的功能 。
