# -*- coding: UTF-8 -*-
import time
import MySQLdb
import urllib.request
import requests
import json
import re
url="http://a.sanvm.com/datav/apipost.php"
headers = {'content-type': 'application/json',
	           'User-Agent': 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:22.0) Gecko/20100101 Firefox/22.0'}
print("处理中...")
r=requests.get(url,headers=headers)
