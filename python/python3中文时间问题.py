"""
以下解决了Windows系统下，python中的中文时间编码问题
背景：win10，python3.5
原理是：“在Windows里，time.strftime使用C运行时的多字节字符串函数strftime，这个函数必须先根据当前locale配置来编码格式化字符串（使用PyUnicode_EncodeLocale）。”如果不设置好locale的话，根据默认的"C" locale，底层的wcstombs函数会使用latin-1编码（单字节编码）来编码格式化字符串，然后导致题主提供的多字节编码的字符串在编码时出错。
"""
from datetime import datetime

import locale   #关键行1


obj_t1 = datetime.now()

locale.setlocale(locale.LC_CTYPE, 'chinese')   #关键行2

str_t1 = obj_t1.strftime("%Y年%m月%d日 %H时%M分%S秒")
print(str_t1)