"""
功能：
    以列表的形式读取文件
    剔除文件中的空格及回车
注意：
    1.abc.txt必须放在此py文件的当前目录下
    2.abc.txt的编码方式为默认的ANSI编码方式

"""

def test3():
    """
    :return: 学生列表
    """
    with open("abc.txt","r") as fp:
        """
        漂亮的代码
        """
        stu_list = [data.strip() for data in fp if data.strip()]  #obj.strip()#空格里什么都不跟，表示剔除对象两边的所有空行：\n,\t
    print(stu_list)
test3()