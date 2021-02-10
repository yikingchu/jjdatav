# -*- coding: UTF-8 -*-
import time
import MySQLdb
import urllib.request
import requests
import json
import re
rdate=time.strftime("%Y-%m-%d", time.localtime())
rtime=time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())
db = MySQLdb.connect("127.0.0.1", "root", "zyk680251", "fdatav", charset='utf8' )
cursor = db.cursor()
# SQL 查询语句
sql = "SELECT * FROM cocoapp_jjbh"
dsql = "DELETE FROM cocoapp_jjxx WHERE createdate = '%s'" % (rdate)
try:
  	cursor.execute(dsql)
except:
  	db.rollback()
try:
   # 执行SQL语句
   cursor.execute(sql)
   # 获取所有记录列表
   results = cursor.fetchall()
   if results:
	   for row in results:
	      num=row[1]
	      name=row[2]
	      lx=row[3]
	      url="http://fundgz.1234567.com.cn/js/%s.js" % (num)
	      headers = {'content-type': 'application/json',
	           'User-Agent': 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:22.0) Gecko/20100101 Firefox/22.0'}
	      r=requests.get(url,headers=headers)
	      if r.status_code==200 and r.text!="jsonpgz();":
	            # 打印结果
	            rs=r.text
	            rs=rs.replace('jsonpgz(','')
	            rs=rs.replace(');','')
	            rx=json.loads(rs)
	            isql="INSERT INTO cocoapp_jjxx(fundcode,name, jzrq, dwjz, gsz, gszzl,gztime,createtime,createdate)VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s')" % \
	                    (rx['fundcode'],rx['name'],rx['jzrq'],rx['dwjz'],rx['gsz'],rx['gszzl'],rx['gztime'],rtime,rdate)
	            try:
	               # 执行sql语句
	               cursor.execute(isql)
	               db.commit()
	            except:
	               # 发生错误时回滚
	               db.rollback()
	            print("请求成功：%s" % (rx['fundcode']))

except:
   print("Error: Yiking's unkown error")

# 关闭数据库连接
db.close()
