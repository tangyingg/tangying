# 用列表和字典的方式完成逻辑数据的生成
"""
例1：用列表的方式生成15 个[-30, 30]之间的随机整数。
    并将其中大于0的整数返回给用户。
"""
import random

rand_list = [random.randint(-30,30) for x in range(15)]
print(rand_list)

usr_list = [x for x in rand_list if x > 0]
print(usr_list)

"""
例2：生成一个字典，包含60名学生的成绩。
    学生名以Name1 – Name60命名
    成绩范围为[40, 100]分之间。
    将成绩中及格（>=60）的学生信息返回给用户
"""
info_dic = {"Name{}".format(x):random.randint(40,100) for x in range(1,60)}
print(info_dic)

usr2_list = {k: v for k, v in info_dic.items() if v >= 60}
print(usr2_list)

# 字典排序
sorted_dict = sorted(usr2_list.items(), key=lambda x: x[1])
print(sorted_dict)
