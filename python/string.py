"""
产生A~Z的序列
几种方式
需要引入string模块
"""
#-*- coding:utf-8 -*-
import string #导入string这个模块
# 第一种生成A~Z的代码
num_2 = string.ascii_uppercase
print(num_2)

"""
产生a~z,A~Z的方法
需要引入string模块
"""
import string

letter_list = string.ascii_letters
print(letter_list)
print("===="*10)


"""
产生0~9的序列
几种方式
"""
num_1 = [x for x in range(0,9)]  #此方法不用引模块，生成list
print(num_1)

"""
数字的另外两种生成方式  
    需要引入string模块
    结果均是字符串
"""
number_list = string.digits
print(number_list)
# print(type(number_list))    #结果是字符串
# 方法2
numbers_letters = string.ascii_letters + string.digits
print(number_list)
